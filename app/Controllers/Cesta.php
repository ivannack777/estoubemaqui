<?php

namespace App\Controllers;

class Cesta extends BaseController
{
	private $session;

	public function __construct(){
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$ebooks = new \App\Models\Books();
		$data['itens'] = [];
		$itens = $this->session->get('cesta');

		if(is_array($itens)){
			foreach($itens as $item => $qtd){
				$ebooks->where('key', $item);
				$result = $ebooks->get()->getResult();
				$data['itens'][] = [
					'count' => $qtd,
					'ebook' => $result[0] ?? null,
				];
			}
		}

		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('cesta', $data);
		echo view('footer', $data);

	}

	public function setQuant($item=null, $quant)
	{
		sleep(1);
		$data['user'] = (object)['lang'=>'pt-br'];
		$cesta = [];
		$ebooks = new \App\Models\Books();

		if($item){
			$ebooks->where('key', $item);
		}
		$ebooks = $ebooks->get()->getResult();

		$cestaSession = $this->session->get('cesta');
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

		if(isset($cesta[$item]) && is_numeric($quant) ){
			$cesta[$item] = $quant;
		}
		$this->session->set('cesta', $cesta);
		echo json_encode($cesta[$item]);
	}

	public function add($item=null)
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$cesta = [];
		$ebooks = new \App\Models\Books();

		if($item){
			$ebooks->where('key', $item);
		}
		$ebooks = $ebooks->get()->getResult();

		$cestaSession = $this->session->get('cesta');
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

	 	$cesta[$item] = 1;
		$this->session->set('cesta', $cesta);
		echo json_encode(true);
	}

	public function remove($item=null)
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$cesta = [];
		$ebooks = new \App\Models\Books();

		if($item){
			$ebooks->where('key', $item);
		}
		$ebooks = $ebooks->get()->getResult();

		$cestaSession = $this->session->get('cesta');
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

		if(isset($cesta[$item])){
		 	unset($cesta[$item]);
		}

		$this->session->set('cesta', $cesta);
		echo json_encode(true);
	}

	public function get()
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$cesta = $this->session->get('cesta');
		echo json_encode($cesta??[]);
	}

	public function clear()
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$this->session->remove('cesta');
		echo json_encode(true);
	}


}
