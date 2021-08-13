<?php

namespace App\Controllers;

class Login extends BaseController
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

		$usuarios = new \App\Models\Usuarios();
		// var_dump($ebooks->get());exit;
		$data['session'] = $this->session;
		$data['retorno'] = ['status'=>true];
		$data['loginsession'] = $this->session->get('login');
		// var_dump($data['ebooks'] );exit;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('login', $data);
		echo view('footer', $data);
	}

	public function entrar(){
		// sleep(1);
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$retorno = [];
		$uri = $this->request->getPost('uri');
		
		$identifier = $this->request->getPost('identifier');
		$password = $this->request->getPost('password');

			//var_export($identifier);
		try{
			$usuarios = new \App\Models\Usuarios();
			$query = $usuarios->where("email", $identifier)->orWhere("telefone", $identifier);
			$result = $query->get()->getResult();
			// var_export($result);exit;
			if($result){
				if(count($result)){
					if($result[0]->senha === hash('sha256', $password)){
						$retorno = [
							'status' => true,
							'identifier' => $identifier,
							'msg' => lang("Site.users.logged", [$identifier], $data['user']->lang),
						];
						$this->session->set('login',[
							'id' => $result[0]->id,
							'key' => $result[0]->key,
							'documento' => $result[0]->documento,
							'email' => $result[0]->email,
							'nome' => $result[0]->nome,
							'status' => $result[0]->status,
							'telefone' => $result[0]->telefone,
							'tipo' => $result[0]->tipo,
							'token' => $result[0]->token,
						]);
						// return redirect()->to('/');
					} else {
						$retorno = [
							'status' => false,
							'msg' => lang("Site.users.invalidpassword", [$identifier], $data['user']->lang),
						];

					}
				} else {
					$retorno = [
						'status' => false,
						'msg' => lang("Site.users.notfound", [$identifier], $data['user']->lang),
					];

				}
			} else {
				$retorno = [
					'status' => false,
					'msg' => lang("Site.users.notfound", [$identifier], $data['user']->lang),
				];
			}
		}catch (\CodeIgniter\Database\Exceptions $e)
		{
		    die($e->getMessage());
		}
		$retorno['uri'] = $uri??'';
		echo json_encode($retorno);
	}

	public function sair(){
		$this->session->remove('login');
		return redirect()->to('/');
	}

	public function checkAuth(){
		var_dump($his->sesseion);
	}
}
