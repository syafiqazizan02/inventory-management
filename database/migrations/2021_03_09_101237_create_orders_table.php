<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id');
            $table->integer('customer_id');
            $table->double('sub_total', 15, 8)->nullable();
            $table->integer('discount')->nullable();
            $table->double('total', 15, 8)->nullable();
            $table->double('pay_amount', 15, 8)->nullable();
            $table->double('pay_balance', 15, 8)->nullable();
            $table->string('pay_method')->nullable();
            $table->datetime('order_date')->nullable();
            $table->string('order_month')->nullable();
            $table->year('order_year')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
