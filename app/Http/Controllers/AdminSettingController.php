<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function edit()
    {
        $whatsapp = Setting::get('whatsapp_number', '');

        return view('admin.configuracion', compact('whatsapp'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'whatsapp_number' => ['nullable', 'string', 'max:20'],
        ]);

        Setting::set('whatsapp_number', $request->input('whatsapp_number', ''));

        return back()->with('success', 'Configuración guardada correctamente.');
    }
}
