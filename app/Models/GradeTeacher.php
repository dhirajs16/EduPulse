<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeTeacher extends Model
{

    protected $fillable = [
        'grade_id',
        'teacher_id',
        'subject_id',
    ];


     public function grade() {
        return $this->belongsTo(Grade::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function subject() {
        return $this->belongsTo(Subject::class);
    }
}
