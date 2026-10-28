<?php

namespace App\Policies;

use App\Models\PendaftaranLomba;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class PendaftaranLombaPolicy
{
    use HandlesAuthorization;

    /**
     * Menentukan apakah pengguna dapat melihat / mengunduh berkas proposal pendaftaran lomba.
     * - Admin: Memiliki hak akses penuh untuk seluruh proposal.
     * - Peserta (User): Hanya berhak melihat / mengunduh proposal miliknya sendiri (owner).
     */
    public function view($user, PendaftaranLomba $pendaftaran): Response
    {
        if ($user instanceof Admin) {
            return Response::allow();
        }

        if ($user instanceof User && (int) $pendaftaran->id_user === (int) $user->id) {
            return Response::allow();
        }

        return Response::deny('Anda tidak memiliki hak akses untuk mengakses berkas proposal ini (IDOR terdeteksi).');
    }

    /**
     * Menentukan apakah pengguna dapat mengubah data pendaftaran lomba.
     */
    public function update($user, PendaftaranLomba $pendaftaran): Response
    {
        if ($user instanceof Admin) {
            return Response::allow();
        }

        if ($user instanceof User && (int) $pendaftaran->id_user === (int) $user->id) {
            return Response::allow();
        }

        return Response::deny('Anda tidak memiliki hak akses untuk mengubah proposal ini.');
    }

    /**
     * Menentukan apakah pengguna dapat menghapus data pendaftaran lomba.
     * Hanya Admin yang berhak menghapus data pendaftaran.
     */
    public function delete($user, PendaftaranLomba $pendaftaran): Response
    {
        if ($user instanceof Admin) {
            return Response::allow();
        }

        return Response::deny('Hanya admin yang memiliki hak akses untuk menghapus data pendaftaran.');
    }
}
