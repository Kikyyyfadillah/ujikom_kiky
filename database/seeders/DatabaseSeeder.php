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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\jenis::create([
            'nama_jenis' => "makn"
        ]);


        \App\Models\jenis::create([
            'nama_jenis' => "num"
        ]);

        \App\Models\menu::create([
            'jenis_id' => 1,
            'nama_menu' => "ayam",
            'harga' => 2000,
            'image' => "fda",
            'deskripsi' => "snfj"
        ]);


        \App\Models\menu::create([
            'jenis_id' => 2,
            'nama_menu' => "mm minum",
            'harga' => 6000,
            'image' => "fda",
            'deskripsi' => "snfj"
        ]);
    }
}
