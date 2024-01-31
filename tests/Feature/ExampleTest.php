<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_seeding_into_application(): void
    {
        $this->artisan('migrate:fresh --seed');
        $this->assertTrue(true);
    }
}
