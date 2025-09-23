<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('product_id');
            $table->text('image');
            $table->boolean('first');
            $table->timestamps();
            $table->primary('id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade'); // delete images when deleting products
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
};
