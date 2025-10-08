<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
 protected $fillable = ['user_id','title','content','star_score'];
 public function user(){ return $this->belongsTo(User::class); }
 public function comments(){ return $this->hasMany(Comment::class); }
 public function reactions(){ return $this->hasMany(Reaction::class); }
}

