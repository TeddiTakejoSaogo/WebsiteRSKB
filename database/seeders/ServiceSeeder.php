<?php

namespace Database\Seeders;

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
                'description' => 'Pelayanan kesehatan umum untuk berbagai keluhan penyakit dengan dokter yang berpengalaman dan peralatan medis lengkap.',
                'operational_hours' => 'Senin - Minggu: 07:00 - 21:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Gigi & Mulut',
                'icon' => 'tooth',
                'description' => 'Perawatan dan pengobatan kesehatan gigi dan mulut dengan teknologi modern dan dokter gigi spesialis.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 17:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Anak',
                'icon' => 'baby',
                'description' => 'Pelayanan kesehatan khusus untuk bayi, balita, dan anak-anak dengan pendekatan yang ramah dan menyenangkan.',
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
                'name' => 'IGD (Gawat Darurat)',
                'icon' => 'ambulance',
                'description' => 'Unit Gawat Darurat yang siap melayani 24 jam dengan tim medis yang sigap, profesional, dan peralatan lengkap.',
                'operational_hours' => '24 Jam Non-Stop',
                'status' => 'active'
            ],
            [
                'name' => 'Laboratorium',
                'icon' => 'flask',
                'description' => 'Pemeriksaan laboratorium lengkap dan akurat dengan peralatan medis terbaru untuk diagnosis yang tepat.',
                'operational_hours' => 'Senin - Minggu: 06:00 - 22:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Jantung',
                'icon' => 'heart',
                'description' => 'Pelayanan spesialis jantung dengan EKG, treadmill test, dan pemeriksaan jantung komprehensif.',
                'operational_hours' => 'Senin - Jumat: 08:00 - 16:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Mata',
                'icon' => 'eye',
                'description' => 'Pelayanan kesehatan mata lengkap mulai dari pemeriksaan mata hingga tindakan operasi.',
                'operational_hours' => 'Senin - Sabtu: 08:00 - 17:00',
                'status' => 'active'
            ],
            [
                'name' => 'Poli Saraf',
                'icon' => 'brain',
                'description' => 'Pelayanan spesialis saraf untuk diagnosis dan penanganan gangguan sistem saraf.',
                'operational_hours' => 'Senin - Jumat: 09:00 - 15:00',
                'status' => 'active'
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}