<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $response = $this->post('/api/login', [
            'email' => 'admin@example.com',
            'password' => '123456',
        ]);

        $response->assertStatus(200);
    }

}
