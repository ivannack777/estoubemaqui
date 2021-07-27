

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
									<div id="cestadiv" class="divtable divtable-full">

									<input id="price_total" type="text" name="price_total">
									</div>

									<button id="pedidoSave">Enviar pedido</button>


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

        url : '<?= site_url('cesta/get') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            console.log(retorno.length, retorno);
            cestaMount(retorno)


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
            console.log(retorno.price_total);
            $("#cestadiv").html(
            	'<div class="divtable">'+
            	'  <div class="divrow">'+
            	'    <div class="divcell" style="vertical-align: top;">'+
            	'		Fazer transfência por PIX no valor de <span style="font-size: 2.5em;">'+retorno.price_total +'</span><br>'+
            	'		Chave: 0d3003ff-2f13-4c30-90b0-7feb1d6218d6'+
            	'    </div>'+
            	'    <div class="divcell" style="vertical-align: top;">'+
            	'		<img src="<?= site_url('assets/images/pix.png') ?>" style="width: 10em">'+
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