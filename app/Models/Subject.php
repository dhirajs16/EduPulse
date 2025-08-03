<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'code',
        'name',
        'description',
        'type', // core or elective
        'credit_hours',
        'status', // active or inactive
    ];


    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'grade_teachers')
            ->withPivot('grade_id');
    }
}
