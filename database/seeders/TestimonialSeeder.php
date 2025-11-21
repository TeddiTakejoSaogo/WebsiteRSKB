<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'patient_name' => 'Ahmad Fauzi',
                'patient_email' => 'ahmad.fauzi@example.com',
                'message' => 'Pelayanan IGD sangat cepat dan tanggap. Tim medis profesional dan sangat membantu. Terima kasih atas pelayanan yang diberikan!',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'patient_name' => 'Dewi Lestari',
                'patient_email' => 'dewi.lestari@example.com',
                'message' => 'Dokter spesialis anaknya sangat sabar menangani anak saya yang rewel. Fasilitasnya lengkap dan bersih. Recommended banget untuk keluarga!',
                'rating' => 5,
                'status' => 'approved'
            ],
            [
                'patient_name' => 'Budi Santoso',
                'patient_email' => 'budi.santoso@example.com',
                'message' => 'Pelayanan di rumah sakit ini sangat memuaskan. Dokter-dokternya ramah dan profesional. Ruangan bersih dan nyaman.',
                'rating' => 4,
                'status' => 'approved'
            ],
            [
                'patient_name' => 'Siti Rahayu',
                'patient_email' => 'siti.rahayu@example.com',
                'message' => 'Perawat sangat perhatian kepada pasien. Proses administrasi juga cepat dan mudah. Terima kasih untuk pelayanan terbaiknya.',
                'rating' => 5,
                'status' => 'pending'
            ]
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}