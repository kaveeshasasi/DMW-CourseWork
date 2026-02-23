<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code', 'name', 'description', 'duration'];

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
}
