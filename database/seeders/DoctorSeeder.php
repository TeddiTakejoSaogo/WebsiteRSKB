<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorSchedule;

class DoctorSeeder extends Seeder
{
    public function run()
    {
        $doctors = [
            [
                'name' => 'Dr. Ahmad Wijaya, Sp.PD',
                'specialization' => 'Penyakit Dalam',
                'education' => 'Universitas Indonesia',
                'description' => 'Spesialis penyakit dalam dengan pengalaman 10 tahun dalam menangani berbagai kasus medis.',
                'experience' => '10 tahun',
                'status' => 'active'
            ],
            [
                'name' => 'Dr. Sari Dewi, Sp.A',
                'specialization' => 'Anak',
                'education' => 'Universitas Gadjah Mada',
                'description' => 'Spesialis anak yang sabar dan berpengalaman dalam menangani kesehatan anak dan balita.',
                'experience' => '8 tahun',
                'status' => 'active'
            ],
            [
                'name' => 'Dr. Budi Santoso, Sp.B',
                'specialization' => 'Bedah',
                'education' => 'Universitas Airlangga',
                'description' => 'Spesialis bedah dengan keahlian dalam operasi umum dan khusus.',
                'experience' => '12 tahun',
                'status' => 'active'
            ]
        ];

        foreach ($doctors as $doctorData) {
            try {
                $doctor = Doctor::create($doctorData);
                $this->command->info("Doctor created: {$doctor->name}");

                // Add schedules for each doctor
                $schedules = [
                    ['day' => 'monday', 'start_time' => '08:00', 'end_time' => '12:00'],
                    ['day' => 'wednesday', 'start_time' => '13:00', 'end_time' => '17:00'],
                    ['day' => 'friday', 'start_time' => '08:00', 'end_time' => '15:00']
                ];

                foreach ($schedules as $schedule) {
                    DoctorSchedule::create(array_merge($schedule, ['doctor_id' => $doctor->id]));
                    $this->command->info("Schedule created for doctor: {$doctor->name}");
                }

            } catch (\Exception $e) {
                $this->command->error("Error creating doctor: " . $e->getMessage());
            }
        }
    }
}