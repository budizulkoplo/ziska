<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammuzakiModel extends Model
{
    protected $table      = 'programmuzaki'; // Nama tabel
    protected $primaryKey = 'idprogrammuzaki'; // Primary key tabel

    // Daftar field yang dapat diisi (mass assignment)
    protected $allowedFields = [
        'idprogram',
        'idmuzaki',
    ];


    /**
     * Ambil daftar muzaki yang terkait dengan program tertentu
     *
     * @param int $idprogram
     * @return array
     */
    public function getMuzakiByProgram($idprogram)
    {
        return $this->db->table($this->table)
            ->select('muzaki.*')
            ->join('muzaki', 'muzaki.id = programmuzaki.idmuzaki')
            ->where('programmuzaki.idprogram', $idprogram)
            ->get()
            ->getResultArray();
    }

    /**
     * Cek apakah hubungan antara program dan muzaki sudah ada
     *
     * @param int $idprogram
     * @param int $idmuzaki
     * @return bool
     */
    public function isMuzakiLinkedToProgram($idprogram, $idmuzaki)
    {
        return $this->where('idprogram', $idprogram)
            ->where('idmuzaki', $idmuzaki)
            ->countAllResults() > 0;
    }

    /**
     * Tambahkan hubungan antara program dan muzaki
     *
     * @param int $idprogram
     * @param int $idmuzaki
     * @return bool
     */
    public function addMuzakiToProgram($idprogram, $idmuzaki)
    {
        if (!$this->isMuzakiLinkedToProgram($idprogram, $idmuzaki)) {
            return $this->insert([
                'idprogram' => $idprogram,
                'idmuzaki' => $idmuzaki,
            ]);
        }

        return false; // Hubungan sudah ada
    }

    /**
     * Hapus hubungan antara program dan muzaki
     *
     * @param int $idprogram
     * @param int $idmuzaki
     * @return bool
     */
    public function removeMuzakiFromProgram($idprogram, $idmuzaki)
    {
        return $this->where('idprogram', $idprogram)
            ->where('idmuzaki', $idmuzaki)
            ->delete();
    }
}
