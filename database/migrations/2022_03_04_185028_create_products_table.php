<?php

use App\Models\Product;
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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 100);
            $table->text('description');
            $table->text('rules');
            $table->string('types')->default('normal');
            $table->integer('quantity');
            $table->enum('count_type', array_keys(Product::$count_types))->default(Product::DEFAULT_COUNT_TYPE);
            $table->boolean('active')->default(true);
            $table->text('coins');
            $table->uuid('category_id');
            $table->uuid('user_id')->default("1");
            $table->timestamps();
            // keys
            $table->primary('id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('user_id')->references('id')->on('vendors')->onDelete('cascade'); // delete users products
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
