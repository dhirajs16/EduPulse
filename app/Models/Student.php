<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'avatar',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'address',
        'city',
        'country',
        'postal_code',
        'father_name',
        'mother_name',
        'guardian_name',
        'guardian_contact',
        'relationship_with_guardian',
        'user_id',
        'grade_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
