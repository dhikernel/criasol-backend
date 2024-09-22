<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Diego Pereira',
            'email' => 'dhipereira21@gmail.com.br',
            'password' => bcrypt('password'),
        ]);

        \App\Domain\Scheduling\Models\Scheduling::factory(10)->create();

        \App\Domain\Doctor\Models\Doctor::factory(10)->create();
    }
}
