<?php

namespace App\Models;

use CodeIgniter\Model;

class Avaliacoes extends Model
{
    protected $table         = 'avaliacoes';
    protected $allowedFields = ['id','usuarios_id','pagina','item_id','nota','created_at','updated_at','deleted_at'];
    protected $useTimestamps = true;
}

