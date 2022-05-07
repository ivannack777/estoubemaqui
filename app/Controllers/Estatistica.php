<?php

namespace App\Controllers;
use CodeIgniter\HTTP\RequestInterface;

class Estatistica extends BaseController
{

	protected $request;

	public function __construct(RequestInterface $request){
		$this->db = \Config\Database::connect();
		$this->session = \Config\Services::session();
		$this->request = $request;
	}

	/**
	 * Verifica as informações do request URI,
	 * Verifica se pagina já foi visiata durante a sessão atual
	 * Caso não tenha sido visitado, salva em estatisticas
	 */
	public function index()
	{
		// $uriListArray = [];
		/** @var String $cureentURI URI atual */
		$cureentURI = $this->request->uri->getPath();

		/**
		 * Verifica !se a URI inicia com super, que é a sessão de administração
		 */
		if(!preg_match('/^super/', $cureentURI)){
			/** @var Array $uriListSession a lista de URI já visitados nesta sessão */
			$uriListSession = $this->session->get('urilist')??[];

			/** @var String $ipAddress IP remoto do usuario */
			$ipAddress = $this->request->getIPAddress();

			/** @var Object $agent UserAgent */
			$agent = $this->request->getUserAgent();

			/** @var String $currentAgent tipo do userAgent */
			if ($agent->isBrowser())
			{
				$currentAgent = $agent->getBrowser().' '.$agent->getVersion();
			}
			elseif ($agent->isRobot())
			{
				$currentAgent = $this->agent->robot();
			}
			elseif ($agent->isMobile())
			{
				$currentAgent = $agent->getMobile();
			}
			else
			{
				$currentAgent = 'Unidentified User Agent';
			}

			/** @var String $currentAgent OS do userAgente */
			$platform = $agent->getPlatform(); // Platform info (Windows, Linux, Mac, etc.)

			/** Verifica se a URI já está na lista salva na sessão */
			if(in_array($cureentURI, $uriListSession)){
				 //echo "Voce já visitou a pagina $cureentURI nesta sessão";
			} else {
				/** Caso não tenha visitado salva em 'estatisticas' para estatisticas de acesso */
				 //echo "Voce ainda não visitou a pagina $cureentURI nesta sessão";
				if( is_array($uriListSession)){
					array_push($uriListSession, $cureentURI);
				} else{
					$uriListSession[] = $cureentURI;
				}

				$loginSession = $this->session->get('login');

				$insert = [
					'uri' => $cureentURI,
					'ip' => $ipAddress,
					'user_agent' => $currentAgent,
					'platform' => $platform,
					'usuarios_id' => ($loginSession['id'] ?? null),
				];
				/** salvar no banco */
				$this->db->table('estatisticas')->insert($insert);
			}
			//var_dump($cureentURI, $ipAddress, $uriListSession,$currentAgent,$platform, ($loginSession??'loginSession'),  ($insert??'insert'));
			$uriListSession = array_unique($uriListSession);
			$this->session->set('urilist', $uriListSession);
			//exit;
		}
	}

}
