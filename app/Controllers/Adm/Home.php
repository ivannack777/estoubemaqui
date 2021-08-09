<?php

namespace App\Controllers\Adm;
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
		echo view('adm/header', $data);
		//echo view('sidebar', $data);
		echo view('adm/index', $data);
		echo view('adm/footer', $data);
	}

	
}
