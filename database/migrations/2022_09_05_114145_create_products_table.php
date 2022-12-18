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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->string('shortdescription', 200);
            $table->text('fulldescription')->nullable();
            $table->integer('discount')->default(0);
            $table->decimal('price', 10, 2, true)->default(0);
            $table->string('weight', 50);
            $table->string('image')->nullable();
            $table->string('sub_category_slug')->nullable();
            $table->timestamps();

            $table->foreign('sub_category_slug')
                ->references('slug')
                ->on('sub_categories')
                ->cascadeOnUpdate()
                ->nullOnDelete();
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
};
