<?php

namespace App\Controllers;

class Comentarios extends BaseController
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
		sleep(2);
		$retorno = [];
		$data['user'] = $this->userPrefs;
		if(!$this->loginsession){
			$data['loginrequired'] = true;
			$retorno = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs->lang)];
		} else{

			$usuarios_id = $this->loginsession['id'];
			$pagina = $this->request->getPost('pagina');
			$value = $this->request->getPost('value');

			if(!empty($usuarios_id) && !empty($pagina) && !empty($value) && !empty($key)  ){
				$comentarios = new \App\Models\Comentarios();
				$comentariosGet = $comentarios->where([
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'item_id' => $key,
				])->get()->getResult();
				$dados = [
					'key' => hash('md5', microtime(true)),
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'item_id' => $key,
					'texto' => $value,
				];
				$comentarios->set($dados);
				// if(empty($comentariosGet)){
					$comentarios->insert();
				// } else {
				// 	$comentarios->where([
				// 	'usuarios_id' => $usuarios_id,
				// 	'pagina' => $pagina,
				// 	'item_id' => $key,
				// 	])->update();
				// }
				$comentariosGet = $comentarios->getComentarios('postagem');
				$data['comentarios'] = $comentariosGet;
				$content = view('postagens_comentarios', $data);

				$retorno = ['status' => true,'content'=>$content, 'msg' => lang("Site.home.comments.success", [], $this->userPrefs->lang)];

			} else {
				$retorno = ['status' => false, 'msg' => lang("Site.home.comments.error", [], $this->userPrefs->lang)];
			}
		}
		echo json_encode($retorno);
	}

	public function delete($key)
	{
		$retorno = [];

		if(!$this->loginsession){
			$data['loginrequired'] = true;
			$retorno = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs->lang)];
		} else{

			$usuarios_id = $this->loginsession['id'];
			$pagina = $this->request->getPost('pagina');
			if(!empty($pagina) && !empty($usuarios_id) && !empty($key)  ){
				$comentarios = new \App\Models\Comentarios();
				if($comentariosDelte = $comentarios->where([
					'usuarios_id' => $usuarios_id,
					'pagina' => $pagina,
					'key' => $key,
				])->delete()){
					$retorno = ['status' => true, 'msg' => lang("Site.home.comments.delete_success", [], $this->userPrefs->lang)];
				} else {
					$retorno = ['status' => false, 'msg' => lang("Site.home.comments.delete_error", ['Base error'], $this->userPrefs->lang)];
				}

			} else {
				$retorno = ['status' => false, 'msg' => lang("Site.home.comments.delete_error", ['Params error'], $this->userPrefs->lang)];
			}
		}
		echo json_encode($retorno);
	}
}
