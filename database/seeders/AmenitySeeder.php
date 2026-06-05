<?php

namespace Database\Seeders;

use App\Models\Amenity;
use Illuminate\Database\Seeder;

class AmenitySeeder extends Seeder
{
    public function run(): void
    {
        $amenities = [
            [
                'icon'        => 'ti-wifi',
                'title'       => 'WiFi gratis',
                'description' => 'Conexión de alta velocidad en todo el hotel',
                'order'       => 1,
            ],
            [
                'icon'        => 'ti-coffee',
                'title'       => 'Desayuno continental',
                'description' => 'Incluido en todas las tarifas',
                'order'       => 2,
            ],
            [
                'icon'        => 'ti-bell',
                'title'       => 'Recepción 24 horas',
                'description' => 'Atención personalizada cuando la necesites',
                'order'       => 3,
            ],
            [
                'icon'        => 'ti-lock',
                'title'       => 'Caja fuerte personal',
                'description' => 'En cada habitación',
                'order'       => 4,
            ],
            [
                'icon'        => 'ti-temperature',
                'title'       => 'Climatización',
                'description' => 'AC individual y calefacción central',
                'order'       => 5,
            ],
            [
                'icon'        => 'ti-luggage',
                'title'       => 'Guardaequipaje',
                'description' => 'Antes del check-in y después del check-out',
                'order'       => 6,
            ],
        ];

        foreach ($amenities as $amenity) {
            Amenity::create($amenity);
        }
    }
}
