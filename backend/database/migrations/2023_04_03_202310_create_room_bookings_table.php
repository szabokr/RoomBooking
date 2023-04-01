<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('room_bookings', function (Blueprint $table) {
            $table->id()->comment('Azonosító');
            $table->bigInteger('room_id')->unsigned()->comment('Szoba azonosító');
            $table->foreign('room_id')->references('id')->on('rooms');
            $table->bigInteger('user_id')->unsigned()->comment('Felhasználó azonosító');
            $table->foreign('user_id')->references('id')->on('users');
            $table->date('date_of_arrive')->comment('Érkezés dátuma');
            $table->date('date_of_departure')->comment('Távozás dátuma');
            $table->boolean('status')->default(0)->comment('Foglalás státusza');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_bookings');
    }
};
