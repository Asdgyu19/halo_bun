<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug', 
        'trimester',
        'category',
        'excerpt',
        'body',
        'notion_url',
        'thumbnail',
        'user_id',
        'status'
    ];

    protected $casts = [
        'trimester' => 'integer',
    ];

    // Boot method untuk auto generate slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
            if (empty($article->user_id)) {
                $article->user_id = Auth::id();
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Comments
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Accessor untuk thumbnail URL
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }
        return asset('images/default-article.jpg'); // default image
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
                        ->orWhere('excerpt', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
        }
        return $query;
    }
}
