<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class AdminReservationController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'all');

        $query = Reservation::with('room')->orderByDesc('created_at');

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $reservations = $query->get();
        $counts = [
            'all'       => Reservation::count(),
            'pending'   => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];

        return view('admin.reservas.index', compact('reservations', 'status', 'counts'));
    }

    public function updateStatus(Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => ['required', 'in:pending,confirmed,cancelled'],
        ]);

        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Estado de reserva actualizado.');
    }
}
