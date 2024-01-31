<?php

namespace Tests\Feature;

use App\Models\User;
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
        $user = User::create([
            'name' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => bcrypt('testpassword'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'testpassword',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }
}
