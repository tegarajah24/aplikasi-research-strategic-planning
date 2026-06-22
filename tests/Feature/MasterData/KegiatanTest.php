<?php

namespace Tests\Feature\MasterData;

use App\Models\Bidang;
use App\Models\Fakultas;
use App\Models\Kegiatan;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class KegiatanTest extends TestCase
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

    private function createFullHierarchy(): \App\Models\RenstraProgram
    {
        $fakultas = Fakultas::firstOrCreate(
            ['kode_fakultas' => 'FST'],
            ['nama_fakultas' => 'Fakultas Saintek', 'dekan' => 'Dr. Test']
        );

        $bidang = Bidang::firstOrCreate(
            ['kode_bidang' => 'BID-TEST'],
            ['nama_bidang' => 'Bidang Test', 'status' => 'Aktif']
        );

        $currentYear = date('Y');
        $renstra = \App\Models\Renstra::create([
            'fakultas_id' => $fakultas->id,
            'kode' => 'RST-KGT',
            'tahun_mulai' => $currentYear,
            'tahun_selesai' => $currentYear + 4,
        ]);

        $sasaran = \App\Models\RenstraSasaran::create([
            'renstra_id' => $renstra->id,
            'bidang_id' => $bidang->id,
            'nama_sasaran' => 'Sasaran Test',
            'urutan' => 1,
        ]);

        $strategi = \App\Models\RenstraStrategi::create([
            'sasaran_id' => $sasaran->id,
            'nama_strategi' => 'Strategi Test',
            'urutan' => 1,
        ]);

        return \App\Models\RenstraProgram::create([
            'strategi_id' => $strategi->id,
            'nama_program' => 'Program Kegiatan Test',
            'kode_program' => 'PRG-TEST',
            'status' => 'Aktif',
            'urutan' => 1,
        ]);
    }

    public function test_index_page_loads(): void
    {
        $this->actingAs($this->admin())
            ->get('/rkt/kegiatan')
            ->assertStatus(200)
            ->assertSee('Data Kegiatan Penelitian');
    }

    public function test_can_create_kegiatan(): void
    {
        $this->actingAs($this->admin());
        $program = $this->createFullHierarchy();

        $response = $this->post('/rkt/kegiatan', [
            'program_id' => $program->id,
            'kode_kegiatan' => '2.1.1',
            'nama_kegiatan' => 'Kegiatan Feature Test',
            'indikator_kinerja' => 'Test indikator',
            'target_kegiatan' => '100%',
            'penanggung_jawab' => 'LPPM',
            'tgl_mulai_pelaksanaan' => date('Y-m'),
            'tgl_selesai_pelaksanaan' => date('Y-m', strtotime('+2 months')),
            'tahun_akademik' => date('Y') . '/' . (date('Y') + 1),
            'kebutuhan_anggaran' => 'Anggaran Test',
            'status' => 'perencanaan',
        ]);

        $response->assertRedirect('/rkt/kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('rkt_kegiatan', [
            'nama_kegiatan' => 'Kegiatan Feature Test',
        ]);
    }

    public function test_create_kegiatan_validation_fails(): void
    {
        $this->actingAs($this->admin());

        $response = $this->post('/rkt/kegiatan', [
            'nama_kegiatan' => '',
            'program_id' => 99999,
        ]);

        $response->assertSessionHasErrors(['program_id', 'kode_kegiatan', 'nama_kegiatan',
            'indikator_kinerja', 'target_kegiatan', 'penanggung_jawab',
            'tgl_mulai_pelaksanaan', 'tgl_selesai_pelaksanaan', 'kebutuhan_anggaran', 'status']);
    }

    public function test_can_update_kegiatan(): void
    {
        $this->actingAs($this->admin());
        $program = $this->createFullHierarchy();
        $start = date('Y-m');
        $end = date('Y-m', strtotime('+2 months'));

        $kegiatan = Kegiatan::create([
            'program_id' => $program->id,
            'kode_kegiatan' => '2.1.1',
            'nama_kegiatan' => 'Before Update',
            'indikator_kinerja' => 'Test',
            'target_kegiatan' => '50%',
            'penanggung_jawab' => 'LPPM',
            'tgl_mulai_pelaksanaan' => \Carbon\Carbon::createFromFormat('Y-m', $start)->startOfMonth(),
            'tgl_selesai_pelaksanaan' => \Carbon\Carbon::createFromFormat('Y-m', $end)->endOfMonth(),
            'waktu_pelaksanaan' => 'Jan - Mar ' . date('Y'),
            'kebutuhan_anggaran' => 'Test',
            'status' => 'perencanaan',
        ]);

        $response = $this->put("/rkt/kegiatan/{$kegiatan->id}", [
            'program_id' => $program->id,
            'kode_kegiatan' => '2.1.1',
            'nama_kegiatan' => 'After Update',
            'indikator_kinerja' => 'Updated',
            'target_kegiatan' => '100%',
            'penanggung_jawab' => 'Dekan',
            'tgl_mulai_pelaksanaan' => $start,
            'tgl_selesai_pelaksanaan' => $end,
            'kebutuhan_anggaran' => 'Updated',
            'status' => 'berjalan',
        ]);

        $response->assertRedirect('/rkt/kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('rkt_kegiatan', [
            'id' => $kegiatan->id,
            'nama_kegiatan' => 'After Update',
            'status' => 'berjalan',
        ]);
    }

    public function test_can_delete_kegiatan(): void
    {
        $this->actingAs($this->admin());
        $program = $this->createFullHierarchy();
        $start = date('Y-m');

        $kegiatan = Kegiatan::create([
            'program_id' => $program->id,
            'kode_kegiatan' => '2.1.9',
            'nama_kegiatan' => 'To Delete',
            'indikator_kinerja' => 'Test',
            'target_kegiatan' => '100%',
            'penanggung_jawab' => 'LPPM',
            'tgl_mulai_pelaksanaan' => \Carbon\Carbon::createFromFormat('Y-m', $start)->startOfMonth(),
            'tgl_selesai_pelaksanaan' => \Carbon\Carbon::createFromFormat('Y-m', $start)->endOfMonth(),
            'waktu_pelaksanaan' => date('M Y'),
            'kebutuhan_anggaran' => 'Test',
            'status' => 'perencanaan',
        ]);

        $response = $this->delete("/rkt/kegiatan/{$kegiatan->id}");
        $response->assertRedirect('/rkt/kegiatan');
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('rkt_kegiatan', ['id' => $kegiatan->id]);
    }

    public function test_kegiatan_waktu_selesai_before_mulai_fails(): void
    {
        $this->actingAs($this->admin());
        $program = $this->createFullHierarchy();

        $response = $this->post('/rkt/kegiatan', [
            'program_id' => $program->id,
            'kode_kegiatan' => '2.1.2',
            'nama_kegiatan' => 'Test',
            'indikator_kinerja' => 'Test',
            'target_kegiatan' => '100%',
            'penanggung_jawab' => 'LPPM',
            'tgl_mulai_pelaksanaan' => '2026-12',
            'tgl_selesai_pelaksanaan' => '2026-01',
            'kebutuhan_anggaran' => 'Test',
            'status' => 'perencanaan',
        ]);

        $response->assertSessionHasErrors(['tgl_selesai_pelaksanaan']);
    }

    public function test_guest_cannot_access_kegiatan(): void
    {
        $this->get('/rkt/kegiatan')->assertRedirect('/login');
        $this->post('/rkt/kegiatan', [])->assertRedirect('/login');
    }
}
