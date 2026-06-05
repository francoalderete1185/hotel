<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Database\Seeder;

class RoomImageSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'standard-doble' => [
                'doble-1.jpg',
                'doble-2.jpg',
                'doble-3.jpg',
                'doble-4.jpg',
                'doble-5.jpg',
            ],
            'triple' => [
                'triple-1.jpg',
                'triple-2.jpg',
                'triple-3.jpg',
                'triple-4.jpg',
            ],
            'cuadruple' => [
                'cuadruple-1.jpg',
                'cuadruple-2.jpg',
                'cuadruple-3.jpg',
            ],
        ];

        foreach ($map as $slug => $files) {
            $room = Room::where('slug', $slug)->first();
            if (! $room) {
                continue;
            }

            foreach ($files as $index => $file) {
                $path = 'images/hotel/' . $file;
                if (! file_exists(public_path($path))) {
                    continue;
                }

                RoomImage::create([
                    'room_id'    => $room->id,
                    'path'       => $path,
                    'order'      => $index,
                    'is_primary' => $index === 0,
                ]);
            }
        }
    }
}
