<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectToLoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectoDefaultToLogin()
    {
        $response = $this
        ->get('/')
        ->assertRedirect('login');;
    }
}
