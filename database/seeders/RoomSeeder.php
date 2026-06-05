<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $commonFeatures = [
            'WiFi gratis',
            'Aire acondicionado',
            'Calefacción central',
            'TV LED',
            'Caja fuerte',
            'Desayuno continental',
            'Habitación insonorizada',
        ];

        $rooms = [
            [
                'slug'              => 'standard-doble',
                'name'              => 'Habitación Standard',
                'short_description' => 'Doble con cama matrimonial o dos individuales, baño privado y luz natural.',
                'description'       => 'Habitación doble con cama matrimonial o dos individuales. Insonorizada, con luz natural, baño privado con ducha.',
                'capacity'          => 2,
                'size_m2'           => 18,
                'price_per_night'   => 69586.00,
                'icon'              => 'ti-bed',
                'image_url'         => '/images/hotel/doble-1.jpg',
                'features'          => $commonFeatures,
                'is_active'         => true,
                'total_units'       => 8,
            ],
            [
                'slug'              => 'triple',
                'name'              => 'Habitación Triple',
                'short_description' => 'Tres camas, ideal para grupos chicos o familias, baño privado.',
                'description'       => 'Habitación amplia con tres camas. Ideal para grupos chicos o familias. Insonorizada, baño privado.',
                'capacity'          => 3,
                'size_m2'           => 22,
                'price_per_night'   => 89829.00,
                'icon'              => 'ti-bed',
                'image_url'         => '/images/hotel/triple-1.jpg',
                'features'          => $commonFeatures,
                'is_active'         => true,
                'total_units'       => 4,
            ],
            [
                'slug'              => 'cuadruple',
                'name'              => 'Habitación Cuádruple',
                'short_description' => 'Cuatro camas para familias o grupos, baño privado con ducha.',
                'description'       => 'Habitación familiar con cuatro camas. Pensada para grupos o familias numerosas. Insonorizada, baño privado con ducha.',
                'capacity'          => 4,
                'size_m2'           => 28,
                'price_per_night'   => 105012.00,
                'icon'              => 'ti-bed',
                'image_url'         => '/images/hotel/cuadruple-1.jpg',
                'features'          => array_merge($commonFeatures, ['4 camas']),
                'is_active'         => true,
                'total_units'       => 4,
            ],
        ];

        foreach ($rooms as $room) {
            Room::updateOrCreate(['slug' => $room['slug']], $room);
        }
    }
}
