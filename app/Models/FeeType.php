<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeType extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }
}
