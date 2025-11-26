<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_email',
        'message',
        'rating',
        'status',
        'doctor_id'
    ];

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function getStatusBadgeAttribute()
    {
        $statuses = [
            'pending' => 'bg-warning',
            'approved' => 'bg-success', 
            'rejected' => 'bg-danger'
        ];

        return $statuses[$this->status] ?? 'bg-secondary';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Menunggu',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak'
        ];

        return $statuses[$this->status] ?? 'Tidak Diketahui';
    }

    public function getStarsAttribute()
    {
        return str_repeat('⭐', $this->rating);
    }
}