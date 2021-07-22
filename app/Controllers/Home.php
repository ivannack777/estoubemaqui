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
		$data['user'] = (object)['lang'=>'pt-br'];

		$ebooks = new \App\Models\Produtos();
		$postagens = new \App\Models\Postagens();
		// var_dump($ebooks->get());exit;

		$data['ebooks'] = $ebooks->where('deleted_at', null)->get()->getResult();
		$data['postagens'] = $postagens->get()->getResult();
		$data['loginsession'] = $this->session->get('login');
		 // var_dump($data['loginsession'] );exit;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('index', $data);
		echo view('footer', $data);
	}

	public function ebooks($item=null, $key=false)
	{
		$data['user'] = (object)['lang'=>'pt-br'];

		$ebooks = new \App\Models\Books();

		if($item){
			$ebooks->like('idpub', $item);
		}
		if($key){
			$ebooks->where('key', $item);
		}
		
		$data['ebooks'] = $ebooks->get()->getResult();

		
		$data['session'] = $this->session;
		echo view('header', $data);
		// echo view('sidebar', $data);
		if($ebooks->resultID->num_rows === 1) {
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
		$data['user'] = (object)['lang'=>'pt-br'];

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
