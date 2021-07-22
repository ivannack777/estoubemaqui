<?php

namespace App\Models;

use CodeIgniter\Model;

class Postagens extends Model
{
    protected $table         = 'postagens';
    protected $allowedFields = ['id','idpub','title','subtitle','text','author','public_at','create_at','update_at','deleted_at'];
    protected $useTimestamps = true;
}

