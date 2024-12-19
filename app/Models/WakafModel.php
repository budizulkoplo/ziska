<?php

namespace App\Models;

use CodeIgniter\Model;

class WakafModel extends Model
{
    protected $table = 'wakaf';               // Nama tabel
    protected $primaryKey = 'idwakaf';        // Primary key tabel
    protected $returnType = 'array';          // Data dikembalikan dalam bentuk array
    protected $useTimestamps = true;          // Gunakan field timestamp
    protected $createdField = 'created_at';   // Field untuk waktu pembuatan
    protected $updatedField = 'updated_at';   // Field untuk waktu pembaruan

    // Daftar kolom yang boleh diisi
    protected $allowedFields = [
        'idobject',
        'nosertifikat',
        'alamat',
        'koordinat',
        'pewakaf',
        'keterangan',
        'status',
    ];

    /**
     * Mengambil semua data wakaf.
     */
    public function getAll()
    {
        return $this->findAll();
    }

    /**
     * Mengambil data wakaf berdasarkan ID.
     * 
     * @param int $id
     * @return array|null
     */
    public function getById($id)
    {
        return $this->find($id);
    }

    /**
     * Menambahkan data wakaf baru.
     * 
     * @param array $data
     * @return bool
     */
    public function insertData($data)
    {
        return $this->insert($data);
    }

    /**
     * Mengupdate data wakaf berdasarkan ID.
     * 
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateData($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Menghapus data wakaf berdasarkan ID.
     * 
     * @param int $id
     * @return bool
     */
    public function deleteData($id)
    {
        return $this->delete($id);
    }
}
