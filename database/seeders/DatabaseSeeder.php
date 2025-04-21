<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\MovieSeeder;
use Database\Factories\MovieFactory;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //seeder
        $this->call(CategorySeeder::class);
        $this->call(MovieSeeder::class);

        //factory
        Movie::factory(100)->create();
        // MovieFactory::new()->count(10)->create();
    }
}
