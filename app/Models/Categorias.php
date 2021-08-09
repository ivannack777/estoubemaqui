<?php

namespace App\Models;

use CodeIgniter\Model;

class Categorias extends Model
{
    protected $table         = 'categorias';
    protected $allowedFields = ['id','key','idpub','title','subtitle','pages','author','description','cover', 'categorias_id', 'price', 'price_promo'];
    protected $useTimestamps = true;
}

