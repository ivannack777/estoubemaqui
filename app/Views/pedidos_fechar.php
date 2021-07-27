		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>
							<img class="pages" src="<?= site_url('assets/images/produto_02.jpeg') ?>" alt="" data-position="center center" />
						</div>
					</section>
						<section>
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.basket.title", [], $user->lang); ?></h2>
								<div class="style2" id="pedidos" >
									<div id="pedidosdiv" class="divtable divtable-full">
										<?php var_dump($pedido); ?>

									</div>
							</div>

					</section>

			</div>
<script type="text/javascript">



   $.ajax({

        url : '<?= site_url('cesta/get') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            cesta = retorno;
        },
        error: function(st, text){
            console.log(st, text);
        }
    });



</script>