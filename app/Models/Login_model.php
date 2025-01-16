<?php

namespace App\Models;

use CodeIgniter\Model;

class Login_model extends Model
{
    protected $table = ''; // Tidak digunakan karena query custom



    public function login($username, $password)
    {
        // Menggunakan query UNION untuk mengambil data dari users dan muzaki
        $db = \Config\Database::connect();
        $builder = $db->table('users')
            ->select('id_user as id, nama, username, password, gambar as foto, akses_level, idranting')
            ->where('username', $username)
            ->where('password', sha1($password));  // Pastikan menggunakan enkripsi password yang sesuai

        // UNION dengan tabel muzaki
        $builder2 = $db->table('muzaki')
            ->select('id as id, nama, username, password, foto, "muzaki" as akses_level, idranting')
            ->where('username', $username)
            ->where('password', sha1($password));  // Pastikan menggunakan enkripsi password yang sesuai

        // Gabungkan hasilnya
        $query = $builder->getCompiledSelect() . ' UNION ' . $builder2->getCompiledSelect();
        $result = $db->query($query);
        
        return $result->getRowArray();  // Mengembalikan hasil sebagai array
    }
}
