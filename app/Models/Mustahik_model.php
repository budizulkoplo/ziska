<?php

namespace App\Models;

use CodeIgniter\Model;

class Mustahik_model extends Model
{
    protected $table = 'mustahik'; // Nama tabel di database
    protected $primaryKey = 'idmustahik'; // Primary key tabel

    protected $allowedFields = [
        'nama',
        'nik',
        'alamat',
        'nohp',
        'keterangan',
        'foto',
        'idranting'
    ];

    protected $useTimestamps = true; // Jika menggunakan kolom created_at & updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Fungsi untuk mengambil semua data mustahik beserta nama ranting
     */
    public function getAllmustahik()
    {
        return $this->select('mustahik.*, ranting.namaranting')
                    ->join('ranting', 'ranting.idranting = mustahik.idranting', 'left')
                    ->findAll();
    }

    /**
     * Fungsi untuk mengambil data mustahik berdasarkan ID beserta nama ranting
     * @param int $idmustahik
     * @return array|null
     */
    public function getmustahikById($idmustahik)
    {
        return $this->select('mustahik.*, ranting.namaranting')
                    ->join('ranting', 'ranting.idranting = mustahik.idranting', 'left')
                    ->where(['idmustahik' => $idmustahik])
                    ->first();
    }

    /**
     * Fungsi untuk menambahkan data mustahik
     */
    public function addmustahik($data)
    {
        return $this->insert($data);
    }

    /**
     * Fungsi untuk memperbarui data mustahik berdasarkan ID
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updatemustahik($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Fungsi untuk menghapus data mustahik berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deletemustahik($id)
    {
        return $this->delete($id);
    }
}
