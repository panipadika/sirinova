<?php

namespace Tests\Feature;

use App\Models\DataIndikatorMakro;
use App\Models\IndikatorMakro;
use App\Models\User;
use Tests\TestCase;

class IndikatorMakroBatchTest extends TestCase
{
    protected $adminUser;
    protected $indikator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->adminUser = User::firstOrCreate(
            ['email' => 'admin_test_indikator@tasikmalayakota.go.id'],
            [
                'name' => 'Admin Test Indikator',
                'password' => bcrypt('AdminPassword123!'),
                'role' => 'admin',
            ]
        );

        $this->indikator = IndikatorMakro::firstOrCreate(
            ['nama_indikator' => 'Indeks Pembangunan Manusia (IPM)'],
            [
                'satuan' => 'Point',
                'deskripsi' => 'Pengujian Indikator IPM',
                'urutan' => 1,
            ]
        );
    }

    public function test_admin_can_view_input_batch_page()
    {
        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.indikator-makro.input', [
                'indikator_id' => $this->indikator->id,
                'tahun' => 2026,
            ]));

        $response->assertStatus(200);
        $response->assertSee('Daftar 27 Kabupaten / Kota Jawa Barat');
        $response->assertSee('Simpan Semua Data 27 Daerah');
    }

    public function test_admin_can_store_batch_indicator_data_without_500_error()
    {
        $tahun = 2026;
        $payload = [
            'indikator_id' => $this->indikator->id,
            'tahun' => $tahun,
            'nilai' => [
                'Kota Tasikmalaya' => '76.59',
                'Kota Bandung' => '82.50',
                'Kab. Ciamis' => '',
            ],
        ];

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.indikator-makro.store-batch'), $payload);

        // Harus berhasil redirect (status 302), BUKAN error 500
        $response->assertStatus(302);
        $response->assertRedirect(route('admin.indikator-makro.index', ['tahun' => $tahun]));
        $response->assertSessionHas('success');

        // Pastikan data tersimpan di tabel data_indikator_makro
        $this->assertDatabaseHas('data_indikator_makro', [
            'indikator_id' => $this->indikator->id,
            'tahun' => $tahun,
            'nama_daerah' => 'Kota Tasikmalaya',
            'nilai' => 76.59,
            'is_kota_tasik' => 1,
        ]);

        $this->assertDatabaseHas('data_indikator_makro', [
            'indikator_id' => $this->indikator->id,
            'tahun' => $tahun,
            'nama_daerah' => 'Kota Bandung',
            'nilai' => 82.50,
            'is_kota_tasik' => 0,
        ]);
    }

    public function test_validation_fails_cleanly_for_non_existent_indicator_without_sql_error()
    {
        $payload = [
            'indikator_id' => 999999, // ID tidak ada
            'tahun' => 2026,
            'nilai' => [
                'Kota Tasikmalaya' => '70.00',
            ],
        ];

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.indikator-makro.store-batch'), $payload);

        // Menghasilkan response redirect kembali dengan validation error, BUKAN 500
        $response->assertStatus(302);
        $response->assertSessionHasErrors('indikator_id');
    }
}

