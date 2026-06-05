<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE reservations MODIFY payment_method ENUM('mercadopago') NOT NULL DEFAULT 'mercadopago'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE reservations MODIFY payment_method ENUM('qr','card') NOT NULL");
    }
};
