<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Faq extends Model
{
    protected $fillable = [
        'question',
        'answer',
        'category',
        'tags',
        'trimester',
        'is_featured',
        'views_count',
        'helpful_count',
        'user_id',
        'status',
        'likes'
    ];

    protected $casts = [
        'trimester' => 'integer',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
        'helpful_count' => 'integer',
        'likes' => 'integer',
    ];

    // Boot method
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($faq) {
            if (empty($faq->user_id)) {
                $faq->user_id = Auth::id();
            }
        });
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk tags array
    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }

    // Mutator untuk tags array
    public function setTagsArrayAttribute($value)
    {
        $this->attributes['tags'] = is_array($value) ? implode(',', $value) : $value;
    }

    // Scope untuk filter berdasarkan category
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('category', $category);
        }
        return $query;
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
            return $query->where('question', 'like', '%' . $search . '%')
                        ->orWhere('answer', 'like', '%' . $search . '%')
                        ->orWhere('tags', 'like', '%' . $search . '%');
        }
        return $query;
    }

    // Scope untuk featured FAQs
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    // Increment helpful count
    public function incrementHelpful()
    {
        $this->increment('helpful_count');
    }

    // Get popular FAQs (by views + helpful)
    public function scopePopular($query, $limit = 10)
    {
        return $query->orderByRaw('(views_count + helpful_count) DESC')
                    ->limit($limit);
    }
}
