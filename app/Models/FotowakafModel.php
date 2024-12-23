<?php 
namespace App\Models;

use CodeIgniter\Model;

class FotowakafModel extends Model
{
    protected $table = 'fotowakaf';
    protected $primaryKey = 'idfoto';
    protected $allowedFields = ['idobject', 'namafoto', 'filefoto', 'jenis'];

 
}
