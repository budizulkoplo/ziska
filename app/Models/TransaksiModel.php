<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table            = 'transaksi';  
    protected $primaryKey       = 'idtransaksi';  
    protected $useAutoIncrement = true;  
    protected $returnType       = 'array';  
    protected $useSoftDeletes   = false; 
    protected $allowedFields = [
        'tipetransaksi',
        'tgltransaksi',
        'muzaki',
        'nominal',
        'keterangan',
        'zakat',     
        'program',    
        'donasi',    
        'idrek',      
        'status',  
        'cashflow',
        'buktibayar',
    ];

    // Validasi untuk input
    protected $validationRules = [
        'tipetransaksi' => 'required|string|max_length[50]',
        'tgltransaksi'  => 'required|valid_date',
        'muzaki'        => 'required|string|max_length[100]',
        'nominal'       => 'required|decimal',
        'keterangan'    => 'permit_empty|string|max_length[255]',
    ];

    // Pesan error validasi
    protected $validationMessages = [
        'tipetransaksi' => [
            'required' => 'Jenis transaksi harus dipilih',
            'string'   => 'Jenis transaksi harus berupa teks',
            'max_length' => 'Jenis transaksi maksimal 50 karakter',
        ],
        'tgltransaksi' => [
            'required' => 'Tanggal transaksi harus diisi',
            'valid_date' => 'Tanggal transaksi tidak valid',
        ],
        'muzaki' => [
            'required' => 'Nama muzaki harus diisi',
            'string'   => 'Nama muzaki harus berupa teks',
            'max_length' => 'Nama muzaki maksimal 100 karakter',
        ],
        'nominal' => [
            'required' => 'Nominal harus diisi',
            'decimal'  => 'Nominal harus berupa angka',
        ],
        'keterangan' => [
            'string' => 'Keterangan harus berupa teks',
            'max_length' => 'Keterangan maksimal 255 karakter',
        ],
    ];

    // Menambahkan data transaksi baru
    public function addTransaksi($data)
    {
        return $this->save($data);  // Menyimpan data transaksi ke dalam tabel
    }

    // Mengambil semua data transaksi
    public function getAllTransaksi()
    {
        return $this->findAll();
    }

    // Mengambil data transaksi berdasarkan ID
    public function getTransaksiById($idtransaksi)
    {
        return $this->find($idtransaksi);
    }

    // Mengupdate data transaksi
    public function updateTransaksi($idtransaksi, $data)
    {
        return $this->update($idtransaksi, $data);
    }

    // Menghapus data transaksi
    public function deleteTransaksi($idtransaksi)
    {
        return $this->delete($idtransaksi);
    }
}
