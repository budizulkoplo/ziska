<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionLogModel extends Model
{
    protected $table = 'transactionlog';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'idtransaksi',
        'idrek',
        'nominal',
        'saldoawal',
        'saldoakhir',
    ];

    protected $useTimestamps = false;
}
