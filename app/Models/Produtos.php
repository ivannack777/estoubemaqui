<?php

namespace App\Models;

use CodeIgniter\Model;

class Produtos extends Model
{
    protected $table         = 'produtos';
    protected $allowedFields = ['id','key','idpub','title','subtitle','tags','price','price_promo','pages','author','description','cover' ];
    protected $useTimestamps = true;
}

