<?php

namespace App\Models;

use CodeIgniter\Model;

class Ranting_model extends Model
{
    protected $table = 'ranting';
    protected $primaryKey = 'idranting';
    protected $allowedFields = ['namaranting'];
}
