<?php

namespace App\Models;

use CodeIgniter\Model;

class KodetransaksiModel extends Model
{
    protected $table            = 'm_kodetransaksi'; 
    protected $primaryKey       = 'idkodetransaksi'; 

    protected $allowedFields = ['kodetransaksi', 'cashflow']; 

    protected $useTimestamps    = false;
}
