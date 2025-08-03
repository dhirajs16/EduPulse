<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateAssignmentRequest extends FormRequest
{
  public function authorize(): bool
  {
    $teacher = Auth::user()->teacher ?? null;
    $gradeId = $this->input('grade_id');

    if (!$teacher || !$gradeId) {
      return false;
    }

        // Also ensure the teacher is linked to grade for update
    return \DB::table('grade_teachers')
      ->where('teacher_id', $teacher->id)
      ->where('grade_id', $gradeId)
      ->exists();
  }

  public function rules(): array
  {
    return [
      'teacher_id' => ['required', 'exists:teachers,id'],
      'grade_id' => ['required', 'exists:grades,id'],
      'subject_id' => ['nullable', 'exists:subjects,id'],
      'title' => ['required', 'string', 'max:255'],
      'description' => ['nullable', 'string'],
      'due_date' => ['nullable', 'date'],
      'status' => ['required', 'in:0,1'],
    ];
  }
}
