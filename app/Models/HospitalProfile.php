<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'description',
        'vision',
        'mission',
        'history',
        'logo',
        'facebook',
        'instagram',
        'tiktok',
        'youtube'
    ];

    protected $casts = [
        'vision' => 'array',
        'mission' => 'array',
    ];

    public function getMissionArrayAttribute()
    {
        if (is_array($this->mission)) {
            return $this->mission;
        }
        
        // Jika mission disimpan sebagai string, convert ke array
        return array_filter(explode("\n", $this->mission));
    }

    public function getVisionArrayAttribute()
    {
        if (is_array($this->vision)) {
            return $this->vision;
        }
        
        // Jika vision disimpan sebagai string, convert ke array
        return array_filter(explode("\n", $this->vision));
    }
}