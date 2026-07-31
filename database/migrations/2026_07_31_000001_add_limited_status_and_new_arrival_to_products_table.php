<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (! Schema::hasColumn('products', 'is_new_arrival')) {
                $table->boolean('is_new_arrival')
                    ->default(false)
                    ->after('is_top_product');
            }

            if (Schema::hasColumn('products', 'description')) {
                $table->dropColumn('description');
            }

            if (Schema::hasColumn('products', 'discount_price')) {
                $table->dropColumn('discount_price');
            }
        });

        Schema::dropIfExists('product_variants');

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE products MODIFY status ENUM('in_stock', 'out_stock', 'limited') NOT NULL");
        }
    }

    public function down(): void
    {
        Product::where('status', 'limited')->update(['status' => 'in_stock']);

        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE products MODIFY status ENUM('in_stock', 'out_stock') NOT NULL");
        }

        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'is_new_arrival')) {
                $table->dropColumn('is_new_arrival');
            }

            if (! Schema::hasColumn('products', 'description')) {
                $table->longText('description')->nullable();
            }

            if (! Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 8, 2)->nullable();
            }
        });
    }
};
