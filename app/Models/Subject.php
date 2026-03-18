<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'slug', 'teacher_name', 'class_level', 'description'];

    public function materials() {
        return $this->hasMany(Material::class);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }
}
