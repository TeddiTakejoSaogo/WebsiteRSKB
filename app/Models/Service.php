<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'description',
        'operational_hours',
        'status'
    ];

    public function getIconClassAttribute()
    {
        $icons = [
            'stethoscope' => 'fas fa-stethoscope',
            'tooth' => 'fas fa-tooth',
            'baby' => 'fas fa-baby',
            'syringe' => 'fas fa-syringe',
            'ambulance' => 'fas fa-ambulance',
            'flask' => 'fas fa-flask',
            'heart' => 'fas fa-heart',
            'eye' => 'fas fa-eye'
        ];

        return $icons[$this->icon] ?? 'fas fa-medkit';
    }
}