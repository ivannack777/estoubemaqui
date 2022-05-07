<?php

namespace App\Controllers\Super;
 use CodeIgniter\Controller;
class Home extends Controller
{
	private $db;

	public function __construct(){
		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		echo view('super/header', $data);
		//echo view('sidebar', $data);
		echo view('super/index', $data);
		echo view('super/footer', $data);
	}

	
}
