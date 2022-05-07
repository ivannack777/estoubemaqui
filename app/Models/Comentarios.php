<?php

namespace App\Models;

use CodeIgniter\Model;

class Comentarios extends Model
{
    protected $table         = 'comentarios';
    protected $allowedFields = [
        'id',
        'key',
        'item_id',
        'usuarios_id',
        'pagina',
        'texto',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $useTimestamps = true;

    public function getComentarios($pagina){
        return $this->select(['comentarios.key','comentarios.usuarios_id','comentarios.texto','comentarios.created_at','usuarios.nome as usuarios_nome'])->
            join('usuarios','usuarios.id=comentarios.usuarios_id','left')->
            where([
                'pagina' => $pagina,
                //'item_id'=> $postagensGet[0]->id
            ])->
            orderBy('comentarios.created_at','DESC')->
            get()->getResult();
    }
}

