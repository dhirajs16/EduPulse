<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTimeTableRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'day' => 'required|in:Sunday,Monday,Tuesday,Wednesday,Thursday,Friday,Saturday',
            'start_time' => [
                'required',
                'date_format:H:i',
                function ($attribute, $value, $fail) {
                    if ($this->overlapsLunchBreak($value, $this->end_time)) {
                        $fail('Time slot conflicts with lunch break (12:30 PM to 01:00 PM)');
                    }
                }
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                function ($attribute, $value, $fail) {
                    if ($this->overlapsLunchBreak($this->start_time, $value)) {
                        $fail('Time slot conflicts with lunch break (12:30 PM to 01:00 PM)');
                    }
                }
            ],
            'grade_id' => 'required|exists:grades,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }

    protected function overlapsLunchBreak($start, $end)
    {
        $lunchStart = '12:30';
        $lunchEnd = '13:00';

        // Convert to minutes for comparison
        $startMinutes = $this->timeToMinutes($start);
        $endMinutes = $this->timeToMinutes($end);
        $lunchStartMinutes = $this->timeToMinutes($lunchStart);
        $lunchEndMinutes = $this->timeToMinutes($lunchEnd);

        // Check for overlap
        return ($startMinutes < $lunchEndMinutes) && ($endMinutes > $lunchStartMinutes);
    }

    protected function timeToMinutes($time)
    {
        [$hours, $minutes] = explode(':', $time);
        return ($hours * 60) + $minutes;
    }
}
