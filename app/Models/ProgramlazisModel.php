<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramLazisModel extends Model
{
    protected $table            = 'programlazis';  // Nama tabel
    protected $primaryKey       = 'idprogram';     // Primary key tabel
    
    // Field yang diizinkan untuk disertakan dalam operasi CRUD
    protected $allowedFields    = [
        'tglmulai', 
        'tglselesai', 
        'judulprogram', 
        'deskripsiprogram', 
        'fotoprogram', 
        'targetdonasi', 
        'terkumpul',
        'idranting',
        'kodetransaksi'
    ];

    public function slider()
    {
        return $this->where('tglselesai >=', date('Y-m-d'))
                    ->orderBy('tglmulai', 'ASC')
                    ->findAll(); // Mengambil semua program yang aktif berdasarkan tanggal selesai
    }
    
    // Mengaktifkan timestamp jika diperlukan
    protected $useTimestamps    = false;  // Jika Anda ingin menggunakan timestamp otomatis, set true
    
    // Menambahkan validasi (opsional)
    protected $validationRules  = [
        'tglmulai'     => 'required|valid_date',
        'tglselesai'   => 'required|valid_date',
        'judulprogram'        => 'required|string|max_length[255]',
        'deskripsiprogram'    => 'required|string',
        'fotoprogram'         => 'permit_empty|string',
        'targetdonasi' => 'required|numeric',
        'terkumpul'    => 'required|numeric'
    ];
    
    protected $validationMessages = [
        // Custom validation messages (optional)
        'tglmulai'     => ['required' => 'Tanggal mulai wajib diisi'],
        'tglselesai'   => ['required' => 'Tanggal selesai wajib diisi'],
        'judulprogram'        => ['required' => 'judulprogram wajib diisi'],
        'targetdonasi' => ['required' => 'Target donasi wajib diisi'],
    ];

    // Menambahkan fungsi untuk mendapatkan data program berdasarkan id
    public function getProgramById($id)
    {
        return $this->where('idprogram', $id)->first();
    }
}
