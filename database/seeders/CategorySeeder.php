<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Fasilitas Publik',
            'Tempat Ibadah',
            'Pendidikan',
            'Kesehatan',
            'Transportasi',
            'Kuliner dan Wisata',
        ];

        foreach ($categories as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
