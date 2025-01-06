<?php

namespace App\Models;

use CodeIgniter\Model;

class Kontak_model extends Model
{
    protected $table = 'testimoni';
    protected $primaryKey = 'idtestimoni';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['idtestimoni', 'nama', 'email', 'testimoni'];


    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // listing
    public function listing()
    {
        $builder = $this->db->table('testimoni');
        $builder->orderBy('testimoni.tanggal_post', 'DESC');
        $builder->limit(1);
        $query = $builder->get();
        return $query->getResultArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('testimoni');
        $builder->insert($data);
    }
}
