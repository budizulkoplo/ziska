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
        'judul', 
        'deskripsi', 
        'foto', 
        'targetdonasi', 
        'terkumpul'
    ];
    
    // Mengaktifkan timestamp jika diperlukan
    protected $useTimestamps    = false;  // Jika Anda ingin menggunakan timestamp otomatis, set true
    
    // Menambahkan validasi (opsional)
    protected $validationRules  = [
        'tglmulai'     => 'required|valid_date',
        'tglselesai'   => 'required|valid_date',
        'judul'        => 'required|string|max_length[255]',
        'deskripsi'    => 'required|string',
        'foto'         => 'permit_empty|string',
        'targetdonasi' => 'required|numeric',
        'terkumpul'    => 'required|numeric'
    ];
    
    protected $validationMessages = [
        // Custom validation messages (optional)
        'tglmulai'     => ['required' => 'Tanggal mulai wajib diisi'],
        'tglselesai'   => ['required' => 'Tanggal selesai wajib diisi'],
        'judul'        => ['required' => 'Judul wajib diisi'],
        'targetdonasi' => ['required' => 'Target donasi wajib diisi'],
    ];

    // Menambahkan fungsi untuk mendapatkan data program berdasarkan id
    public function getProgramById($id)
    {
        return $this->where('idprogram', $id)->first();
    }
}
