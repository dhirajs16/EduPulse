<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestDemo extends Model
{
    protected $fillable = [
        'school_name',
        'email',
        'country_code',
        'phone',
        'message',
        'status',
    ];
}
