<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

        public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {

            $table->id();
            $table->string('name');
            $table->string('qty');
            $table->unsignedFloat('pricePerUnit');
            $table->unsignedFloat('pricePerItem');
            $table->foreignId('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
