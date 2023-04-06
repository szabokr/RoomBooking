<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use DatabaseTransactions;

    public $model = User::class;

    public function testRegister(): void
    {
        $body = [
            "name" => "Kiss János",
            "email" => "kissjancsi@gmail.com",
            "password" => "KissJanos1!",
            "phone" => "06303300120",
        ];

        $response = $this->json('POST', '/api/register', $body);
        $response->assertStatus(201)->assertJson(['success' => true]);
        $this->assertDatabaseHas($this->model, [
            'name' => 'Kiss János',
            'email' => 'kissjancsi@gmail.com',
            'phone' => '06303300120',
            'permission_id' => '2',
        ]);
    }

    public function testRegisterUserInDb(): void
    {
        User::create([
            "name" => "Kiss János",
            "email" => "kiss@gmail.com",
            "phone" => "0630330019",
        ]);

        $body = [
            'name' => 'Kiss János',
            "email" => "kiss@gmail.com",
            "phone" => "0630330019",
            "password" => "KissJanos1!",
            'permission_id' => '2',
        ];

        $response = $this->json('POST', '/api/register', $body);
        $response->assertStatus(201)->assertJson(['success' => true]);
    }
}
