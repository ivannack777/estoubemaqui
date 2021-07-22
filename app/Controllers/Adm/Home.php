<?php

namespace App\Controllers\Adm;
 use CodeIgniter\Controller;
class Home extends Controller
{
	private $db;

	public function __construct(){
		$this->db = \Config\Database::connect();
	}

	public function index()
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		echo view('adm/header', $data);
		//echo view('sidebar', $data);
		echo view('adm/index', $data);
		echo view('adm/footer', $data);
	}

	public function ebooks($item=null, $showDeleted=false, $retorno=null)
	{
		$data['user'] = (object)['lang'=>'pt-br'];
		$data['retorno'] = $retorno;
		if($item === 'new') { //$item == 0 => Adicionar item
			echo view('header', $data);
			echo view('adm/ebook_edit', $data);
		} else{
			$builder = $this->db->table('books');
			$builder->select('id,key,idpub,title,subtitle,pages,author,description,cover,deleted_at');
			if(!$showDeleted){
				$builder->where('deleted_at', NULL);
			}
			if($item){
				$builder->where('idpub', $item);

			}
			$query = $builder->get();
			$data['ebooks'] = $query->getResult();

			// echo view('sidebar', $data);
			
			echo view('header', $data);
			if($query->resultID->num_rows === 1) {
				$data['ebook'] = $data['ebooks'][0];
				echo view('adm/ebook_edit', $data);
			} else{

				echo view('adm/ebooks', $data);
			}
		}

		echo view('footer', $data);

	}

	public function ebooks_save($item=null, $deleted=false)
	{
		$showDeleted = false;
		$data['user'] = (object)['lang'=>'pt-br'];
		//subtitle,pages,author,description,cover');
		if($item){
			$builder = $this->db->table('books');

			$idpub = $this->request->getPost('idpub');
			$idpubauto = $this->request->getPost('idpubauto');
			$title = $this->request->getPost('title');
			$subtitle = $this->request->getPost('subtitle');
			$author = $this->request->getPost('author');
			$pages = $this->request->getPost('pages');
			$description = $this->request->getPost('description');

var_dump($idpubauto, $idpub);

			if($idpubauto && $idpubauto === 'S'){
				if(!empty($title)){
					$idpub = strtolower($title);
					$m = [' ','á','ã','à','ä','â', 'é','ẽ','è','ë','ê', 'í','ĩ','ì','ï','î', 'ó','õ','ò','ö','ô', 'ú','ũ','ù','ü','û', ];
					$r = ['-','a','a','a','a','a', 'e','e','e','e','e', 'i','i','i','i','i', 'o','o','o','o','o', 'u','u','u','u','u', ];
					$idpub = str_replace($m, $r, $idpub);
					$dados['idpub'] = $idpub;
				}
			} else {
				if(!empty($idpub)){
					$idpub = strtolower($title);
					$idpub = str_replace($m, $r, $idpub);
					$dados['idpub'] = $idpub;
				}
			}

			$dados['title'] = $title;
			$dados['subtitle'] = $subtitle;
			$dados['author'] = $author;
			$dados['pages'] = $pages;
			$dados['description'] = $description;
			var_dump($dados);

			$builder->where('idpub', $item);
			$query = $builder->get();


			if($query->resultID->num_rows === 0) {

				$dados['idpub'] = hash('sha256', $title . time());
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
				$builder->where('idpub', $item);
				$builder->update();
			}

		}
		$this->ebooks($item, $showDeleted, $retorno);

	}
}
