<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgrammustahikModel extends Model
{
    protected $table      = 'programmustahik'; // Nama tabel
    protected $primaryKey = 'idprogrammustahik'; // Primary key tabel

    // Daftar field yang dapat diisi (mass assignment)
    protected $allowedFields = [
        'idprogram',
        'idmustahik',
    ];

    /**
     * Ambil daftar mustahik yang terkait dengan program tertentu
     *
     * @param int $idprogram
     * @return array
     */
    public function getMustahikByProgram($idprogram)
    {
        return $this->db->table($this->table)
            ->select('mustahik.*')
            ->join('mustahik', 'mustahik.idmustahik = programmustahik.idmustahik')
            ->where('programmustahik.idprogram', $idprogram)
            ->get()
            ->getResultArray();
    }

    /**
     * Cek apakah hubungan antara program dan mustahik sudah ada
     *
     * @param int $idprogram
     * @param int $idmustahik
     * @return bool
     */
    public function isMustahikLinkedToProgram($idprogram, $idmustahik)
    {
        return $this->where('idprogram', $idprogram)
            ->where('idmustahik', $idmustahik)
            ->countAllResults() > 0;
    }

    /**
     * Tambahkan hubungan antara program dan mustahik
     *
     * @param int $idprogram
     * @param int $idmustahik
     * @return bool
     */
    public function addMustahikToProgram($idprogram, $idmustahik)
    {
        if (!$this->isMustahikLinkedToProgram($idprogram, $idmustahik)) {
            return $this->insert([
                'idprogram' => $idprogram,
                'idmustahik' => $idmustahik,
            ]);
        }

        return false; // Hubungan sudah ada
    }

    /**
     * Hapus hubungan antara program dan mustahik
     *
     * @param int $idprogram
     * @param int $idmustahik
     * @return bool
     */
    public function removeMustahikFromProgram($idprogram, $idmustahik)
    {
        return $this->where('idprogram', $idprogram)
            ->where('idmustahik', $idmustahik)
            ->delete();
    }
}
