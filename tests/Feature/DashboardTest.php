<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use DatabaseTransactions;

    protected function admin(): User
    {
        return User::firstOrCreate(
            ['username' => 'testuser'],
            [
                'name' => 'Test Admin',
                'email' => 'test@example.com',
                'password' => Hash::make('password'),
                'role' => 'Admin',
            ]
        );
    }

    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Username');
        $response->assertSee('Password');
    }

    public function test_admin_can_login(): void
    {
        $this->admin();

        $response = $this->post('/login', [
            'username' => 'testuser',
            'password' => 'password',
        ]);
        $response->assertRedirect('/dashboard');
        $this->assertAuthenticated();
    }

    public function test_dashboard_loads_for_admin(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_dashboard_shows_overview_stats(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get('/dashboard');
        $response->assertStatus(200);
    }

    public function test_sidebar_has_no_program_link(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get('/dashboard');
        $response->assertDontSee('master-data/program');
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $this->get('/dashboard')->assertRedirect('/login');
    }
}
