<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = ['subject_id', 'title', 'content', 'file_path'];

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
