<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MahasiswaControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function login()
    {
        $user = User::factory()->create();
        return $this->actingAs($user);
    }

    protected function mahasiswaData($override = [])
    {
        return array_merge([
            'nim' => '20231234',
            'nama' => 'Budi Santoso',
            'jurusan' => 'Informatika',
            'angkatan' => '2023',
        ], $override);
    }

    /** 🔒 GUEST DILARANG AKSES */
    public function test_guest_cannot_access_mahasiswa_pages()
    {
        $this->get('/mahasiswa')->assertRedirect('/login');
        $this->get('/mahasiswa/create')->assertRedirect('/login');
    }

    /** 📄 INDEX */
    public function test_authenticated_user_can_view_mahasiswa_index()
    {
        $this->login();

        $response = $this->get('/mahasiswa');

        $response->assertStatus(200);
        $response->assertViewIs('mahasiswa.index');
    }

    /** ➕ CREATE FORM */
    public function test_authenticated_user_can_view_create_form()
    {
        $this->login();

        $this->get('/mahasiswa/create')
            ->assertStatus(200)
            ->assertViewIs('mahasiswa.create');
    }

    /** 💾 STORE VALID */
    public function test_store_mahasiswa_success()
    {
        $this->login();

        $response = $this->post('/mahasiswa', $this->mahasiswaData());

        $response->assertRedirect('/mahasiswa');
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('mahasiswas', [
            'nim' => '20231234'
        ]);
    }

    /** ❌ STORE INVALID */
    public function test_store_mahasiswa_validation_error()
    {
        $this->login();

        $response = $this->post('/mahasiswa', []);

        $response->assertSessionHasErrors([
            'nim', 'nama', 'jurusan', 'angkatan'
        ]);
    }

    /** ❌ STORE UNIQUE NIM */
    public function test_store_mahasiswa_nim_must_be_unique()
    {
        $this->login();

        Mahasiswa::create($this->mahasiswaData());

        $this->post('/mahasiswa', $this->mahasiswaData())
            ->assertSessionHasErrors('nim');
    }

    /** ✏️ EDIT FORM */
    public function test_edit_mahasiswa()
    {
        $this->login();

        $mahasiswa = Mahasiswa::create($this->mahasiswaData());

        $this->get("/mahasiswa/{$mahasiswa->id}/edit")
            ->assertStatus(200)
            ->assertViewIs('mahasiswa.edit');
    }

    /** 🔄 UPDATE SUCCESS */
    public function test_update_mahasiswa_success()
    {
        $this->login();

        $mahasiswa = Mahasiswa::create($this->mahasiswaData());

        $response = $this->put("/mahasiswa/{$mahasiswa->id}", 
            $this->mahasiswaData([
                'nama' => 'Nama Update'
            ])
        );

        $response->assertRedirect('/mahasiswa');

        $this->assertDatabaseHas('mahasiswas', [
            'nama' => 'Nama Update'
        ]);
    }

    /** ❌ UPDATE UNIQUE NIM */
    public function test_update_mahasiswa_unique_nim_except_self()
    {
        $this->login();

        $m1 = Mahasiswa::create($this->mahasiswaData(['nim' => '111']));
        $m2 = Mahasiswa::create($this->mahasiswaData(['nim' => '222']));

        $this->put("/mahasiswa/{$m2->id}", [
            'nim' => '111',
            'nama' => 'Test',
            'jurusan' => 'SI',
            'angkatan' => '2023'
        ])->assertSessionHasErrors('nim');
    }

    /** 🗑 DELETE */
    public function test_delete_mahasiswa()
    {
        $this->login();

        $mahasiswa = Mahasiswa::create($this->mahasiswaData());

        $response = $this->delete("/mahasiswa/{$mahasiswa->id}");

        $response->assertRedirect('/mahasiswa');

        $this->assertDatabaseMissing('mahasiswas', [
            'id' => $mahasiswa->id
        ]);
    }
}
