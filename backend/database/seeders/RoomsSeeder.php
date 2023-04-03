<?php

namespace Database\Seeders;

use App\Models\Rooms;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
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
        ];

        Rooms::insert($permissions);
    }
}
