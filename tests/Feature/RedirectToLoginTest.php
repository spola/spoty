<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectToLoginTest extends TestCase
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

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectoDefaultToLogin()
    {
        $response = $this
            ->get('/')
            ->assertRedirect('login');
    }

    public function testRedirectToHome() {


        $user =  factory(User::class, 1)->create([
            'is_student' => true,
        ])->first();

        $response = $this
            ->actingAs($user)
            ->get('/')
            ->assertRedirect(route('student.home'));


            $user =  factory(User::class, 1)->create([
                'is_parent' => true,
            ])->first();

            $response = $this
                ->actingAs($user)
                ->get('/')
                ->assertRedirect(route('parents.home'));
    }
}
