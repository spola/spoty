<?php

namespace Tests\Feature;

use App\User;
use App\Grade;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeControllerTest extends TestCase
{

    use RefreshDatabase;

    /**
     * setUp
     *
     * @return voidContrato
     */
	public function setUp(): void {

        parent::setUp();
        $this->artisan('db:seed');
    }

    public function testRedirectToLogin()
    {
        $response = $this
            ->get(route('student.home'))
            ->assertRedirect('login');

        $response = $this
            ->get(route('student.land'))
            ->assertRedirect('login');
    }

    public function test200() {

        $user =  factory(User::class, 1)->create([
            'is_student' => true,
            'grade_id' => Grade::first()->id
        ])->first();

        $this
            ->actingAs($user)
            ->get(route('student.home'))
            ->assertStatus(200);

        $this
            ->actingAs($user)
            ->get(route('student.land'))
            ->assertStatus(200);
    }

}
