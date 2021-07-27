<?php

namespace App\Models;

use CodeIgniter\Model;

class Cesta extends Model
{
    protected $table         = 'cesta';
    protected $allowedFields = ['id', 'key', 'usuarios_id', 'itens'];
    protected $useTimestamps = true;

    public function getItens($key=null, $usuarios_id=null){

        if($key){
            $this->where('key', $key);
        }

        if($usuarios_id){
            $this->where('usuarios_id', $usuarios_id);
        }

        $query = $this->get();
        return $query ->getResult();
    }
}

