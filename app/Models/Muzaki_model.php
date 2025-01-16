<?php

namespace App\Models;

use CodeIgniter\Model;

class Muzaki_model extends Model
{
    protected $table = 'muzaki'; // Nama tabel di database
    protected $primaryKey = 'id'; // Primary key tabel

    protected $allowedFields = [
        'noanggota',
        'username',
        'password',
        'tipeanggota',
        'nama',
        'nik',
        'alamat',
        'nohp',
        'keterangan',
        'foto',
        'idranting' // Menambahkan idranting
    ];

    protected $useTimestamps = true; // Jika menggunakan kolom created_at & updated_at
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Fungsi untuk mengambil semua data Muzaki dengan mempertimbangkan idranting
     * @return array
     */
    public function getAllMuzaki($idranting = null)
    {
        if ($idranting && $idranting != 1) {
            // Jika idranting bukan 1 (All), filter berdasarkan idranting
            return $this->where('idranting', $idranting)->findAll();
        }
        // Jika idranting 1 (All), tampilkan semua data
        return $this->findAll();
    }

    /**
     * Fungsi untuk mengambil data Muzaki berdasarkan ID
     * @param int $id
     * @return array|null
     */
    public function getMuzakiById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    /**
     * Fungsi untuk mengambil data Muzaki berdasarkan username
     * @param string $username
     * @return array|null
     */

    public function getMuzakiByRanting($idranting)
    {
        return $this->where('idranting', $idranting)->findAll(); // Ambil data muzaki sesuai dengan idranting
    }

    public function getMuzakiByUsername($username)
    {
        return $this->where(['username' => $username])->first();
    }

    /**
     * Fungsi untuk menambahkan data Muzaki
     * @param array $data
     * @return bool
     */
    public function addMuzaki($data)
    {
        return $this->insert($data);
    }

    /**
     * Fungsi untuk memperbarui data Muzaki berdasarkan ID
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateMuzaki($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * Fungsi untuk menghapus data Muzaki berdasarkan ID
     * @param int $id
     * @return bool
     */
    public function deleteMuzaki($id)
    {
        return $this->delete($id);
    }
}
