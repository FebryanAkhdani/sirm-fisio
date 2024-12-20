<?php

namespace App\Models;

use CodeIgniter\Model;

class TerapiModel extends Model
{
    protected $table = 'terapi';
    protected $primaryKey = 'id';
    protected $useAutoIncrements = true;

    protected $allowedFields = ['no_pendaftaran', 'id_pasien', 'id_fisioterapis', 'tanggal', 'keluhan_utama', 'riwayat_keluhan', 'pemeriksaan', 'treatment', 'kesimpulan', 'latihan_rumah', 'evaluasi'];

    public function getAllTerapiWithPasienAndUsers()
    {
        return $this->select('terapi.*, pasien.nama, pasien.j_kelamin, pasien.alamat, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->get()
            ->getResultArray();
    }

    public function getTerapiWithPasienAndUsers($id)
    {
        return $this->select('terapi.*, pasien.*, users.username')
            ->join('pasien', 'terapi.id_pasien = pasien.id')
            ->join('users', 'terapi.id_fisioterapis = users.id')
            ->where('terapi.id', $id)
            ->first();
    }
}
