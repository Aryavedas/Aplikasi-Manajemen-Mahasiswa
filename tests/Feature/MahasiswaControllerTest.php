<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MahasiswaControllerTest extends TestCase
{
    use RefreshDatabase;

    /* =========================
        INDEX
    ========================== */

    /** @test */
    public function index_menampilkan_daftar_mahasiswa()
    {
        Mahasiswa::create([
            'nim' => '20230001',
            'nama' => 'Budi',
            'jurusan' => 'Informatika',
            'angkatan' => '2023',
        ]);

        $response = $this->get(route('mahasiswa.index'));

        $response->assertStatus(200);
        $response->assertViewIs('mahasiswa.index');
        $response->assertSee('Budi');
    }

    /* =========================
        CREATE
    ========================== */

    /** @test */
    public function create_menampilkan_form_tambah_mahasiswa()
    {
        $response = $this->get(route('mahasiswa.create'));

        $response->assertStatus(200);
        $response->assertViewIs('mahasiswa.create');
    }

    /* =========================
        STORE - SUCCESS
    ========================== */

    /** @test */
    public function store_berhasil_menyimpan_data_mahasiswa()
    {
        $data = [
            'nim' => '20230002',
            'nama' => 'Siti',
            'jurusan' => 'Sistem Informasi',
            'angkatan' => '2023',
        ];

        $response = $this->post(route('mahasiswa.store'), $data);

        $response->assertRedirect(route('mahasiswa.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('mahasiswas', $data);
    }

    /* =========================
        STORE - VALIDATION ERROR
    ========================== */

    /** @test */
    public function store_gagal_jika_field_kosong()
    {
        $response = $this->post(route('mahasiswa.store'), []);

        $response->assertSessionHasErrors([
            'nim',
            'nama',
            'jurusan',
            'angkatan',
        ]);
    }

    /** @test */
    public function store_gagal_jika_nim_duplikat()
    {
        Mahasiswa::create([
            'nim' => '20230003',
            'nama' => 'Andi',
            'jurusan' => 'Informatika',
            'angkatan' => '2023',
        ]);

        $response = $this->post(route('mahasiswa.store'), [
            'nim' => '20230003',
            'nama' => 'Rina',
            'jurusan' => 'Sistem Informasi',
            'angkatan' => '2023',
        ]);

        $response->assertSessionHasErrors('nim');
    }

    /* =========================
        EDIT
    ========================== */

    /** @test */
    public function edit_menampilkan_form_edit_mahasiswa()
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '20230005',
            'nama' => 'Ayu',
            'jurusan' => 'Sistem Informasi',
            'angkatan' => '2021',
        ]);

        $response = $this->get(route('mahasiswa.edit', $mahasiswa));

        $response->assertStatus(200);
        $response->assertViewIs('mahasiswa.edit');
        $response->assertSee('Ayu');
    }

    /* =========================
        UPDATE - SUCCESS
    ========================== */

    /** @test */
    public function update_berhasil_mengubah_data_mahasiswa()
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '20230006',
            'nama' => 'Rudi',
            'jurusan' => 'Informatika',
            'angkatan' => '2022',
        ]);

        $response = $this->put(route('mahasiswa.update', $mahasiswa), [
            'nim' => '20230006',
            'nama' => 'Rudi Update',
            'jurusan' => 'Teknik Komputer',
            'angkatan' => '2023',
        ]);

        $response->assertRedirect(route('mahasiswa.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('mahasiswas', [
            'nama' => 'Rudi Update',
            'jurusan' => 'Teknik Komputer',
        ]);
    }

    /* =========================
        UPDATE - VALIDATION ERROR
    ========================== */

    /** @test */
    public function update_gagal_jika_nim_dipakai_mahasiswa_lain()
    {
        Mahasiswa::create([
            'nim' => '20230007',
            'nama' => 'User A',
            'jurusan' => 'Informatika',
            'angkatan' => '2023',
        ]);

        $mahasiswaB = Mahasiswa::create([
            'nim' => '20230008',
            'nama' => 'User B',
            'jurusan' => 'SI',
            'angkatan' => '2023',
        ]);

        $response = $this->put(route('mahasiswa.update', $mahasiswaB), [
            'nim' => '20230007',
            'nama' => 'User B',
            'jurusan' => 'SI',
            'angkatan' => '2023',
        ]);

        $response->assertSessionHasErrors('nim');
    }

    /* =========================
        DESTROY
    ========================== */

    /** @test */
    public function destroy_berhasil_menghapus_mahasiswa()
    {
        $mahasiswa = Mahasiswa::create([
            'nim' => '20230009',
            'nama' => 'Hapus Saya',
            'jurusan' => 'Informatika',
            'angkatan' => '2020',
        ]);

        $response = $this->delete(route('mahasiswa.destroy', $mahasiswa));

        $response->assertRedirect(route('mahasiswa.index'));
        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('mahasiswas', [
            'id' => $mahasiswa->id,
        ]);
    }
}
