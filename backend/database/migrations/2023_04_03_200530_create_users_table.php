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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('Azonosító');
            $table->bigInteger('permission_id')->unsigned()->default(1)->comment('Jogosultság azonosító');
            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->string('name', 100)->comment('Név');
            $table->string('email', 320)->comment('E-mail');
            $table->string('phone', 11)->comment('Telefonszám');
            $table->string('password', 255)->nullable()->comment('Jelszó');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
