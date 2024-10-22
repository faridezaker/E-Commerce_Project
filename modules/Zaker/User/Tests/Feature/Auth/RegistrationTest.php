<?php

namespace Zaker\User\Tests\Feature\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Zaker\User\Models\User;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
       $response = $this->registerNewUser();
       //$this->assertCount(1,User::all());

       $response->assertRedirect(route('verification.notice'));
    }

    public function test_verified_user_can_see_dashboard()
    {
        $this->registerNewUser();

        $this->assertAuthenticated();
        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('dashboard'));
        $response->assertOk();
    }
    public function registerNewUser()
    {
        return $this->post(route('register'), [
            'name' => 'faride',
            'email' => 'faridezaker9730@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }
}
