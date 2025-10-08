<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Facility extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'address',
        'city',
        'phone',
        'email',
        'operating_hours',
        'latitude',
        'longitude',
        'website',
        'image',
        'services',
        'is_emergency',
        'is_verified',
        'is_24_hours',
        'rating',
        'views_count',
        'notes',
        'user_id',
        'status'
    ];

    protected $casts = [
        'services' => 'array',
        'is_emergency' => 'boolean',
        'is_verified' => 'boolean',
        'is_24_hours' => 'boolean',
        'rating' => 'integer',
        'views_count' => 'integer',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($facility) {
            if (empty($facility->slug)) {
                $facility->slug = Str::slug($facility->name);
            }
            if (empty($facility->user_id)) {
                $facility->user_id = Auth::id();
            }
        });

        static::updating(function ($facility) {
            if ($facility->isDirty('name')) {
                $facility->slug = Str::slug($facility->name);
            }
        });
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-facility.jpg');
    }

    // Scope untuk filter berdasarkan type
    public function scopeByType($query, $type)
    {
        if ($type) {
            return $query->where('type', $type);
        }
        return $query;
    }

    // Scope untuk emergency only
    public function scopeEmergency($query)
    {
        return $query->where('is_emergency', true);
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('address', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Scope untuk nearby facilities (radius dalam km)
    public function scopeNearby($query, $latitude, $longitude, $radius = 10)
    {
        if ($latitude && $longitude) {
            return $query->selectRaw("
                *,
                (
                    6371 * acos(
                        cos(radians(?)) * cos(radians(latitude)) * 
                        cos(radians(longitude) - radians(?)) + 
                        sin(radians(?)) * sin(radians(latitude))
                    )
                ) AS distance
            ", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
        }
        return $query;
    }

    // Calculate distance to given coordinates
    public function getDistanceTo($latitude, $longitude)
    {
        if (!$this->latitude || !$this->longitude) {
            return null;
        }

        $earthRadius = 6371; // km

        $latDelta = deg2rad($latitude - $this->latitude);
        $lonDelta = deg2rad($longitude - $this->longitude);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($this->latitude)) * cos(deg2rad($latitude)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }
}
