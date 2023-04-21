<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('promotion_users', function (Blueprint $table) {

            $table->bigInteger('promotion_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            // Leaving timestamps to be aware when a user used certain promo code
            $table->timestamps();

            $table->unique(['promotion_id', 'user_id']);
            $table->foreign('promotion_id')->references('id')->on('promotions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_users');
    }
};
