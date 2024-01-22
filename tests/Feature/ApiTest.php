<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;
    public function test_get_product(): void
    {
        $response = $this->get('api/');
        $response->assertStatus(200);
    }
    public function test_register(): void
    {
        $response = $this->postJson('/api/register', ['name' => 'Dummy', 'email' => 'Dummy@mail.com', 'password' => 'Dummy123']);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
    public function test_login(): void
    {
        $response = $this->postJson('/api/login', ['email' => 'admin@mail.com', 'password' => 'admin123']);
        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
}
