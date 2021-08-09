<?php

namespace App\Controllers;

class Cesta extends BaseController
{
	private $session;
	private $loginsession;
	private $userPrefs;
	public function __construct(){
		$this->session = \Config\Services::session();
		$this->loginsession = $this->session->get('login');
		if($this->loginsession){
			$usuarios = new \App\Models\Usuarios();
			$this->userPrefs = $usuarios->userPrefs($this->loginsession['id']);
		} else{
			$this->userPrefs[0] = (object)[
				'lang' => 'pt-br',
				'price_simbol' => 'R$',
				'data_format' => 'd/m/Y',
				'time_format' => 'H:i',
				'datTime_format' => 'd/m/Y H:i',
			];
		}
	}

	/**
	 * Imprime a cesta de produtos
	 * */
	public function index()
	{
		$data['user'] = $this->userPrefs[0]??null;
		$produtos = new \App\Models\Produtos();
		$data['itens'] = [];
		$cestaSession = $this->get();
		$data['loginsession'] = $this->loginsession;

		if(is_array($cestaSession)){
			foreach($cestaSession as $item => $qtd){
				$produtos->where('key', $item);
				$result = $produtos->get()->getResult();
				$data['itens'][] = [
					'quant' => $qtd,
					'produto' => $result[0] ?? null,
				];
			}
		}

		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('cesta', $data);
		echo view('footer', $data);

	}

	/**
	 * Retorna a cesta de produtos
	 * */

	public function get($returnType = 'array')
	{
		$produtos = new \App\Models\Produtos();
		$dataItens = []; // armazena os dados da cesta para retorno

		/** Pegar cesta da sessão */
		$cestaSession = $this->session->get('cesta');


	  // var_dump($cestaSession, $this->loginsession);exit;

		/** se cesta da sessão estiver vazia, consultar cesta no banco*/
		if(empty($cestaSession) && $this->loginsession){
			$cesta = new \App\Models\Cesta();
			$cestaDB = $cesta->where('usuarios_id', $this->loginsession['id']);
			$cestaGet = $cestaDB->get()->getResult();
			// var_dump($cestaGet[0]->itens);exit;
			/** Se encontrar um cesta no banco, grava a cesta na sessão */
			if(!empty($cestaGet)){
				$cestaSession = json_decode($cestaGet[0]->itens, true);
				$this->set($cestaSession);
			}

		}
		/** se cesta não estiver vazia, consultar produtos no banco*/
		if(!empty($cestaSession)){
			foreach($cestaSession as $k => $dd){
				$produtos->where('key', $k);
				$produtoResult = $produtos->get()->getResult();
				 // var_dump($dd,$k,$produtoResult[0]);exit;
				$dataItens[$k] = [
					'quant' => (int)$dd['quant'],
					'checked' => (int)$dd['checked'],
					'produto' => null,
				];
				if($produtoResult[0] ?? false){
					$produto = $produtoResult[0];
					$dataItens[$k]['produto'] = [
						'id'  			=> $produto->id,
						'key' 			=> $produto->key,
						'idpub' 		=> $produto->idpub,
						'categorias_id' => $produto->categorias_id,
						'title' 		=> $produto->title,
						'subtitle' 		=> $produto->subtitle,
						'price' 		=> $produto->price,
						'price_promo' 	=> $produto->price_promo,
					];
				}
			}

		}
	 	// var_dump($dataItens);exit;
		/** retornar Cesta */
		if($returnType == 'json'){
			echo json_encode($dataItens);
		} else {
			return $dataItens;
		}

	}


	/**
	 * Salva a cesta de produtos na cessão e no banco
	 * */
	public function set(array $cestaArray):bool{

		/** Verificar se usuario está logada para salvar cesta no banco */
		if($this->loginsession){
			$usuariosId = $this->loginsession['id'];
			$cestaModel = new \App\Models\Cesta();
			$cestaModelGetResult = $cestaModel->where('usuarios_id', $usuariosId)->get()->getResult();

			$dados = [
				'key' => hash('sha256', $this->loginsession['key']),
				'usuarios_id' => $usuariosId,
				'itens' => json_encode($cestaArray),
			];
			if( count($cestaModelGetResult) ){
				$cestaModel->update(['usuarios_id' => $usuariosId], $dados);
			} else {
				$cestaModel->insert($dados);
			}
		}
		// var_dump($cestaArray);exit;
		/** retonar status da gravação da cesta na sessão */
		if(is_array($cestaArray)){
			$this->session->set('cesta', $cestaArray);
			return true;
		} else {
			return false;
		}

	}

	/**
	* Grava quantidade para um determinado item e se ele foi selecionado para a geração do pedido
	*/
	public function setQuant($item, $quant, $checked=0)
	{
		// sleep(1);
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];

		/** pegar e montar cesta */
		$cestaSession = $this->get();
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

		/** setar quantidade ($quant) no $item e gravar se está seleciondo ($checked) para pedido  */
		if(isset($cesta[$item]) && is_numeric($quant) ){
			$cesta[$item] = ['quant'=>$quant, 'checked'=>$checked];
		}

		/** Gravar cesta */
		$this->set($cesta);
		/** retornar item */
		echo json_encode($cesta[$item]);
	}

	/**
	* Adiciona um novo intem à cesta
	*/
	public function add($item=null)
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];
		// $produtos = new \App\Models\Produtos();

		// if($item){
		// 	$produtos->where('key', $item);
		// }
		// $produtos = $produtos->get()->getResult();

		$cestaSession = $this->get();
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

	 	$cesta[$item] = ['quant'=>1, 'checked'=>0];
		$this->set($cesta);
		echo json_encode(true);
	}

	/**
	 * Remove um item da cesta
	 * */
	public function remove($item=null)
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$cesta = [];
		$produtos = new \App\Models\Produtos();

		if($item){
			$produtos->where('key', $item);
		}
		$produtos = $produtos->get()->getResult();

		$cestaSession = $this->get();
		if(is_array($cestaSession)){
			$cesta = $cestaSession;
		}

		if(isset($cesta[$item])){
		 	unset($cesta[$item]);
		}

		$this->set('cesta', $cesta);
		echo json_encode(true);
	}

	/**
	 * Remove a sessão 'cesta'
	 * */
	public function clear()
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$this->session->remove('cesta');
		echo json_encode(true);
	}


}
