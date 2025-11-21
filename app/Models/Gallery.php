<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'type'
    ];

    public function getTypeNameAttribute()
    {
        $types = [
            'facility' => 'Fasilitas',
            'activity' => 'Kegiatan',
            'event' => 'Acara'
        ];

        return $types[$this->type] ?? $this->type;
    }
}