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

	public function get($returnType = 'json')
	{
		$produtos = new \App\Models\Produtos();
		$dataItens = [];
		$sessionItens = $this->session->get('cesta');
		$loginsession = $this->session->get('login');

		if(is_array($sessionItens)){
			foreach($sessionItens as $item => $qtd){
				$produtos->where('key', $item);
				$result = $produtos->get()->getResult();
				$dataItens[] = [
					'count' => (int)$qtd,
					'produto' => $result[0] ?? null,
				];
			}
		} else {
			if($loginsession){
				$cesta = new \App\Models\Cesta();
				$cestaDB = $cesta->where('usuarios_id', $loginsession['id']);
				$cestaReturn = $cestaDB->get()->getResult();
				$cestaReturn = json_decode($cestaReturn[0]->itens);
				if($cestaReturn){
					foreach($cestaReturn as $item => $qtd){
						$produtos->where('key', $item);
						$result = $produtos->get()->getResult();
						$dataItens[] = [
							'count' => (int)$qtd,
							'produto' => $result[0] ?? null,
						];
					}
				}
			// var_dump($dataItens);
			}
		}
		//var_dump($dataItens);

		if($returnType == 'array'){
			return $dataItens;
		} else {
			echo json_encode($dataItens);
		}

	}
	public function setQuant($item=null, $quant)
	{
		// sleep(1);
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


		$loginsession = $this->session->get('login');
		if($loginsession){
			$cestaModel = new \App\Models\Cesta();
			$cestaModelGetResult = $cestaModel->where('usuarios_id', $loginsession['id'] )->get()->getResult();

			if( count($cestaModelGetResult) ){
				$dados = [
					'key' => hash('sha256', $loginsession['key']),
					'usuarios_id' => $loginsession['id'],
					'itens' => json_encode($cesta),
				];

				$cestaModel->update(['id' => $cestaModelGetResult[0]->id ], $dados);
			} else {
				$cestaModel->insert($dados);
			}
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
