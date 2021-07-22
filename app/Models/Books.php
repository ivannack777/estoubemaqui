<?php

namespace App\Models;

use CodeIgniter\Model;

class Books extends Model
{
    protected $table         = 'books';
    protected $allowedFields = ['id','key','idpub','title','subtitle','pages','author','description','cover' ];
    protected $useTimestamps = true;
}

