<?php

namespace Tests\Feature\MasterData;

use App\Models\Bidang;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class BidangTest extends TestCase
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

    public function test_index_page_loads(): void
    {
        $this->actingAs($this->admin())
            ->get('/bidang')
            ->assertStatus(200)
            ->assertSee('Daftar Bidang');
    }

    public function test_can_create_bidang(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post('/bidang', [
            'kode_bidang' => 'BID-TEST',
            'nama_bidang' => 'Bidang Feature Test',
            'deskripsi' => 'Test dari feature test',
            'status' => 'Aktif',
        ]);

        $response->assertRedirect('/bidang');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bidangs', [
            'nama_bidang' => 'Bidang Feature Test',
        ]);
    }

    public function test_create_bidang_validation_fails(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post('/bidang', [
            'nama_bidang' => '',
        ]);

        $response->assertSessionHasErrors(['kode_bidang', 'nama_bidang']);
    }

    public function test_can_update_bidang(): void
    {
        $this->actingAs($this->admin());

        $bidang = Bidang::create([
            'kode_bidang' => 'BID-UPD',
            'nama_bidang' => 'Before Update',
            'status' => 'Aktif',
        ]);

        $response = $this->put("/bidang/{$bidang->id}", [
            'kode_bidang' => 'BID-UPD',
            'nama_bidang' => 'After Update',
            'deskripsi' => 'Updated',
            'status' => 'Tidak Aktif',
        ]);

        $response->assertRedirect('/bidang');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('bidangs', [
            'id' => $bidang->id,
            'nama_bidang' => 'After Update',
            'status' => 'Tidak Aktif',
        ]);
    }

    public function test_can_delete_bidang(): void
    {
        $this->actingAs($this->admin());

        $bidang = Bidang::create([
            'kode_bidang' => 'BID-DEL',
            'nama_bidang' => 'To Delete',
            'status' => 'Aktif',
        ]);

        $response = $this->delete("/bidang/{$bidang->id}");
        $response->assertRedirect('/bidang');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('bidangs', ['id' => $bidang->id]);
    }

    public function test_guest_cannot_access_bidang(): void
    {
        $this->get('/bidang')->assertRedirect('/login');
        $this->post('/bidang', [])->assertRedirect('/login');
    }
}
