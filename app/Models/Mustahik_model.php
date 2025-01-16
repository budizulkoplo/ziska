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
     * Fungsi untuk mengambil semua data mustahik
     */
    public function getAllmustahik()
    {
        return $this->findAll();
    }

    /**
     * Fungsi untuk mengambil data mustahik berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getmustahikById($idmustahik)
    {
        return $this->where(['idmustahik' => $idmustahik])->first();
    }

    // Fungsi untuk mengambil data mustahik berdasarkan username
public function getmustahikByUsername($username)
{
    return $this->where(['username' => $username])->first();
}

    /**
     * Fungsi untuk menambahkan data mustahik
     * @param array $data
     * @return bool
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
