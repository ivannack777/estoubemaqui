<?php

namespace App\Controllers\Adm;
 use CodeIgniter\Controller;
class Produtos extends Controller
{
	private $session;
	private $db;

	public function __construct(){
		$this->session = \Config\Services::session();
		$this->db = \Config\Database::connect();

	}

	public function index($item=null, $showDeleted=false)
	{

		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$data['loginsession'] = $this->session->get('login');
		$data['retorno'] = [];


		$builder = $this->db->table('produtos');
		$builder->select('id,key,idpub,title,subtitle,pages,author,description,cover,categorias_id,deleted_at');

		echo view('adm/header', $data);
		if($item) {
			$data['produto'] = [];
			$builder->where('key', $item);
			if(!$showDeleted){
				$builder->where('deleted_at', NULL);
			}

			$query = $builder->get();
			// var_dump($query);exit;
			if($query->resultID->num_rows) {
				$produtosResult = $query->getResult();
				$data['produto'] = $produtosResult[0];
				$categorias = new \App\Models\Categorias();
				$data['categorias'] = $categorias->get()->getResult();

			}

			echo view('adm/produtos_edit', $data);
		} else{
			$query = $builder->get();
			$data['produtos'] = $query->getResult();

			echo view('adm/produtos', $data);
		}

		echo view('adm/footer', $data);
		echo view('adm/footer', $data);

	}

	public function save($item=null, $deleted=false)
	{
		$showDeleted = false;
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		//subtitle,pages,author,description,cover');
		if($item){
			$builder = $this->db->table('produtos');

			$categoriasId = $this->request->getPost('categorias_id');
			$idpub = $this->request->getPost('idpub');
			$idpubauto = $this->request->getPost('idpubauto');
			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$author = $this->request->getPost('author');
			$pages = $this->request->getPost('pages');
			$description = $this->request->getPost('description');

			// var_dump($idpubauto, $idpub);

			$m = [' ','á','ã','à','ä','â', 'é','ẽ','è','ë','ê', 'í','ĩ','ì','ï','î', 'ó','õ','ò','ö','ô', 'ú','ũ','ù','ü','û', ];
			$r = ['-','a','a','a','a','a', 'e','e','e','e','e', 'i','i','i','i','i', 'o','o','o','o','o', 'u','u','u','u','u', ];
			if($idpubauto && $idpubauto === 'S'){
				if(!empty($title)){
					$idpub = strtolower($title);
					$idpub = str_replace($m, $r, $idpub);
					$dados['idpub'] = $idpub;
				}
			} else {
				if(!empty($idpub)){
					$idpub = strtolower($title);
					$idpub = str_replace($m, $r, $idpub);
					$dados['idpub'] = $idpub;
				} else {
					$dados['idpub'] = 'NULL';
				}
			}

			$dados['categorias_id'] = $categoriasId;
			$dados['title'] = $title;
			$dados['subtitle'] = $subtitle;
			$dados['author'] = $author;
			$dados['pages'] = $pages;
			$dados['description'] = $description;
			// var_dump($dados);

			$builder->where('key', $item);
			$query = $builder->get();


			if($query->resultID->num_rows === 0) {

				$dados['key'] = hash('md5', time());
				$builder->set($dados);
				$builder->insert();

				$retorno = [
					'status' => true,
					'msg' => lang("Site.form.inserted", [], $data['user']->lang)
				];
				//$item = $this->db->insertID();
				$item = $dados['key'];
				// var_dump($this->db->getLastQuery());
				// exit;
			}elseif($query->resultID->num_rows === 1) {
				if($deleted === 'delete'){
					$builder->set('deleted_at', date('Y-m-d H:i:s'));
					$showDeleted = true;
					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.deleted", [], $data['user']->lang)
					];
				}elseif($deleted === 'recover'){
					$builder->set('deleted_at', NULL);
					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.recovered", [], $data['user']->lang)
					];
				} else {
					$builder->set($dados);
					$retorno = [
						'status' => true,
						'msg' => lang("Site.form.updated", [], $data['user']->lang)
					];

				}
				$builder->where('key', $item);
				$builder->update();
			}

		}
		$this->index($item, $showDeleted, $retorno);

	}
}
