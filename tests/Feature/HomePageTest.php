<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;
    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee('Masuk');
    }

    public function test_login_page_is_available(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    public function test_login_page_redirects_when_user_is_authenticated(): void
    {
        $user = User::create([
            'name_user' => 'Test Customer',
            'email_user' => 'test-customer@example.com',
            'role' => 'customer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        $response = $this->get('/login');

        $response->assertRedirect('/user');
    }

    public function test_valid_customer_login_redirects_to_user_page(): void
    {
        $user = User::create([
            'name_user' => 'Test Customer',
            'email_user' => 'valid-customer@example.com',
            'role' => 'customer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password123'),
        ]);

        $response = $this->post('/login', [
            'email_user' => $user->email_user,
            'password' => 'password123',
        ]);

        $response->assertRedirect('/user');
        $this->assertAuthenticatedAs($user);
    }

    public function test_register_page_is_available(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_register_page_redirects_when_user_is_authenticated(): void
    {
        $user = User::create([
            'name_user' => 'Test Customer',
            'email_user' => 'test-customer@example.com',
            'role' => 'customer',
            'is_active' => true,
            'login_with' => 'email',
            'password_hash' => Hash::make('password123'),
        ]);

        $this->actingAs($user);

        $response = $this->get('/register');

        $response->assertRedirect('/user');
    }

    public function test_valid_customer_registration_creates_user_and_redirects_to_user_page(): void
    {
        $response = $this->post('/register', [
            'name_user' => 'Baru Banget',
            'email_user' => 'baru@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/user');
        $this->assertDatabaseHas('user', [
            'email_user' => 'baru@example.com',
            'name_user' => 'Baru Banget',
            'role' => 'customer',
        ]);

        $user = User::where('email_user', 'baru@example.com')->first();
        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);

        // Pastikan Customer record juga dibuat
        $this->assertDatabaseHas('customer', [
            'id_user' => $user->id_user,
        ]);
    }
}
