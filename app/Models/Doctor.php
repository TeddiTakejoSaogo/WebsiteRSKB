<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'specialization',
        'education',
        'description',
        'photo',
        'experience',
        'status'
    ];

    public function schedules()
    {
        return $this->hasMany(DoctorSchedule::class);
    }

    public function getActiveSchedules()
    {
        return $this->schedules()->orderByRaw("
            CASE 
                WHEN day = 'monday' THEN 1
                WHEN day = 'tuesday' THEN 2
                WHEN day = 'wednesday' THEN 3
                WHEN day = 'thursday' THEN 4
                WHEN day = 'friday' THEN 5
                WHEN day = 'saturday' THEN 6
                WHEN day = 'sunday' THEN 7
            END
        ")->orderBy('start_time')->get();
    }
}