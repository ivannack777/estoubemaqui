<?php

namespace App\Models;

use CodeIgniter\Model;

class Produtos extends Model
{
    protected $table         = 'produtos';
    protected $allowedFields = ['id','key','idpub','title','subtitle','pages','author','description','cover', 'categorias_id', 'price', 'price_promo'];
    protected $useTimestamps = true;
}

