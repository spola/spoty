<?php

namespace Tests\Feature;

use App\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ActivityControllerTest extends TestCase
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
            ->get(route('student.activity.didit', [1]))
            ->assertRedirect('login');

        $response = $this
            ->put(route('student.activity.store', [1]))
            ->assertRedirect('login');

        $response = $this
            ->delete(route('student.activity.destroy', [1]))
            ->assertRedirect('login');
    }

    public function test200() {

        $user =  factory(User::class, 1)->create([
        ])->first();

        $this
            ->actingAs($user)
            ->get(route('student.activity.didit', [1]))
            ->assertStatus(404);

        $this
            ->actingAs($user)
            ->put(route('student.activity.store', [1]))
            ->assertStatus(404);

            $this
            ->actingAs($user)
            ->delete(route('student.activity.destroy', [1]))
            ->assertStatus(404);
    }

}
