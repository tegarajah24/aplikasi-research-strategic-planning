<?php

namespace Tests\Feature\MasterData;

use App\Models\Fakultas;
use App\Models\Bidang;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RenstraTest extends TestCase
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

    protected function setUp(): void
    {
        parent::setUp();
        Fakultas::firstOrCreate(
            ['kode_fakultas' => 'FST'],
            ['nama_fakultas' => 'Fakultas Saintek', 'dekan' => 'Dr. Test']
        );
        Bidang::firstOrCreate(
            ['kode_bidang' => 'BID-TEST'],
            ['nama_bidang' => 'Bidang Test', 'status' => 'Aktif']
        );
    }

    public function test_index_page_loads(): void
    {
        $this->actingAs($this->admin())
            ->get('/renstra')
            ->assertStatus(200)
            ->assertSee('Hierarki RENSTRA');
    }

    public function test_can_create_renstra_with_full_hierarchy(): void
    {
        $this->actingAs($this->admin());

        $fakultas = Fakultas::first();
        $this->assertNotNull($fakultas, 'Butuh minimal 1 fakultas');

        $bidang = Bidang::first();
        $this->assertNotNull($bidang, 'Butuh minimal 1 bidang');

        $currentYear = date('Y');

        $response = $this->post('/renstra', [
            'fakultas_id' => $fakultas->id,
            'kode' => 'RST-TEST',
            'tahun_mulai' => $currentYear,
            'tahun_selesai' => $currentYear + 4,
            'sasarans' => [
                [
                    'bidang_id' => $bidang->id,
                    'kode_sasaran' => 'SS1',
                    'nama_sasaran' => 'Sasaran Test Feature',
                    'strategis' => [
                        [
                            'nama_strategi' => 'Strategi Test Feature',
                            'programs' => [
                                ['nama_program' => 'Program Test Feature'],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $response->assertRedirect('/renstra');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('renstra', ['kode' => 'RST-TEST']);
        $this->assertDatabaseHas('renstra_sasaran', ['nama_sasaran' => 'Sasaran Test Feature']);
        $this->assertDatabaseHas('renstra_strategi', ['nama_strategi' => 'Strategi Test Feature']);
        $this->assertDatabaseHas('renstra_program', ['nama_program' => 'Program Test Feature']);
    }

    public function test_create_renstra_validation_fails(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post('/renstra', [
            'tahun_mulai' => '',
            'sasarans' => [],
        ]);

        $response->assertSessionHasErrors(['tahun_mulai', 'tahun_selesai', 'sasarans']);
    }

    public function test_can_update_renstra_sasarans(): void
    {
        $this->actingAs($this->admin());

        $fakultas = Fakultas::first();
        $bidang = Bidang::first();
        $currentYear = date('Y');

        $response = $this->post('/renstra', [
            'fakultas_id' => $fakultas->id,
            'kode' => 'RST-UPD',
            'tahun_mulai' => $currentYear,
            'tahun_selesai' => $currentYear + 4,
            'sasarans' => [
                [
                    'bidang_id' => $bidang->id,
                    'nama_sasaran' => 'Sasaran Before Update',
                    'strategis' => [
                        ['nama_strategi' => 'Strategi 1', 'programs' => []],
                    ],
                ],
            ],
        ]);

        $renstra = \App\Models\Renstra::where('kode', 'RST-UPD')->firstOrFail();
        $sasaran = $renstra->sasarans()->firstOrFail();

        $response = $this->put("/renstra/{$renstra->id}", [
            'fakultas_id' => $fakultas->id,
            'kode' => 'RST-UPD',
            'tahun_mulai' => $currentYear,
            'tahun_selesai' => $currentYear + 4,
            'sasarans' => [
                [
                    'id' => $sasaran->id,
                    'bidang_id' => $bidang->id,
                    'nama_sasaran' => 'Sasaran After Update',
                    'strategis' => [
                        ['nama_strategi' => 'Strategi Updated', 'programs' => []],
                    ],
                ],
            ],
        ]);

        $response->assertRedirect('/renstra');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('renstra_sasaran', [
            'id' => $sasaran->id,
            'nama_sasaran' => 'Sasaran After Update',
        ]);
    }

    public function test_can_delete_renstra(): void
    {
        $this->actingAs($this->admin());

        $fakultas = Fakultas::first();
        $bidang = Bidang::first();
        $currentYear = date('Y');

        $this->post('/renstra', [
            'fakultas_id' => $fakultas->id,
            'kode' => 'RST-DEL',
            'tahun_mulai' => $currentYear,
            'tahun_selesai' => $currentYear + 4,
            'sasarans' => [
                [
                    'bidang_id' => $bidang->id,
                    'nama_sasaran' => 'To Delete',
                    'strategis' => [
                        ['nama_strategi' => 'To Delete', 'programs' => []],
                    ],
                ],
            ],
        ]);

        $renstra = \App\Models\Renstra::where('kode', 'RST-DEL')->firstOrFail();

        $response = $this->delete("/renstra/{$renstra->id}");
        $response->assertRedirect('/renstra');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('renstra', ['id' => $renstra->id]);
    }

    public function test_guest_cannot_access_renstra(): void
    {
        $this->get('/renstra')->assertRedirect('/login');
        $this->post('/renstra', [])->assertRedirect('/login');
    }
}
