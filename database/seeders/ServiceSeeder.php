<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        $services = [
            [
                'name' => 'Poli Umum',
                'icon' => 'stethoscope',
                'description' => 'Pelayanan kesehatan umum untuk berbagai keluhan penyakit dengan dokter yang berpengalaman.',
                'operational_hours' => 'Senin - Minggu: 07:00 - 21:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Gigi',
                'icon' => 'tooth',
                'description' => 'Perawatan dan pengobatan kesehatan gigi dan mulut dengan teknologi modern.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 17:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Anak',
                'icon' => 'baby',
                'description' => 'Pelayanan kesehatan khusus untuk bayi, balita, dan anak-anak dengan pendekatan yang ramah.',
                'operational_hours' => 'Setiap Hari: 08:00 - 20:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Bedah',
                'icon' => 'syringe',
                'description' => 'Pelayanan bedah umum dan khusus dengan teknologi modern dan tim bedah berpengalaman.',
                'operational_hours' => '24 Jam (IGD)',
                'status' => 'active'
            ],
            [
                'name' => 'IGD',
                'icon' => 'ambulance',
                'description' => 'Unit Gawat Darurat yang siap melayani 24 jam dengan tim medis yang sigap dan profesional.',
                'operational_hours' => '24 Jam Non-Stop',
                'status' => 'active'
            ],
            [
                'name' => 'Laboratorium',
                'icon' => 'flask',
                'description' => 'Pemeriksaan laboratorium lengkap dan akurat dengan peralatan medis terbaru.',
                'operational_hours' => 'Senin - Minggu: 06:00 - 22:00',
                'status' => 'active'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}