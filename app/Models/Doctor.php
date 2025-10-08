<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = ['name', 'specialization', 'email', 'phone'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
