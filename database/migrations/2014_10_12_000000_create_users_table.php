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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('session_id')->nullable();
            $table->text('mnemonic');
            $table->text('payment_address')->nullable();
            $table->timestamp('last_seen')->nullable();
            $table->string('last_action')->nullable();
            $table->boolean('login_2fa')->default(false);
            $table->string('referral_code');
            $table->uuid('referred_by')->nullable();
            $table->text('bitmessage_address')->nullable();
            $table->text('pgp_key')->nullable();
            $table->text('identifier')->nullable();
            $table->longText('msg_public_key')->nullable();
            $table->longText('msg_private_key')->nullable();
            $table->timestamps();
            $table->foreign('referred_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
