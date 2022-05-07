<?php

namespace App\Controllers;
use CodeIgniter\Email\Email;
class Login extends BaseController
{
	private $session;
	private $loginsession;

	public function __construct(){
		$this->session = \Config\Services::session();
		$this->loginsession = $this->session->get('login');
		if($this->loginsession){
			//$usuarios = new ;
			$userPrefs = \App\Models\Usuarios::userPrefs($this->loginsession['id']);
			// var_dump($this->loginsession);exit;
			$this->userPrefs = $userPrefs[0];
		} else{
			$config = config('App');
			$this->userPrefs = (object)$config->defaultUserPrefs;
		}
	}

	public function index()
	{
		$data['user'] = $this->userPrefs;

		//$usuarios = new \App\Models\Usuarios();
		// var_dump($ebooks->get());exit;
		$uri = $this->request->getGet('uri');
		$data['session'] = $this->session;
		$data['retorno'] = ['status'=>true, 'uri'=>$uri];
		$data['loginsession'] = $this->session->get('login');
		// var_dump($data['ebooks'] );exit;
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('login', $data);
		echo view('footer', $data);
	}

	public function entrar(){
		sleep(13);
		// sleep(1);
		$data['user'] = $this->userPrefs;
		$retorno = [];
		$uri = $this->request->getPost('uri');

		$identifier = trim($this->request->getPost('identifier'));
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

	static public function checkAuth(){
		// var_dump(__CLASS__, __FUNCTION__);
	}
	public function cadastro(){
		$data['user'] = $this->userPrefs;
		$data['retorno'] = ['status'=>true, 'uri'=>''];
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('login_cadastro', $data);
		echo view('footer', $data);
	}

	public function salvar(){
		// sleep(1);
		$data['user'] = $this->userPrefs;
		$retorno = [];
		$uri = $this->request->getPost('uri');

		$nome = trim($this->request->getPost('nome'));
		$email = trim($this->request->getPost('email'));
		$telefone = trim($this->request->getPost('telefone'));
		$password = $this->request->getPost('password');

		// var_dump($nome,$email,$telefone,$password);

		$sanitize = new \App\Helpers\Sanitize();
		$dados['nome'] = $sanitize->set($nome)->name()->get();
		$dados['email'] = $sanitize->set($email)->email()->get();
		$dados['telefone'] = $sanitize->set($telefone)->phone()->get();
		$dados['password'] = $sanitize->set($password)->outer()->get();
		$validation =  \Config\Services::validation();
		$validation->setRules([
				'nome' => [
					'label'  => lang('Site.users.name', [],  $this->userPrefs->lang),
					'rules'  => 'required|min_length[5]',
					'errors' => [
						'required' => lang('Site.form.validation.required', [lang('Site.users.name',[],  $this->userPrefs->lang)],  $this->userPrefs->lang),
						'min_length' => lang('Site.form.validation.min_length', [lang('Site.users.name',[],  $this->userPrefs->lang), 5],  $this->userPrefs->lang),
					],
				],
				'email' => [
					'label'  => lang('Site.users.email', [],  $this->userPrefs->lang),
					'rules'  => 'valid_email',
					'errors' => [
						'valid_email' => lang('Site.form.validation.email', [lang('Site.users.email', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
					],
				],
				'telefone' => [
					'label'  => lang('Site.users.phone', [],  $this->userPrefs->lang),
					'rules'  => 'integer',
					'errors' => [
						'integer' => lang('Site.form.validation.integer', [lang('Site.users.phone', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
					],
				],
				'password' => [
					'label'  => lang('Site.users.password', [],  $this->userPrefs->lang),
					'rules'  => 'required|min_length[6]',
					'errors' => [
						'required' => lang('Site.form.validation.required', [lang('Site.users.password', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
						'min_length' => lang('Site.form.validation.min_length', [lang('Site.users.password', [],  $this->userPrefs->lang), 6],  $this->userPrefs->lang),
					],
				],


			]
		);

		if($validation->run($dados) === false){
			$this->respondCode = 400;
			$retorno['status'] = false;
			$retorno['msg'] = implode('; ', $validation->getErrors());
			//var_dump($this->request->getPost(),$item,$retorno);exit;
		} else {
			$dados['password'] = hash('sha256', $dados['password']);
			$dados['key'] 	   = hash('md5', microtime(true));
			try{
				$usuarios = new \App\Models\Usuarios();
				$query = $usuarios->where("email", $dados['email'])->orWhere("telefone", $dados['telefone']);
				$result = $query->get()->getResult();
				  // var_dump($dados,$result,$query->getLastQuery());exit;
				if(count($result)){
					if($result[0]->email == $dados['email']) $identifier[]= lang('Site.users.email', [],  $this->userPrefs->lang);
					if($result[0]->telefone == $dados['telefone']) $identifier[]= lang('Site.users.phone', [],  $this->userPrefs->lang);
					$retorno=[
						'status' => false,
						'msg' => lang("Site.users.exists", [(count($identifier)>1?'s':''), implode('; ', $identifier)], $data['user']->lang),
					];
				} else {
					if($usuarios->save($dados)){
						$retorno=[
							'status' => true,
							'msg' => lang("Site.users.saved", [], $data['user']->lang),
						];
					}
				}
			}catch (\CodeIgniter\Database\Exceptions $e){
			    die($e->getMessage());
			}
		}
		$retorno['uri'] = $uri??'';
		// var_dump($retorno);
		echo json_encode($retorno);
	}

	public function passforgot(){
		$data = [];
		$data['user'] = $this->userPrefs;
		$data['email'] = trim($this->request->getGet('email'));
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('login_passforgot', $data);
		echo view('footer', $data);

	}

	public function passforgotSend(){
		$data = [];
		$data['user'] = $this->userPrefs;

		$para = trim($this->request->getPost('email'));
		
		$usuarios = new \App\Models\Usuarios();
		$query = $usuarios->where("email", $para);
		$usuario = $query->get()->getResult();
		if(count($usuario)){
			$usuario = $usuario[0];
			$randon = [
				'time' => date('Y-m-d H:i:s'),
				'code' => substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,6)
			];



			//var_dump($randon,$usuario);

			
			$email = \Config\Services::email();


			$email->setFrom('ivannack@gmail.com', 'Ivan Nack');
			$email->setTo($para);
			//$email->setCC('another@another-example.com');
			//$email->setBCC('them@their-example.com');

			$email->setSubject( lang("Site.users.passforgot", [], $data['user']->lang) );
			$email->setMessage(
				"<strong>Olá ". $usuario->nome. "!</strong><br>\r\n".
				"<p>Recebemos uma solicitação de recuperação de senha referente ao e-mail</p>\r\n".
				"<div style=\"padding: 15px;font-size: 18px;font-weight: bold;\">". $para ."</div>\r\n".
				"<p>Clique no link abaixo e informe este código de segurança:</p>\r\n".
				"<div style=\"padding: 15px;font-size: 18px;font-weight: bold;\">". $randon['code'] ."</div>\r\n".
				"<a href=\"". site_url('/login/passrecover?email='. $para) ."\">Clique aqui</a> para cadastrar uma nova senha\r\n".
				"<p>Se esta solicitação não partiu de você, orientamos a atualizar sua senha de cadastro o mais breve possível.</p>\r\n".
				"Obrigado\r\n"
			);

			if($email->send()){

				// Will only print the email headers, excluding the message subject and body
				// echo $email->printDebugger(['headers']);
				// var_dump($email);

				$usuarios->where("email", $para)->set(['randonCode'=> json_encode($randon)])->update();

				$retorno = [
					'status' => true,
					'msg' => lang("Site.users.passforgotsend", [$para], $data['user']->lang),
				];
			} else {
				$retorno = [
					'status' => false,
					'msg' => lang("Site.users.passforgotsend", [$para], $data['user']->lang),
				];
			}

		} else {
			$retorno = [
				'status' => false,
				'msg' => lang("Site.users.notfound", [$para], $data['user']->lang),
			];
		}
		echo json_encode($retorno);
	}

	public function passrecover(){
		$data = [];
		$data['user'] = $this->userPrefs;
		$email = trim($this->request->getGet('email'));
		var_dump($email);
		$data['email'] = $email;
		$data['timeExpired'] = false;

		$usuarios = new \App\Models\Usuarios();
		$query = $usuarios->where("email", $email);
		$usuario = $query->get()->getResult();
		if(count($usuario)){
			$usuario = $usuario[0];
			$randon = json_decode($usuario->randonCode);
			if($randon && $randon->time){
				try{
					$randonTime = new \DateTime($randon->time);
					$timeLimit = new \DateTime();
					$timeLimit->modify('24 hours');
					if($randon->time < $timeLimit){
						$data['retorno'] = [
							'status' => true,
							'msg' => '',
						];
					} else {
						$data['timeExpired'] = true;
						$data['retorno'] = [
							'status' => false,
							'msg' => lang("Site.users.passrecover.randonCodeExpired", [], $data['user']->lang),
						];
					}
				} catch(Exception $e){

				}
				var_dump($randonTime);

			}
			var_dump($usuario);
		}
		echo view('header', $data);
		//echo view('sidebar', $data);
		echo view('login_recover', $data);
		//echo view('footer', $data);

	}


	public function passrecoverSave($email){
		$data = [];
		$data['user'] = $this->userPrefs;
		$retorno = [];
		$newpass = trim($this->request->getGet('newpass'));
		$renewpass = trim($this->request->getGet('renewpass'));
		var_dump($email,$newpass, $renewpass);

		$usuarios = new \App\Models\Usuarios();
		$query = $usuarios->where("email", $email);
		$usuario = $query->get()->getResult();
		if(count($usuario)){
			$usuario = $usuario[0];

		}
		var_dump($usuario);
		echo json_encode($retorno);

	}

}
