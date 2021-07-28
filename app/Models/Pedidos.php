<?php

namespace App\Models;

use CodeIgniter\Model;

class Pedidos extends Model
{
    protected $table         = 'pedidos';
    protected $allowedFields = ['key','idpub', 'usuarios_id', 'produtos', 'status','price_total'];
    protected $useTimestamps = true;

    public function getPedidos($key=null, $usuarios_id=null){

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

