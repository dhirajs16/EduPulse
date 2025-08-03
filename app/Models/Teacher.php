<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'avatar',
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'nid',
        'personal_email',
        'contact',
        'address',
        'city',
        'country',
        'postal_code',
        'salary',
        'joining_date',
        'qualification',
        'user_id',
    ];

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grades() {
        return $this->belongsToMany(Grade::class, 'grade_teachers')
            ->withPivot('subject_id');
    }

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'grade_teachers')
            ->withPivot('grade_id');
    }

    public function timeTables()
    {
        return $this->hasMany(TimeTable::class);
    }

    public function getNameAttribute()
    {
        return trim("{$this->first_name} {$this->middle_name} {$this->last_name}");
    }

}
