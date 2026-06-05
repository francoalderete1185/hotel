<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoomSeeder::class,
            RoomImageSeeder::class,
            AmenitySeeder::class,
            TestimonialSeeder::class,
            AdminSeeder::class,
            SettingSeeder::class,
        ]);
    }
}
