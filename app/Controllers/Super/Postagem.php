<?php

namespace App\Controllers\Super;
use CodeIgniter\Controller;
use App\Models\Postagens;
use App\Dates as Dates;
use App\Helpers\Sanitize;

class Postagem extends Controller
{
	private $db;

	private $session;

	public function __construct(){
		$this->session = \Config\Services::session();
		$loginsession =	$this->session->get('login');

		if($loginsession && isset($loginsession['id'])){
			$usuarios = new \App\Models\Usuarios();
			$this->userPrefs = $usuarios->userPrefs($loginsession['id']);
		} else {
			$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
			$data['retorno'] = ['status' => false, 'msg' => lang("Site.login.not", [], $data['user']->lang), 'uri' => uri_string()];
			echo view('super/header', $data);
			echo view('/login', $data);
			echo view('super/footer', $data);
			var_dump($loginsession, $data['retorno']);exit;
		}
	}

	public function __destruct(){
		$this->session->remove('retorno');
	}

	public function index($key=null)
	{

		$data['user'] = $this->userPrefs[0];
		$data['loginsession'] =	$this->session->get('login');
		$edit = false;

		$retorno = $this->session->get('retorno');

		// var_dump($retorno);

		if($key === 'new') { //$key == 0 => Adicionar item
			$edit = true;
		} else{
			$postagens = new Postagens();

			if($key){
				$postagens->where('key', $key);
				$edit = true;

			} else {
				$postagens->where('deleted_at', NULL);
			}
			$query = $postagens->get();
			$data['postagens'] = $query->getResult();
		}

		$data['session'] = $this->session;
		echo view('super/header', $data);
		//echo view('sidebar', $data);
		if($edit) echo view('super/postagens_edit', $data);
		else echo view('super/postagens', $data);
		echo view('super/footer', $data);

	}

	public function save($key, $deleted=false)
	{
		$retorno['status']  = false;
		$data['user'] = (object)['lang'=>'pt-br', 'timezone' => 'America/Sao_Paulo'];
		//subtitle,pages,author,description,cover');
		$sanitize = new Sanitize();
		if($key){
			$postagens = new Postagens();

			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$text = $this->request->getPost('text');
			$author = $this->request->getPost('author');
			$public = $this->request->getPost('public');

			$title = $sanitize->set($title)->name('ucwords')->get();

			$subtitle = $sanitize->set($subtitle)->name('ucfirst')->get();

			$idpub = $sanitize->set($title)->tolow()->transcode(' ', '-')->get();

			$author = $sanitize->set($author)->name()->get(); //name por padrão faz ucwords

			$dados['title'] = $title;
			$dados['idpub'] = $idpub;
			$dados['subtitle'] = $subtitle;
			$dados['text'] = $text;
			$dados['author'] = $author;
			if($public == 'S'){
				$dados['public_at'] = date('Y-m-d H:i:s');
			} else {

				$dados['public_at'] = null;
			}

			$postagens->where('key', $key);
			$query = $postagens->get();

			if($query->resultID->num_rows === 0) {

				$dados['key'] = hash('md5', microtime(true));
				$postagens->set($dados);
				$retorno['msg'] = lang("Site.form.inserted", [], $data['user']->lang);
				if($postagens->insert()){
					$retorno['status'] = true;
				}
			}elseif($query->resultID->num_rows === 1) {
				if($deleted === 'delete'){
					$postagens->set('deleted_at', date('Y-m-d H:i:s'));

					$retorno['msg'] 	= lang("Site.form.deleted", [], $data['user']->lang);
					$retorno['deleted'] = true;
				}elseif($deleted === 'recover'){
					$postagens->set('deleted_at', NULL);
					$retorno['msg'] = lang("Site.form.recovered", [], $data['user']->lang);
				} else {

					$result = $query->getResult();

					$postagens->set($dados);
					$retorno['msg'] = lang("Site.form.updated", [], $data['user']->lang);

				}
				$postagens->where('key', $key);
				if($postagens->update()){
					$retorno['status'] = true;
				}
			}

		}
		$this->session->set('retorno', $retorno);
		return redirect()->to(site_url('super/postagem/index/'.$key));

	}
}
