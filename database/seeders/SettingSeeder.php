<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        Setting::set('mp_payment_link', '');
        Setting::set('whatsapp_number', '');
    }
}
