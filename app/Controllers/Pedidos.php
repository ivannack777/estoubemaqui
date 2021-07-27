<?php

namespace App\Controllers;
use App\Libraries\phpQrcodePix\phpqrcodes\QRCode;
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
		$priceTotal = $this->request->getPost('pricetotal');
		$pedidosModel = new \App\Models\Pedidos();
		$dataItens = [];
		$cesta = new Cesta();
		$cestaGet = $cesta->get('array');


		if($loginsession){
			$key = hash('md5', $loginsession['key']);
			$dados = [
				'key' => $key,
				'usuarios_id' => $loginsession['id'],
				'produtos' => json_encode($cestaGet),
				'price_total' => $priceTotal,
			];

			$pedidosGet = $pedidosModel->getPedidos($key);

			if( count($pedidosGet) ){


				$pedidosModel->update(['key' => $key], $dados);
			} else {
				$pedidosModel->insert($dados);
			}

		}

		$pedidosGet = $pedidosModel->getPedidos($key);

		if($pedidosGet && !empty($pedidosGet[0])){
			$gerar_pix = true;
		}

		if ($gerar_pix){
			$chave_pix = "0d3003ff-2f13-4c30-90b0-7feb1d6218d6"; //Chave aleatória Nubank Ivan Nack
			$descricao = "PAGAMENTO_PEDIDO";
			$beneficiario_pix = "IVAN NACK";
			$cidade_pix = "MARINGA";
			$identificador = "$key";
			$valor_pix = $priceTotal;
			// var_dump(exec('pwd'));
			// var_dump(exec('ls -l ../app/Libraries/phpQrcodePix/phpqrcode/qrlib.php'));
			// var_dump(exec('ls -l ../app/Libraries/phpQrcodePix/funcoes_pix.php'));
			// exit;
			include "../app/Libraries/phpQrcodePix/phpqrcode/qrlib.php"; 
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
		   ?>
		   <div class="card">
		   <h3>Linha do Pix (copia e cola):</h3>
		   <div class="row">
		      <div class="col">
		      <textarea class="text-monospace" id="brcodepix" rows="<?= $linhas; ?>" cols="130" onclick="copiar()"><?= $pix;?></textarea>
		      </div>
		      <div class="col md-1">
		      <p><button type="button" id="clip_btn" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Copiar código pix" onclick="copiar()"><i class="fas fa-clipboard"></i></button></p>
		      </div>
		   </div>
		   </div>
		   <h3>Imagem de QRCode do Pix:</h3>
		   <p>
		   <img src="logo_pix.png"><br>
		   <?php
		   ob_start();
		   QRCode::png($pix, null,'M',5);
		   $imageString = base64_encode( ob_get_contents() );
		   ob_end_clean();
		   // Exibe a imagem diretamente no navegador codificada em base64.
		   echo '<img src="data:image/png;base64,' . $imageString . '"></p>';
		   $pixRetorno['qrcode'] = $imageString;
		   $pixRetorno['copy'] = $pix;
		}


		echo  json_encode(['pedido'=>($pedidosGet[0] ?? []), 'pix'=>$pixRetorno]);
	}


}
