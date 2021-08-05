<?php

namespace App\Controllers;
include APPPATH."/Libraries/Phpqrcode/qrlib.php";

class Pedidos extends BaseController
{
	private $session;

	public function __construct(){
		$this->session = \Config\Services::session();
	}

	public function index()
	{
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$data['loginsession'] = $this->session->get('login');
		$pedidos = new \App\Models\Pedidos();
		$data['pedidos'] = $pedidos->getPedidos(null);

		echo view('header', $data);
		echo view('sidebar', $data);
		echo view('pedidos', $data);
		echo view('footer', $data);

	}

	public function salvar()
	{
		$pixRetorno = [];
		$gerar_pix = false;
		$data['user'] = (object)['lang'=>'pt-br', 'price_simbol' => "R$"];
		$loginsession = $this->session->get('login');
		$data['loginsession'] = $loginsession;
		$priceTotal = $this->request->getPost('priceTotal');
		$selectedItems = $this->request->getPost('selectedItems');
		$pedidosModel = new \App\Models\Pedidos();
		$selectedItemsArr = [];
		$cesta = new Cesta();
		$cestaGet = $cesta->get('array');

var_dump($priceTotal, $selectedItems);

		foreach($cestaGet as $id => $itemCesta){

			if(in_array($id, $selectedItems)){
				$selectedItemsArr[$id] = $itemCesta;
			}
		}
			var_dump($selectedItemsArr);
			exit;
		if($loginsession){
			// var_dump($loginsession);exit;
			$key = hash('md5', $loginsession['id'] . date('YmdHis'));
			$dados = [
				'key' => $key,
				'usuarios_id' => $loginsession['id'],
				'produtos' => json_encode($selectedItemsArr),
				'price_total' => $priceTotal,
			];


			if( count($pedidosGet) ){
				$pedidosModel->update(['key' => $key], $dados);
				$idpub = $pedidosGet[0]->idpub;
			} else {
				$pedidosInsertID = $pedidosModel->insert($dados);
				$idpub = date('yz') . sprintf('%06s', $loginsession['id']) . sprintf('%06s', $pedidosInsertID);
				$pedidosModel->update(['id' => $pedidosInsertID], ['idpub' => $idpub]);
			}


			$pedidosGet = $pedidosModel->getPedidos($key);


			if($pedidosGet && !empty($pedidosGet[0])){
				$pedidosGet[0]->pricetotal = $priceTotal;
				$chave_pix = "0d3003ff-2f13-4c30-90b0-7feb1d6218d6"; //Chave aleatória Nubank Ivan Nack
				$descricao = "pedido". $idpub;
				$beneficiario_pix = "estou bem";
				$cidade_pix = "maringa";
				$identificador = "pedido". $idpub;
				$valor_pix = $priceTotal;
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
			$data['pedido'] = ($pedidosGet[0]??[]);
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
