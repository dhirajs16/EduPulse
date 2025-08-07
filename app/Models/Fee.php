<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'name',
        'description',
        'grade_id',
        'amount',
        'year',
        'month',
    ];


    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
