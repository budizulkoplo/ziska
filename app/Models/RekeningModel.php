<?php

namespace App\Models;

use CodeIgniter\Model;

class RekeningModel extends Model
{
    protected $table              = 'm_rekening';
    protected $primaryKey         = 'idrek';
    protected $returnType         = 'array';
    protected $useSoftDeletes     = false;
    protected $allowedFields      = ['norek', 'namarek', 'saldo', 'saldoakhir', 'level'];
    protected $useTimestamps      = true;
    protected $createdField       = 'created_at';
    protected $updatedField       = 'updated_at';
    protected $deletedField       = null;
    protected $validationRules    = [
        'norek'     => 'required',
        'namarek'   => 'required',
        'saldo'     => 'required|numeric',
    ];
    protected $validationMessages = [
        'norek' => [
            'required' => 'Nomor rekening harus diisi.',
        ],
        'namarek' => [
            'required' => 'Nama rekening harus diisi.',
        ],
        'saldo' => [
            'required' => 'Saldo harus diisi.',
            'numeric'  => 'Saldo harus berupa angka.',
        ],
    ];
    protected $skipValidation     = false;

    // Method untuk mendapatkan semua data rekening
    public function getAllRekening()
    {
        return $this->orderBy('idrek', 'DESC')->findAll();
    }

    // Method untuk mendapatkan detail rekening berdasarkan ID
    public function getRekeningById($idrek)
    {
        return $this->find($idrek);
    }

    // Method untuk menambahkan log transaksi rekening
    public function addRekeningLog($data)
    {
        $builder = $this->db->table('rekening_logs');
        return $builder->insert($data);
    }
}
