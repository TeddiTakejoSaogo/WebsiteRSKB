<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'day',
        'start_time',
        'end_time'
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getDayNameAttribute()
    {
        $days = [
            'monday' => 'Senin',
            'tuesday' => 'Selasa',
            'wednesday' => 'Rabu',
            'thursday' => 'Kamis',
            'friday' => 'Jumat',
            'saturday' => 'Sabtu',
            'sunday' => 'Minggu'
        ];

        return $days[$this->day] ?? $this->day;
    }

    public function getTimeRangeAttribute()
    {
        return $this->start_time . ' - ' . $this->end_time;
    }

    public function getDisplayScheduleAttribute()
    {
        return $this->day_name . ': ' . $this->time_range;
    }

    public function getFormattedStartTimeAttribute()
    {
        return date('H:i', strtotime($this->start_time));
    }

    public function getFormattedEndTimeAttribute()
    {
        return date('H:i', strtotime($this->end_time));
    }

    public function getSimpleScheduleAttribute()
    {
        return $this->day_name . ': ' . $this->formatted_start_time . ' - ' . $this->formatted_end_time;
    }
}