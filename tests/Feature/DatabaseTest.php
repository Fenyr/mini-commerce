<?php

namespace Tests\Feature;

use Tests\TestCase;

class DatabaseTest extends TestCase
{

    public function test_seeding_into_application(): void
    {
        $this->artisan('migrate:fresh --seed');
        $this->assertTrue(true);
    }
}
