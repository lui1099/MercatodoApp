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
            $table->string('name', 50);
            $table->unsignedInteger('qty');
            $table->unsignedFloat('pricePerUnit');
            $table->unsignedFloat('pricePerItem');
            $table->smallInteger('product_id');
            $table->foreignId('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
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
        Schema::dropIfExists('cart_items');
    }
}
