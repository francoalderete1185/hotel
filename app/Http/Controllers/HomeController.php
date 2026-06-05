<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Room;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $rooms       = Room::active()->with('images')->orderBy('price_per_night')->get();
        $amenities   = Amenity::orderBy('order')->get();
        $testimonials = Testimonial::featured()->orderBy('id')->get();

        return view('home', compact('rooms', 'amenities', 'testimonials'));
    }
}
