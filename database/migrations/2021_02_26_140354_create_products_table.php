<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->integer('supplier_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->string('product_image')->nullable();
            $table->string('product_quantity');
            $table->string('product_stock');
            $table->integer('product_status');
            $table->double('buying_price', 15, 8);
            $table->double('selling_price', 15, 8);
            $table->datetime('buying_date')->nullable();
            $table->datetime('selling_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
