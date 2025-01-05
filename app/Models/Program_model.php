<?php

namespace App\Models;

use CodeIgniter\Model;

class Program_model extends Model
{
    protected $table = 'programlazis';
    protected $primaryKey = 'idprogram';
    protected $allowedFields = [
        'tglmulai',
        'tglselesai',
        'judulprogram',
        'deskripsiprogram',
        'fotoprogram',
        'targetdonasi',
        'terkumpul',
    ];
}
