<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomImage;
use Illuminate\Http\Request;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('images')->orderBy('price_per_night')->get();
        return view('admin.habitaciones.index', compact('rooms'));
    }

    public function show(Room $room)
    {
        $room->load('images');
        return view('admin.habitaciones.show', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name'              => ['required', 'string', 'max:100'],
            'description'       => ['required', 'string', 'max:1000'],
            'short_description' => ['required', 'string', 'max:200'],
            'price_per_night'   => ['required', 'numeric', 'min:0'],
            'capacity'          => ['required', 'integer', 'between:1,10'],
            'size_m2'           => ['required', 'integer', 'min:1'],
            'total_units'       => ['required', 'integer', 'between:1,50'],
        ]);

        $featuresRaw = $request->input('features_text', '');
        $features    = array_values(array_filter(
            array_map('trim', preg_split('/[\r\n,]+/', $featuresRaw)),
            fn($f) => $f !== '' && mb_strlen($f) <= 50
        ));

        if ((int) $validated['total_units'] < $room->total_units) {
            $activeCount = $room->reservations()
                ->whereIn('status', ['pending', 'confirmed'])
                ->where('check_out', '>', now()->toDateString())
                ->count();

            if ((int) $validated['total_units'] < $activeCount) {
                return back()->withInput()->withErrors([
                    'total_units' => "No podés reducir a {$validated['total_units']} unidades porque ya hay {$activeCount} reservas activas.",
                ]);
            }
        }

        $room->update(array_merge($validated, ['features' => $features]));

        return back()->with('success', 'Habitación actualizada correctamente.');
    }

    public function uploadPhotos(Request $request, Room $room)
    {
        $request->validate([
            'fotos'   => ['required', 'array', 'max:10'],
            'fotos.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $dir = public_path('images/hotel');
        if (! is_writable($dir)) {
            return back()->with('error', 'El directorio de imágenes no tiene permisos de escritura. Ejecutá: docker compose exec php chmod -R 775 public/images/hotel');
        }

        $hasExisting = $room->images()->exists();
        $maxOrder    = $room->images()->max('order') ?? -1;

        foreach ($request->file('fotos') as $i => $file) {
            $ext      = strtolower($file->getClientOriginalExtension());
            $filename = $room->slug . '-' . now()->format('YmdHis') . '-' . uniqid() . '.' . $ext;
            $file->move($dir, $filename);

            $room->images()->create([
                'path'       => 'images/hotel/' . $filename,
                'order'      => ++$maxOrder,
                'is_primary' => ! $hasExisting && $i === 0,
            ]);
        }

        return back()->with('success', count($request->file('fotos')) . ' foto(s) subida(s) correctamente.');
    }

    public function deletePhoto(RoomImage $image)
    {
        $wasPrimary = $image->is_primary;
        $room       = $image->room;

        if (file_exists(public_path($image->path))) {
            unlink(public_path($image->path));
        }

        $image->delete();

        if ($wasPrimary) {
            $room->images()->orderBy('order')->first()?->update(['is_primary' => true]);
        }

        return back()->with('success', 'Foto eliminada.');
    }

    public function setPrimary(RoomImage $image)
    {
        $image->room->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Foto principal actualizada.');
    }

    public function reorderPhoto(Request $request, RoomImage $image)
    {
        $request->validate(['direction' => ['required', 'in:up,down']]);

        $room    = $image->room;
        $ids     = $room->images()->orderBy('order')->pluck('id')->toArray();
        $pos     = array_search($image->id, $ids);

        if ($request->direction === 'up' && $pos > 0) {
            $sibling = RoomImage::find($ids[$pos - 1]);
        } elseif ($request->direction === 'down' && $pos < count($ids) - 1) {
            $sibling = RoomImage::find($ids[$pos + 1]);
        } else {
            return back();
        }

        [$image->order, $sibling->order] = [$sibling->order, $image->order];
        $image->save();
        $sibling->save();

        return back();
    }
}
