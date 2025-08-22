<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Syllabus extends Model
{
    protected $fillable = [
        'grade_id',
        'subject_id',
        'chapter_number',
        'title',
        'sub_topics',
        'credit_hours',
    ];

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
