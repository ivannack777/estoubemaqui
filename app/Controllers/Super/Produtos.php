<?php

namespace App\Controllers\Super;
use CodeIgniter\Controller;
use PHPUnit\Util\Xml\Validator;

class Produtos extends Controller
{
	private $session;
	private $loginsession;
	// private $db;
	private $userPrefs;

	public function __construct(){
		// $this->db = \Config\Database::connect();
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

		if(!$this->loginsession){
			$data['user'] = $this->userPrefs;
			$data['loginrequired'] = true;
			$data['retorno'] = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs->lang), 'uri' => uri_string()];
			echo view('super/header', $data);
			echo view('login', $data);
			// echo view('super/footer', $data);
			exit;
		}

	}

	public function index($item=null, $showDeleted=false, $retorno=null)
	{

		$data['user'] = $this->userPrefs;
		$data['loginsession'] = $this->session->get('login');
		$data['retorno'] = $retorno;

		$produtos = new \App\Models\Produtos();

		if(!$showDeleted){
			$produtos->where('deleted_at', NULL);
		}


		// var_dump($getProduto);exit;

		echo view('super/header', $data);
		if(!empty($item)){
			$produtos->where('key',$item);
			$getProduto = $produtos->get()->getResult();
			$data['produto'] = $getProduto[0];
			$categorias = new \App\Models\Categorias();
			$data['categorias'] = $categorias->get()->getResult();
			echo view('super/produtos_edit', $data);
		} else{
			$getProduto = $produtos->get()->getResult();
			$data['produtos'] = $getProduto;
			echo view('super/produtos', $data);
		}
		echo view('super/footer', $data);
	}

	public function save($item=null, $deleted=false)
	{
		$showDeleted = false;
		$data['user'] = $this->userPrefs;
		//subtitle,pages,author,description,cover');


		// if(!$this->loginsession){
		// 	$data['loginrequired'] = true;
		// 	$data['retorno'] = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs->lang), 'uri' => uri_string()];
		// 	echo view('super/header', $data);
		// 	echo view('login', $data);
		// 	echo view('super/footer', $data);
		// 	exit;
		// }


			$checkPost = $this->request->getPost();
			if($item && !empty($checkPost)){


				$categoriasId = $this->request->getPost('categorias_id');
				$idpub = $this->request->getPost('idpub');
				$idpubauto = $this->request->getPost('idpubauto');
				$title = $this->request->getPost('title');
				$subtitle = $this->request->getPost('subtitle');
				$cover = null;
				$price = $this->request->getPost('price');
				$price_promo = $this->request->getPost('price_promo');
				$tags = $this->request->getPost('tags');
				$author = $this->request->getPost('author');
				$pages = $this->request->getPost('pages');
				$description = $this->request->getPost('description');
				$files = $this->request->getFiles('cover');
				if($files) {
					$filecover = $files['cover'];
					$newName = $filecover->getRandomName();
					$filecover->move('assets/images/produtos/', $newName);
					$cover = $newName;
				}

				$m = [' ','á','ã','à','ä','â', 'é','ẽ','è','ë','ê', 'í','ĩ','ì','ï','î', 'ó','õ','ò','ö','ô', 'ú','ũ','ù','ü','û','ç' ];
				$r = ['-','a','a','a','a','a', 'e','e','e','e','e', 'i','i','i','i','i', 'o','o','o','o','o', 'u','u','u','u','u','c' ];
				if($idpubauto && $idpubauto === 'S'){
					if(!empty($title)){
						$idpub = strtolower($title);
						$idpub = str_replace($m, $r, $idpub);
						$dados['idpub'] = $idpub;
					}
				} else {
					if(!empty($idpub)){
						$idpub = strtolower($idpub);
						$idpub = str_replace($m, $r, $idpub);
						$dados['idpub'] = $idpub;
					} else {
						$dados['idpub'] = 'NULL';
					}
				}

				$price = str_replace(',', '.', $price);
				$price_promo = str_replace(',', '.', $price_promo);

				$tags = trim($tags);

				$dados['categorias_id'] = $categoriasId;
				$dados['title'] = $title;
				$dados['subtitle'] = $subtitle;
				$dados['cover'] = $cover;
				$dados['price'] = $price;
				$dados['price_promo'] = $price_promo;
				$dados['tags'] = $tags;
				$dados['author'] = $author;
				$dados['pages'] = $pages;
				$dados['description'] = $description;

				$validation =  \Config\Services::validation();

				// var_dump($dados);
				// exit;


				// $validation->setRule('categorias_id', lang('Site.home.products.labels.category', [],  $this->userPrefs->lang),'integer|required');
				$validation->setRules([
					'categorias_id' => [
						'label'  => lang('Site.home.products.labels.category', [],  $this->userPrefs->lang),
						'rules'  => 'required|integer',
						'errors' => [
							'required' => lang('Site.form.validation.required', [lang('Site.home.products.labels.category',[],  $this->userPrefs->lang)],  $this->userPrefs->lang),
							'integer' => lang('Site.form.validation.integer', [lang('Site.home.products.labels.category',[],  $this->userPrefs->lang)],  $this->userPrefs->lang),
						],
					],
					'title' => [
						'label'  => lang('Site.home.products.labels.title', [],  $this->userPrefs->lang),
						'rules'  => 'required|min_length[5]',
						'errors' => [
							'required' => lang('Site.form.validation.required', [lang('Site.home.products.labels.title', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
							'min_length' => lang('Site.form.validation.min_length', [lang('Site.home.products.labels.title', [],  $this->userPrefs->lang), 5],  $this->userPrefs->lang),
						],
					],
					'subtitle' => [
						'label'  => lang('Site.home.products.labels.subtitle', [],  $this->userPrefs->lang),
						'rules'  => 'required|min_length[5]',
						'errors' => [
							'required' => lang('Site.form.validation.required', [lang('Site.home.products.labels.subtitle', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
							'min_length' => lang('Site.form.validation.min_length', [lang('Site.home.products.labels.subtitle', [],  $this->userPrefs->lang), 5],  $this->userPrefs->lang),
						],
					],
					'description' => [
						'label'  => lang('Site.home.products.labels.description', [],  $this->userPrefs->lang),
						'rules'  => 'required|min_length[5]',
						'errors' => [
							'required' => lang('Site.form.validation.required', [lang('Site.home.products.labels.description', [],  $this->userPrefs->lang)],  $this->userPrefs->lang),
							'min_length' => lang('Site.form.validation.min_length', [lang('Site.home.products.labels.description', [],  $this->userPrefs->lang), 5],  $this->userPrefs->lang),
						],
					],
					'tags' => [
						'label'  => lang('Site.home.products.labels.tags', [],  $this->userPrefs->lang),
						'rules'  => 'tags',
						'errors' => [
							'tags' => lang('Site.form.validation.tags', [lang('Site.home.products.labels.tags', [],  $this->userPrefs->lang), 3],  $this->userPrefs->lang),
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
					// var_dump($this->request->getPost(),$item);exit;

					$produtos = new \App\Models\Produtos();
					$produtos->where('key', $item);
					$produtosGet = $produtos->get()->getResult();

					if(empty($produtosGet)) {

						$dados['key'] = hash('md5', time());
						$produtos->set($dados);
						$produtos->insert();

						$retorno = [
							'status' => true,
							'msg' => lang("Site.form.inserted", [], $data['user']->lang)
						];
						//$item = $this->db->insertID();
						$item = $dados['key'];
						// var_dump($this->db->getLastQuery());
						// exit;
					}
					elseif(count($produtosGet) === 1) {
						if($deleted === 'delete'){
							$produtos->set('deleted_at', date('Y-m-d H:i:s'));
							$showDeleted = true;
							$retorno = [
								'status' => true,
								'msg' => lang("Site.form.deleted", [], $data['user']->lang)
							];
						}elseif($deleted === 'recover'){
							$produtos->set('deleted_at', NULL);
							$retorno = [
								'status' => true,
								'msg' => lang("Site.form.recovered", [], $data['user']->lang)
							];
						} else {
							$produtos->set($dados);
							$retorno = [
								'status' => true,
								'msg' => lang("Site.form.updated", [], $data['user']->lang)
							];

						}
						$produtos->where('key', $item);
						$produtos->update();
					}
				}
			}
			else {
				$retorno = [
					'status' => false,
					'msg' => lang("Site.form.requestEmpty", [], $data['user']->lang)
				];
			}


		// var_dump($this->request->getPost(),$item,$retorno);exit;
		$this->index($item, $showDeleted, $retorno);

	}
}
