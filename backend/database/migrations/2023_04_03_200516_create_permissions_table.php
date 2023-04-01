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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id()->comment('Azonosító');
            $table->string('permission', 5)->comment('Jogosultság');
            $table->timestamps();
        });

        DB::table('permissions')->insert([
            [
                'permission' => 'Guest',
            ],
            [
                'permission' => 'User',
            ],
            [
                'permission' => 'Admin',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
