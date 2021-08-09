<?php

namespace App\Controllers\Adm;
use CodeIgniter\Controller;
use App\Dates as Dates;
class Postagens extends Controller
{
	private $db;
	private $table;
	private $columns;
	private $session;

	public function __construct(){
		$this->db = \Config\Database::connect();
		$this->table = 'postagens';
		$this->columns = ['id','idpub','title','subtitle','text','author','public_at','created_at','updated_at','deleted_at'];
		$this->session = \Config\Services::session();
		$loginsession =	$this->session->get('login');
		$usuarios = new \App\Models\Usuarios();
		$this->userPrefs = $usuarios->userPrefs($loginsession['id']);
	}

	public function __destruct(){
		$this->session->remove('retorno');
	}

	public function index($item=null)
	{

		$data['user'] = $this->userPrefs[0];
		$data['loginsession'] =	$this->session->get('login');
		$edit = false;

		$retorno = $this->session->get('retorno');

		// var_dump($retorno);

		if($item === 'new') { //$item == 0 => Adicionar item
			$edit = true;
		} else{
			$builder = $this->db->table($this->table);
			$builder->select($this->columns);

			if($item){
				$builder->where('idpub', $item);
				$edit = true;

			} else {
				$builder->where('deleted_at', NULL);
			}
			$query = $builder->get();
			$data['postagens'] = $query->getResult();
		}

		$data['session'] = $this->session;
		echo view('adm/header', $data);
		//echo view('sidebar', $data);
		if($edit) echo view('adm/postagens_edit', $data);
		else echo view('adm/postagens', $data);
		echo view('adm/footer', $data);

	}

	public function save($item=null, $deleted=false)
	{

		$data['user'] = (object)['lang'=>'pt-br', 'timezone' => 'America/Sao_Paulo'];
		//subtitle,pages,author,description,cover');
		if($item){
			$builder = $this->db->table($this->table);

			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$text = $this->request->getPost('text');
			$author = $this->request->getPost('author');
			$public = $this->request->getPost('public');

			$dados['title'] = $title;
			$dados['subtitle'] = $subtitle;
			$dados['text'] = $text;
			$dados['author'] = $author;


			$builder->where('idpub', $item);
			$query = $builder->get();


			if($query->resultID->num_rows === 0) {

				$dados['idpub'] = hash('sha256', $title . time());
				if($public == 'S'){
					$dados['public_at'] = date('Y-m-d H:i:s');
				} else {

					$dados['public_at'] = null;
				}
				$builder->set($dados);
				$builder->insert();

				$retorno = [
					'status' => true,
					'msg' => lang("Site.form.inserted", [], $data['user']->lang)
				];
				//$item = $this->db->insertID();
				$item = $dados['idpub'];
				// var_dump($this->db->getLastQuery());
				// exit;
			}elseif($query->resultID->num_rows === 1) {
				if($deleted === 'delete'){
					$builder->set('deleted_at', date('Y-m-d H:i:s'));

					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.deleted", [], $data['user']->lang),
						'deleted' => true,
					];
				}elseif($deleted === 'recover'){
					$builder->set('deleted_at', NULL);
					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.recovered", [], $data['user']->lang)
					];
				} else {

					$result = $query->getResult();

					if($public == 'S'){
						if($result[0]->public_at===null){
							$dados['public_at'] = date('Y-m-d H:i:s');
						}
					} else {

						$dados['public_at'] = null;
					}

					$builder->set($dados);
					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.updated", [], $data['user']->lang)
					];

				}
				$builder->where('idpub', $item);
				$builder->update();
			}

		}
		$this->session->set('retorno', $retorno);
		return redirect()->to(site_url('adm/postagens/index/'.$item));

	}
}
