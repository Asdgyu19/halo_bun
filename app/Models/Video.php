<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Video extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'video_url',
        'video_type',
        'video_id',
        'thumbnail',
        'trimester',
        'category',
        'duration',
        'user_id',
        'is_featured',
        'views_count',
        'status'
    ];

    protected $casts = [
        'trimester' => 'integer',
        'duration' => 'integer',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
    ];

    // Boot method untuk auto generate slug dan video_id
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($video) {
            if (empty($video->slug)) {
                $video->slug = Str::slug($video->title);
            }
            if (empty($video->user_id)) {
                $video->user_id = Auth::id();
            }
            
            // Extract video ID dari URL
            if ($video->video_url && empty($video->video_id)) {
                $video->video_id = static::extractVideoId($video->video_url, $video->video_type);
            }
        });

        static::updating(function ($video) {
            if ($video->isDirty('title')) {
                $video->slug = Str::slug($video->title);
            }
            if ($video->isDirty('video_url')) {
                $video->video_id = static::extractVideoId($video->video_url, $video->video_type);
            }
        });
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Extract video ID dari URL
    public static function extractVideoId($url, $type = 'youtube')
    {
        switch ($type) {
            case 'youtube':
                if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $url, $match)) {
                    return $match[1];
                }
                break;
            case 'tiktok':
                if (preg_match('/tiktok\.com\/.*\/video\/(\d+)/', $url, $match)) {
                    return $match[1];
                }
                break;
        }
        return null;
    }

    // Accessor untuk embed URL
    public function getEmbedUrlAttribute()
    {
        switch ($this->video_type) {
            case 'youtube':
                return "https://www.youtube.com/embed/{$this->video_id}";
            case 'tiktok':
                return "https://www.tiktok.com/embed/v2/{$this->video_id}";
            default:
                return $this->video_url;
        }
    }

    // Accessor untuk thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        
        // Auto-generate thumbnail dari video platform
        switch ($this->video_type) {
            case 'youtube':
                return "https://img.youtube.com/vi/{$this->video_id}/maxresdefault.jpg";
            default:
                return asset('images/default-video.jpg');
        }
    }

    // Scope untuk filter berdasarkan trimester
    public function scopeByTrimester($query, $trimester)
    {
        if ($trimester) {
            return $query->where('trimester', $trimester);
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Scope untuk featured videos
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
