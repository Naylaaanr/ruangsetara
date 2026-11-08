<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            // Kelompok kebutuhan: fisik (disabilitas fisik / pengguna kursi roda)
            ['name' => 'Jalur landai (ramp)', 'need' => 'fisik'],
            ['name' => 'Toilet aksesibel', 'need' => 'fisik'],
            ['name' => 'Parkir khusus disabilitas', 'need' => 'fisik'],
            ['name' => 'Akses masuk tanpa tangga', 'need' => 'fisik'],
            ['name' => 'Lift aksesibel', 'need' => 'fisik'],

            // Kelompok kebutuhan: penglihatan (tunanetra / keterbatasan penglihatan)
            ['name' => 'Guiding block (jalur pemandu)', 'need' => 'penglihatan'],
            ['name' => 'Informasi braille', 'need' => 'penglihatan'],
            ['name' => 'Pengumuman audio', 'need' => 'penglihatan'],
            ['name' => 'Kontras warna dan pencahayaan jelas', 'need' => 'penglihatan'],

            // Kelompok kebutuhan: pendengaran (tunarungu / keterbatasan pendengaran)
            ['name' => 'Informasi visual (layar dan papan teks)', 'need' => 'pendengaran'],
            ['name' => 'Komunikasi tertulis atau bahasa isyarat dengan staf', 'need' => 'pendengaran'],
            ['name' => 'Alarm visual (lampu peringatan)', 'need' => 'pendengaran'],
        ];

        foreach ($facilities as $facility) {
            Facility::firstOrCreate(
                ['name' => $facility['name']],
                ['need' => $facility['need']]
            );
        }
    }
}
