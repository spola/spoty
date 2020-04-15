<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChangePasswordControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * setUp
     *
     * @return voidContrato
     */
	public function setUp(): void {

        parent::setUp();
        //$this->artisan('db:seed');
    }

    public function testRedirectToLogin()
    {
        $response = $this
            ->get(route('change.password'))
            ->assertRedirect('login');

        $response = $this
            ->post(route('change.password.store'))
            ->assertRedirect('login');
    }

    public function test200() {

        $user =  factory(User::class, 1)->create([
        ])->first();

        $this
            ->actingAs($user)
            ->get(route('change.password'))
            ->assertStatus(200);
    }

}
