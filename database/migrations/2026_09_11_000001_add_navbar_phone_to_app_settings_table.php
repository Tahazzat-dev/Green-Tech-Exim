<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            if (! Schema::hasColumn('app_settings', 'navbar_phone')) {
                $table->string('navbar_phone')->nullable()->after('whatsapp_phone');
            }
        });

        if (Schema::hasColumn('app_settings', 'navbar_phone')) {
            DB::table('app_settings')
                ->where('id', 1)
                ->whereNull('navbar_phone')
                ->update(['navbar_phone' => '01777524051']);
        }
    }

    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            if (Schema::hasColumn('app_settings', 'navbar_phone')) {
                $table->dropColumn('navbar_phone');
            }
        });
    }
};
