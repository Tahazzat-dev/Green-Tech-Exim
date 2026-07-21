<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->integer('discount')
                ->default(0);

            $table->string('phone')
                ->unique();

            $table->string('shop_name');

            $table->string('city_area');

            $table->string('photo')
                ->nullable();

            $table->string('pin');

            $table->string('plain_pin')
                ->nullable();

            $table->enum('status', [
                'pending',
                'approved',
                'rejected',
                'blocked',
            ])->default('pending');

            $table->string('device_id')
                ->nullable();

            $table->boolean('device_change_allowed')
                ->default(false);

            $table->rememberToken();

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('privacy_policies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Privacy Policy');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('whatsapp_phone')->nullable();
            $table->string('facebook_page_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
        Schema::dropIfExists('privacy_policies');
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
