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
        Schema::create('digital_products', function (Blueprint $table) {
            $table->uuid('id');
            // digital delivery field
            $table->boolean('autodelivery')->default(false);
            $table->text('content')->nullable(); // content for autodelivery
            $table->timestamps();
            // keys
            $table->primary('id');
            $table->foreign('id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('digital_products');
    }
};
