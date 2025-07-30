<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    protected $fillable = [
        'fee_type_id',
        'grade_id',
        'amount',
        'year',
        'month',
    ];

    public function feeType()
    {
        return $this->belongsTo(FeeType::class);
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
