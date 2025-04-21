<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'nama_kategori' => 'Horror',
                'keterangan' => 'Film Horror'
            ],
            [
                'nama_kategori' => 'Action',
                'keterangan' => 'Film Action'
            ],
            [
                'nama_kategori' => 'Sci-fi',
                'keterangan' => 'Film Science Fiction'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
