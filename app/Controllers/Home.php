<?php

namespace App\Controllers;

class Home extends BaseController
{
	private $db;
	private $session;
	private $loginsession;
	private $userPrefs;

	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
		$this->loginsession = $this->session->get('login');
		if($this->loginsession){
			$usuarios = new \App\Models\Usuarios();
			$userPrefs = $usuarios->userPrefs($this->loginsession['id']);
			$this->userPrefs = $userPrefs[0];
		} else{
			$config = config('App');
			$this->userPrefs = (object)$config->defaultUserPrefs;
		}
	}

	public function index()
	{
		$data['user'] = $this->userPrefs;
		$data['home'] = true;
		$data['loginsession'] = $this->loginsession;

		$produtos = new \App\Models\Produtos();
		$postagens = new \App\Models\Postagens();
		// var_dump($produtos->get());exit;

		$data['produtos'] = $produtos->where('deleted_at', null)->whereIn('categorias_id', [1,2])->get()->getResult();
		$data['postagens'] = $postagens->where('deleted_at', null)->where('public_at is not null')->get()->getResult();

		 // var_dump($data['loginsession'] );exit;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('index', $data);
		echo view('footer', $data);
	}

	public function produtos($idpub=null, $key=false)
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$data['loginsession'] = $this->loginsession;
		$produtos = new \App\Models\Produtos();
		$avaliacoes = new \App\Models\Avaliacoes();

		if($idpub){
			$produtos->like('idpub', $idpub);
		}
		if($key){
			$produtos->where('key', $key);
		}

		$produtosGet = $produtos->get()->getResult();

		$avaliacoesGet = $avaliacoes->where([
			'pagina' => 'produtos',
			'item_id'=>$produtosGet[0]->id
		])->get()->getResult();

		$avaliacoesUsuarioGet = $avaliacoes->where([
			'pagina' => 'produtos',
			'item_id' => $produtosGet[0]->id,
			'usuarios_id' => $this->loginsession['id']
		])->get()->getResult();

		// var_dump($avaliacoesGet, $avaliacoesUsuarioGet);

		$data['produtos'] = $produtosGet;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('produtos', $data);
		echo view('footer', $data);

	}

	public function produtosBuy($item=null){
		var_dump($item);
	}

	public function postagens($item=null)
	{
		$data['user'] = $this->userPrefs;
		$data['loginsession'] = $this->loginsession;
		$data['avaliacoesUsuario'] = [];

		$postagens = new \App\Models\Postagens();

		if($item){
			$postagens->where('idpub', $item);
		}

		$postagensGet = $postagens->get()->getResult();
		$data['postagens'] = $postagensGet;
		echo view('header', $data);
		echo view('sidebar', $data);
		
		if(count($postagensGet) === 1) {
			$avaliacoes = new \App\Models\Avaliacoes();
			$comentarios = new \App\Models\Comentarios();

			$avaliacoesGet = $avaliacoes->select(['AVG(nota) as notaMedia', 'count(nota) as notaCount'])->where([
				'pagina' => 'postagem',
				'item_id'=> $postagensGet[0]->id
			])->get()->getResult();
			$data['avaliacoes'] = $avaliacoesGet[0];

			$comentariosGet = $comentarios->getComentarios('postagem');
			
			$data['comentarios'] = $comentariosGet;

			if($this->loginsession){
				$avaliacoesUsuarioGet = $avaliacoes->where([
					'pagina' => 'postagem',
					'item_id' => $postagensGet[0]->id,
					'usuarios_id' => $this->loginsession['id']
				])->get()->getResult();
				$data['avaliacoesUsuario'] = $avaliacoesUsuarioGet[0] ?? [];
			}

		// var_dump($data['avaliacoes'],  
		// 		//$avaliacoes->getLastQuery(), 
		// 		$data['avaliacoesUsuario'],
		// 		//	$postagensGet[0]
		// 	);

			$data['postagem'] = $postagensGet[0];
			echo view('postagem', $data);
		} else{

			echo view('postagens', $data);
		}

		echo view('footer', $data);

	}

}
