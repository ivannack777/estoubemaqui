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
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$produtos = new \App\Models\Produtos();
		$data['itens'] = [];
		$itens = $this->session->get('cesta');
		$data['loginsession'] = $this->session->get('login');

		if(is_array($itens)){
			foreach($itens as $item => $qtd){
				$produtos->where('key', $item);
				$result = $produtos->get()->getResult();
				$data['itens'][] = [
					'count' => $qtd,
					'produto' => $result[0] ?? null,
				];
			}
		}

		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('cesta', $data);
		echo view('footer', $data);

	}

	public function get()
	{
		$produtos = new \App\Models\Produtos();
		$dataItens = [];
		$sessionItens = $this->session->get('cesta');

		if(is_array($sessionItens)){
			foreach($sessionItens as $item => $qtd){
				$produtos->where('key', $item);
				$result = $produtos->get()->getResult();
				$dataItens[] = [
					'count' => (int)$qtd,
					'produto' => $result[0] ?? null,
				];
			}
		}

		echo json_encode($dataItens);

	}
	public function setQuant($item=null, $quant)
	{
		sleep(1);
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];
		$produtos = new \App\Models\Produtos();

		if($item){
			$produtos->where('key', $item);
		}
		$produtos = $produtos->get()->getResult();

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
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];
		$produtos = new \App\Models\Produtos();

		if($item){
			$produtos->where('key', $item);
		}
		$produtos = $produtos->get()->getResult();

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
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];
		$produtos = new \App\Models\Produtos();

		if($item){
			$produtos->where('key', $item);
		}
		$produtos = $produtos->get()->getResult();

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

	// public function get()
	// {
	// 	$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
	// 	$cesta = $this->session->get('cesta');
	// 	echo json_encode($cesta??[]);
	// }

	public function clear()
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$this->session->remove('cesta');
		echo json_encode(true);
	}


}
