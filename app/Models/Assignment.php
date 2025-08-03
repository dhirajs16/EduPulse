<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
  protected $fillable = [
    'teacher_id',
    'grade_id',
    'subject_id',
    'title',
    'description',
    'due_date',
    'status',
  ];

    // Teacher who created the assignment
  public function teacher()
  {
    return $this->belongsTo(Teacher::class);
  }

    // Grade for which assignment is assigned
  public function grade()
  {
    return $this->belongsTo(Grade::class);
  }

    // Optional subject
  public function subject()
  {
    return $this->belongsTo(Subject::class);
  }
}
