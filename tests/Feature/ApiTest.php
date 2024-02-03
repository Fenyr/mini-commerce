<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{

    protected $user;
    protected $token;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->token = $this->user->createToken('test-token')->plainTextToken;
    }

    public function test_auth_register(): void
    {
        $response = $this->postJson('/api/register', [
            'name' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'testpassword'
        ]);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
    public function test_auth_login(): void
    {
        $response = $this->postJson('/api/login', [
            'email' => 'testuser@example.com',
            'password' => 'testpassword',
        ]);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_get_product(): void
    {
        $response = $this->get('api/');
        $response->assertStatus(200);
    }

    public function test_no_auth_access(): void
    {
        $response = $this->postJson('/api/cart/add', [
            'product_id' => 1,
        ]);

        $response->assertStatus(401);
    }

    public function test_add_cart(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response = $this->withHeaders($head)->postJson('/api/cart/add', [
            'product_id' => 1,
        ]);

        $response->assertStatus(200);
    }
    public function test_increase_cart(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response = $this->withHeaders($head)->postJson('/api/cart/increase/1');

        $response->assertStatus(200);
    }
    public function test_decrease_cart(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response = $this->withHeaders($head)->postJson('/api/cart/decrease/1');

        $response->assertStatus(200);
    }

    public function test_add_order(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $this->withHeaders($head)->postJson('/api/cart/add', [
            'product_id' => 1,
        ]);

        $response = $this->withHeaders($head)->postJson('/api/order/add');
        $response->assertStatus(200);
    }
    public function test_check_cart(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response =  $this->withHeaders($head)->get('/api/cart/');
        $response->assertStatus(200);
    }
    public function test_failed_order_with_no_cart(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response = $this->withHeaders($head)->postJson('/api/order/add');
        $response->assertStatus(401);
    }
    public function test_auth_logout(): void
    {
        $head = [
            'Authorization' => 'Bearer ' . $this->token
        ];
        $response = $this->withHeaders($head)->post('/api/logout');
        $response->assertStatus(200);
    }
}
