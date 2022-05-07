<?php

namespace App\Models;

use CodeIgniter\Model;

class Usuarios extends Model
{
    protected $table         = 'usuarios';
    protected $allowedFields = ['id','key','documento','email','nome','status','telefone','tipo','token','randonCode','update_at','create_at','deleted_at',];
    protected $useTimestamps = true;

    public function __construct(){

    }


    static public function userPrefs($usuarios_id){

        $db = \Config\Database::connect();
        $builder = $db->table('usuarios_prefs')->where('usuarios_id', $usuarios_id);

        $query = $builder->get();
        // var_dump($builder->get());exit;
        return $query ->getResult();
    }
}

