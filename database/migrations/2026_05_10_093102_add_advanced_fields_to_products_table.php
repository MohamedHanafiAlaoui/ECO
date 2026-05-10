<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdvancedFieldsToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('compare_at_price', 10, 2)->nullable()->after('price');
            $table->decimal('cost_price', 10, 2)->nullable()->after('compare_at_price');
            $table->string('sku')->nullable()->after('cost_price');
            $table->string('barcode')->nullable()->after('sku');
            $table->string('weight')->nullable()->after('barcode');
            $table->boolean('is_active')->default(true)->after('images');
            $table->string('meta_title')->nullable()->after('is_featured');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['compare_at_price', 'cost_price', 'sku', 'barcode', 'weight', 'meta_title', 'meta_description']);
        });
    }
}
