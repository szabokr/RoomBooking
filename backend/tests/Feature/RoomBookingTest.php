<?php

namespace Tests\Feature;

use App\Models\RoomBookings;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomBookingTest extends TestCase
{
    use DatabaseTransactions;

    public $model = RoomBookings::class;

    public function testRoomBookingWithoutLogin()
    {
        $body = [
            "room_id" => 2,
            "name" => "TesztGuest",
            "email" => "testguest@guest.hu",
            "phone" => "06300000001",
            "date_of_arrive" => "2023-05-01",
            "date_of_departure" => "2023-05-10"
        ];

        $response = $this->json('POST', '/api/roombooking', $body);
        $response->assertStatus(201)->assertJson([
            'success' => true,
        ]);
    }

    public function testRoomBookingWithLogin()
    {
        $body = [
            "email" => "admin@admin.hu",
            "password" => "admin",
        ];
        $response = $this->json('POST', '/api/login', $body);
        $token = json_decode($response->getContent(), true)['token'];
        $headder = [
            'Authorization' => 'Bearer ' . $token,
        ];
        $body = [
            "room_id" => 2,
            "name" => "TesztGuest",
            "email" => "admin@admin.hu",
            "phone" => "06000000000",
            "date_of_arrive" => "2023-07-01",
            "date_of_departure" => "2023-07-10"
        ];

        $response = $this->json('POST', '/api/user/roombooking', $body, $headder);
        $response->assertStatus(201)->assertJson([
            'success' => true,
        ]);
    }
}
