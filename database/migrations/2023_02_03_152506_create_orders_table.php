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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cart_id')->unsigned()->index();
            $table->bigInteger('city_id');
            $table->string('zip_code');
            $table->text('address');
            $table->bigInteger('shipping_cost')->default(30000);
            $table->bigInteger('final_price');
            $table->integer('status')->default(0);
            $table->string('code');
            $table->string('telephone');
            $table->dateTime('ordered_at');
            $table->dateTime('sent_at')->nullable();
            $table->dateTime('received_at')->nullable();

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
        Schema::dropIfExists('orders');
    }
};
