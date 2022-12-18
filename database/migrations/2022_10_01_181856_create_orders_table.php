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
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('day')->nullable();
            $table->string('partday')->nullable();
            $table->longText('cart_data');
            $table->integer('totalQuantity')->nullable();
            $table->float('subTotal', 8, 2)->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
            ->onUpdate('cascade')->onDelete('set null');
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
