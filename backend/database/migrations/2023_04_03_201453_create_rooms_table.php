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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id()->comment('Azonosító');
            $table->string('name')->comment('Szoba elnevezáse');
            $table->timestamps();
        });

        DB::table('rooms')->insert([
            [
                'name' => 'Szoba1',
            ],
            [
                'name' => 'Szoba2',
            ],
            [
                'name' => 'Szoba3',
            ],
            [
                'name' => 'Szoba4',
            ],
            [
                'name' => 'Szoba5',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
