<?php

namespace App\Controllers;

class Avaliacao extends BaseController
{
	private $session;
	private $loginsession;
	private $userPrefs;

	public function __construct(){
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
		$data['loginsession'] = $this->loginsession;
		$data['pedidos'] = [];
		if($this->loginsession){
			$pedidos = new \App\Models\Pedidos();
			$data['pedidos'] = $pedidos->getPedidos(null, $this->loginsession['id']);
		}

		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('pedidos', $data);
		echo view('footer', $data);

	}

	public function set($key)
	{
		sleep(1);
		$retorno = [];

		if(!$this->loginsession){
			$data['loginrequired'] = true;
			$retorno = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs->lang)];
		} else{

			$usuarios_id = $this->loginsession['id'];
			$pagina = $this->request->getPost('pagina');
			$value = $this->request->getPost('value');

			

			if(!empty($pagina) && !empty($pagina) && !empty($value) && !empty($key)  ){
				$avaliacoes = new \App\Models\Avaliacoes();
				$avaliacoesGet = $avaliacoes->where([
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'item_id' => $key,
				])->get()->getResult();
				$dados = [
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'item_id' => $key,
					'nota' => $value,
				];
				$avaliacoes->set($dados);
				if(empty($avaliacoesGet)){
					$avaliacoes->insert();
				} else {
					$avaliacoes->where([
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'item_id' => $key,
					])->update();
				}

				$retorno = ['status' => true, 'msg' => lang("Site.home.rating.success", [], $this->userPrefs->lang)];

			} else {
				$retorno = ['status' => false, 'msg' => lang("Site.home.rating.error", [], $this->userPrefs->lang)];
			}
		}
		echo json_encode($retorno);
	}


}
