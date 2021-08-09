

		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/produto_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
					</section>
						<section>
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.basket.title", [], $user->lang); ?></h2>
								<div class="style2" id="produtos" >
									<div id="cestadiv">

									</div>
									

									


									<p id="cestaAlert" class="alert alert-info" style="display:<?= count($itens) ? 'none' : 'block' ?>">
										<span class="fa-stack fa-2x">
											<i class="far fa-file fa-2x"></i>
											<i class="fas fa-times fa-stack-1x text-danger"></i>
										</span>
										<?= lang("Site.basket.empty", [], $user->lang); ?>
									</p>


							</div>

					</section>

			</div>
<script type="text/javascript">
var cestaPedido;

getCesta();




function getCesta(){
    $.ajax({

        url : '<?= site_url('cesta/get/json') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            // console.log(retorno.length, retorno);
            cestaMount(retorno);
            calcCesta(retorno);


        },
        error: function(st, text){
            console.log(st, text);
        }
    });
}


$("#pedidoSave").click(function(){
	pedidosSalvar();
});

function pedidosSalvar(){
	console.log('pedidosSalvar');

    $.ajax({

        url : '<?= site_url('pedidos/salvar') ?>',
        method: 'post',
        data: {
        	pricetotal: $("#price_total").val()
        },
        dataType: 'json',
        beforeSend: function(){

        },
        success: function(retorno){

            $("#cestadiv").html(
            	'<div class="divtable">'+
            	'  <div class="divrow">'+
            	'    <div class="divcell" style="vertical-align: top;">'+
            	'       <h3>Seu pedido '+ retorno.pedido.idpub +' está feito!</h3>'+
            	'       O valor total é  <span style="font-size: 1.5em;">'+retorno.pedido.pricetotal +'</span><br>'+
            	'		O pagamento pode ser feito por transfência PIX <br />'+
            	'       Copiar e colar <i class="far fa-copy" onclick="getElementById(pixcopy).value"></i><br>'+
            	'       <div id="pixcopy" style="border:1px solid grey; word-wrap: anywhere; padding: 9px;">'+ retorno.pix.copy +'</div>'+
            	// '		Chave: 0d3003ff-2f13-4c30-90b0-7feb1d6218d6'+
            	'    </div>'+
            	'    <div class="divcell" style="vertical-align: top;">'+
            	'		<img src="<?= site_url('assets/images/logo_pix.png') ?>" alt="logo pix" style="width: 160px;">'+
            	'       <img src="data:image/png;base64,'+ retorno.pix.qrcode +'" style="width: 160px;">'+
            	'  </div>'+
            	'</div>'
            );

        },
        error: function(st, text){
        	console.log('pedidos/salvar error');
            console.log(st, text);
        }
    });

}


</script>