<?php

namespace App\Models;

use CodeIgniter\Model;

class WakafModel extends Model
{
    protected $table = 'wakaf';
    protected $primaryKey = 'idwakaf';
    protected $allowedFields = [
        'idobject', 'nosertifikat', 'alamat', 'koordinat', 'pewakaf', 'keterangan', 
        'status', 'urlmaps', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
}
