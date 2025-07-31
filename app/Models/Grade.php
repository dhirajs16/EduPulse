<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'name',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function teachers() {
        return $this->belongsToMany(Teacher::class, 'grade_teacher')
            ->withPivot('subject_id');
    }
}
