<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->unsigned()->index();
            $table->bigInteger('cart_id')->unsigned()->index();
            $table->integer('count')->default(1);
            $table->bigInteger('old_price')->nullable();
            $table->timestamps();

            $table->foreign('product_id')->references('id')
            ->on('products')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('cart_id')->references('id')
            ->on('carts')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
