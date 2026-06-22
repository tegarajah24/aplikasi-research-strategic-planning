<?php

namespace Tests\Feature\MasterData;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KalenderTest extends TestCase
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

    public function test_kalender_page_loads(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get('/rkt/kalender');
        $response->assertStatus(200);
        $response->assertSee('Kalender');
    }

    public function test_kalender_shows_upcoming(): void
    {
        $this->actingAs($this->admin());

        $response = $this->get('/rkt/kalender');
        $response->assertStatus(200);
        $response->assertSee('Kegiatan Mendatang');
    }

    public function test_guest_cannot_access_kalender(): void
    {
        $this->get('/rkt/kalender')->assertRedirect('/login');
    }
}
