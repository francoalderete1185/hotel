<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class ReservationController extends Controller
{
    public function select(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'check_in'  => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests'    => ['required', 'integer', 'min:1', 'max:4'],
        ]);

        if ($validator->fails()) {
            return redirect('/')->with('error', 'Verificá las fechas y la cantidad de huéspedes antes de continuar.');
        }

        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;
        $guests   = (int) $request->guests;
        $nights   = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));

        $rooms = Room::active()
            ->with('images')
            ->orderBy('price_per_night')
            ->get()
            ->map(function (Room $room) use ($checkIn, $checkOut, $guests, $nights) {
                $room->available_units = $room->availableUnitsBetween($checkIn, $checkOut);
                $room->date_available  = $room->available_units >= 1;
                $room->capacity_ok     = $room->capacity >= $guests;
                $room->subtotal        = $room->price_per_night * $nights;
                $room->selectable      = $room->date_available && $room->capacity_ok;
                return $room;
            });

        return view('reservations.select', compact(
            'rooms', 'checkIn', 'checkOut', 'guests', 'nights'
        ));
    }

    public function checkout(Request $request): mixed
    {
        $validator = Validator::make($request->all(), [
            'room'      => ['required', 'string'],
            'check_in'  => ['required', 'date', 'after_or_equal:today'],
            'check_out' => ['required', 'date', 'after:check_in'],
            'guests'    => ['required', 'integer', 'min:1', 'max:4'],
        ]);

        if ($validator->fails()) {
            return redirect('/')->with('error', 'Parámetros de reserva inválidos.');
        }

        $room = Room::active()->where('slug', $request->room)->firstOrFail();

        $checkIn  = $request->check_in;
        $checkOut = $request->check_out;
        $guests   = (int) $request->guests;
        $nights   = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));

        $available = $room->availableUnitsBetween($checkIn, $checkOut) >= 1;

        if (! $available || $room->capacity < $guests) {
            return redirect(route('reservation.select', [
                'check_in'  => $checkIn,
                'check_out' => $checkOut,
                'guests'    => $guests,
            ]))->with('error', 'Esa habitación ya no está disponible. Elegí otra.');
        }

        $subtotal = $room->price_per_night * $nights;

        return view('reservations.payment', compact(
            'room', 'checkIn', 'checkOut', 'guests', 'nights', 'subtotal'
        ));
    }

    public function store(Request $request): mixed
    {
        $validated = $request->validate([
            'room_slug'   => ['required', 'string'],
            'check_in'    => ['required', 'date', 'after_or_equal:today'],
            'check_out'   => ['required', 'date', 'after:check_in'],
            'guests'      => ['required', 'integer', 'min:1', 'max:4'],
            'guest_name'  => ['required', 'string', 'max:150'],
            'guest_email' => ['required', 'email', 'max:150'],
            'guest_phone' => ['required', 'string', 'max:30'],
        ]);

        $room = Room::active()->where('slug', $validated['room_slug'])->firstOrFail();

        try {
            $reservation = DB::transaction(function () use ($room, $validated) {
                $availableUnits = $room->availableUnitsBetween(
                    $validated['check_in'],
                    $validated['check_out'],
                    lock: true
                );

                if ($availableUnits < 1) {
                    throw new \RuntimeException('overbooking');
                }

                $nights      = Carbon::parse($validated['check_in'])->diffInDays(Carbon::parse($validated['check_out']));
                $totalAmount = $room->price_per_night * $nights;

                return Reservation::create([
                    'code'           => $this->generateCode(),
                    'room_id'        => $room->id,
                    'guest_name'     => $validated['guest_name'],
                    'guest_email'    => $validated['guest_email'],
                    'guest_phone'    => $validated['guest_phone'],
                    'check_in'       => $validated['check_in'],
                    'check_out'      => $validated['check_out'],
                    'guests_count'   => $validated['guests'],
                    'total_amount'   => $totalAmount,
                    'payment_method' => 'mercadopago',
                    'status'         => 'pending',
                ]);
            });
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'overbooking') {
                return back()->with('error', 'La habitación fue reservada mientras completabas el formulario. Por favor elegí otra.');
            }
            throw $e;
        }

        return redirect(route('reservation.confirmation', $reservation->code));
    }

    public function confirmation(string $code): View
    {
        $reservation = Reservation::with('room')->where('code', $code)->firstOrFail();

        return view('reservations.confirmation', compact('reservation'));
    }

    private function generateCode(): string
    {
        $alphabet = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
        $len      = strlen($alphabet);

        do {
            $part1 = $part2 = '';
            for ($i = 0; $i < 4; $i++) {
                $part1 .= $alphabet[random_int(0, $len - 1)];
                $part2 .= $alphabet[random_int(0, $len - 1)];
            }
            $code = $part1 . '-' . $part2;
        } while (Reservation::where('code', $code)->exists());

        return $code;
    }
}
