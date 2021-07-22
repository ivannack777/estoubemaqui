<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table         = 'usuarios';
    protected $allowedFields = ['id','key','documento','email','nome','status','telefone','tipo','token','update_at','create_at','deleted_at',];
    protected $useTimestamps = true;
}

