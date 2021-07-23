<?php

namespace App\Controllers;

class Home extends BaseController
{
	private $db;
	private $session;

	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$data['home'] = true;

		$produtos = new \App\Models\Produtos();
		$postagens = new \App\Models\Postagens();
		// var_dump($produtos->get());exit;

		$data['ebooks'] = $produtos->where('deleted_at', null)->where('categorias_id', 1)->get()->getResult();
		$data['postagens'] = $postagens->where('deleted_at', null)->get()->getResult();
		$data['loginsession'] = $this->session->get('login');
		 // var_dump($data['loginsession'] );exit;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('index', $data);
		echo view('footer', $data);
	}

	public function ebooks($item=null, $key=false)
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];

		$produtos = new \App\Models\Produtos();

		if($item){
			$produtos->like('idpub', $item);
		}
		if($key){
			$produtos->where('key', $item);
		}
		
		$data['ebooks'] = $produtos->get()->getResult();

		
		$data['session'] = $this->session;
		echo view('header', $data);
		// echo view('sidebar', $data);
		if($produtos->resultID->num_rows === 1) {
			$data['ebook'] = $data['ebooks'][0];
			echo view('ebook', $data);
		} else{

			echo view('ebooks', $data);
		}

		echo view('footer', $data);

	}

	public function ebooksBuy($item=null){
		var_dump($item);
	}

	public function postagens($item=null)
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];

		$postagens = new \App\Models\Postagens();
		if($item){
			$postagens->where('idpub', $item);
		}
		
		$data['postagens'] = $postagens->get()->getResult();
		$data['session'] = $session;
		echo view('header', $data);
		// echo view('sidebar', $data);
		if($postagens->resultID->num_rows === 1) {
			$data['postagem'] = $data['postagens'][0];
			echo view('postagem', $data);
		} else{

			echo view('postagens', $data);
		}

		echo view('footer', $data);

	}

}
