<?php

namespace App\Controllers;
include APPPATH."/Libraries/Phpqrcode/qrlib.php";

class Pedidos extends BaseController
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

	public function salvar()
	{
		$data['user'] = $this->userPrefs;

		if(!$this->loginsession){
			$data['loginrequired'] = true;
			$data['retorno'] = ['status' => false, 'msg' => lang("Site.login.not", [], $this->userPrefs[0]->lang), 'uri' => uri_string()];
			echo view('header', $data);
			echo view('sidebar', $data);
			echo view('login', $data);
			echo view('footer', $data);
			exit;
		}
		$pixRetorno = [];
		$gerar_pix = false;
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$data['loginsession'] = $this->loginsession;
		$priceTotalSelected = [];
		$price = 0;

		$selectedItemsArr = [];


		if($this->loginsession){

			/** Pegar cesta da sessão **/
			$cesta = new Cesta();
			$cestaGet = $cesta->get('array');


			foreach($cestaGet as $key => $itemCesta){
 				$price = 0;

 				// var_dump($itemCesta);exit;

				if($itemCesta['checked'] ){
					/** Montar array com itens selecionados **/
					$selectedItemsArr[ $itemCesta['produto']['key'] ] = $itemCesta;
					/** Eliminar itens da cesta que já selecionados no pedido **/
					unset($cestaGet[ $itemCesta['produto']['key'] ]);
					if($itemCesta['produto']['price']){
						$price = $itemCesta['produto']['price'];
					}
					if($itemCesta['produto']['price_promo']){
						$price = $itemCesta['produto']['price_promo'];
					}
					$priceTotalSelected[] = $price;
				}
			}

			// var_dump($priceTotalSelected);
 			// exit;

			$cesta->set($cestaGet);

			if(!empty($selectedItemsArr)){

				$key = hash('md5', $this->loginsession['id'] . date('YmdHis'));
				$dados = [
					'key' => $key,
					'usuarios_id' => $this->loginsession['id'],
					'produtos' => json_encode($selectedItemsArr),
					'price_total' => array_sum($priceTotalSelected),
				];

				$pedidosModel = new \App\Models\Pedidos();
				$pedidosInsertID = $pedidosModel->insert($dados);
				if($pedidosInsertID > 0){
					$idpub = date('yz') . sprintf('%06s', $this->loginsession['id']) . sprintf('%06s', $pedidosInsertID);
					$pedidosModel->update(['id' => $pedidosInsertID], ['idpub' => $idpub]);
				}


				$pedidosGet = $pedidosModel->where('key', $dados['key'])->get();
				$pedidosResult = $pedidosGet->getResult();

				$chave_pix = "0d3003ff-2f13-4c30-90b0-7feb1d6218d6"; //Chave aleatória Nubank Ivan Nack
				$descricao = "pedido". $idpub;
				$beneficiario_pix = "estou bem";
				$cidade_pix = "maringa";
				$identificador = "pedido". $idpub;
				$valor_pix = array_sum($priceTotalSelected);
				// var_dump(exec('pwd'));
				// var_dump(exec('ls -l ../app/Libraries/phpQrcodePix/phpqrcode/qrlib.php'));
				// var_dump(exec('ls -l ../app/Libraries/phpQrcodePix/funcoes_pix.php'));
				// exit;

				include "../app/Libraries/phpQrcodePix/funcoes_pix.php";
				$px[00]="01"; //Payload Format Indicator, Obrigatório, valor fixo: 01
				// Se o QR Code for para pagamento único (só puder ser utilizado uma vez), descomente a linha a seguir.
				//$px[01]="12"; //Se o valor 12 estiver presente, significa que o BR Code só pode ser utilizado uma vez.
				$px[26][00]="br.gov.bcb.pix"; //Indica arranjo específico; “00” (GUI) obrigatório e valor fixo: br.gov.bcb.pix
				$px[26][01]=$chave_pix;
				if (!empty($descricao)) {
					/*
					Não é possível que a chave pix e infoAdicionais cheguem simultaneamente a seus tamanhos máximos potenciais.
					Conforme página 15 do Anexo I - Padrões para Iniciação do PIX  versão 1.2.006.
					*/
					$tam_max_descr=99-(4+4+4+14+strlen($chave_pix));
					if (strlen($descricao) > $tam_max_descr) {
					 $descricao=substr($descricao,0,$tam_max_descr);
					}
					$px[26][02]=$descricao;
			   }
			   $px[52]="0000"; //Merchant Category Code “0000” ou MCC ISO18245
			   $px[53]="986"; //Moeda, “986” = BRL: real brasileiro - ISO4217
			   if ($valor_pix > 0) {
			      // Na versão 1.2.006 do Anexo I - Padrões para Iniciação do PIX estabelece o campo valor (54) como um campo opcional.
			      $px[54]=$valor_pix;
			   }
			   $px[58]="BR"; //“BR” – Código de país ISO3166-1 alpha 2
			   $px[59]=$beneficiario_pix; //Nome do beneficiário/recebedor. Máximo: 25 caracteres.
			   $px[60]=$cidade_pix; //Nome cidade onde é efetuada a transação. Máximo 15 caracteres.
			   $px[62][05]=$identificador;
				//   $px[62][50][00]="BR.GOV.BCB.BRCODE"; //Payment system specific template - GUI
				//   $px[62][50][01]="1.2.006"; //Payment system specific template - versão
			   $pix=montaPix($px);
			   $pix.="6304"; //Adiciona o campo do CRC no fim da linha do pix.
			   $pix.=crcChecksum($pix); //Calcula o checksum CRC16 e acrescenta ao final.
			   $linhas=round(strlen($pix)/120)+1;


			   ob_start();
			   \QRCode::png($pix, null,'M',5);
			   $imageString = base64_encode( ob_get_contents() );
			   ob_end_clean();

			   $pixRetorno['qrcode'] = $imageString;
			   $pixRetorno['copy'] = $pix;
			} else {
				$pixRetorno = [];
			}


			// echo  json_encode(['pedido'=>($pedidosGet[0]??[]), 'pix'=> $pixRetorno]);
			$data['pedido'] = ($pedidosResult??[]);
			$data['pix'] = $pixRetorno;
		} else {
			$data['pedido'] = [];
			$data['pix'] = [];

		}
		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('pedidos_fechar', $data);
		echo view('footer', $data);
	}


}
