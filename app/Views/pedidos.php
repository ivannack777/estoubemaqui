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
								<h2 class="sessions"><?= lang("Site.order.title", [], $user->lang); ?></h2>
								<h4 class="sessions"><?= lang("Site.order.subtitle", [], $user->lang); ?></h4>
								<div class="style2" id="pedidos" >
									<?php /*var_dump($pedidos, $user);*/ ?>

									<?php if(empty($pedidos)): ?>
										<p id="cestaAlert" class="alert alert-info">
											<span class="fa-stack fa-2x">
												<i class="far fa-file fa-2x"></i>
												<i class="fas fa-times fa-stack-1x text-danger"></i>
											</span>
											<?= lang("Site.order.empty", [], $user->lang); ?>
										</p>
									<?php else: ?>

										<div id="pedidosdiv" class="divtable divtable-full table-background">

											<div class="divrow divrow-header">
												<div class="divcell"><?= lang("Site.order.fields.idpub", [], $user->lang); ?></div>
												<div class="divcell"><?= lang("Site.order.fields.price_total", [], $user->lang); ?></div>
												<div class="divcell"><?= lang("Site.order.fields.status", [], $user->lang); ?></div>
												<div class="divcell"><?= lang("Site.order.fields.created_at", [], $user->lang); ?></div>
												<div class="divcell"><?= lang("Site.order.fields.updated_at", [], $user->lang); ?></div>
												<div class="divcell"><?= lang("Site.order.fields.produtos", [], $user->lang); ?></div>
											</div>

											<?php foreach($pedidos as $pedido): 
												$created = new DateTime($pedido->created_at);
												$updated = new DateTime($pedido->updated_at);
												$produtos = json_decode($pedido->produtos, true);
												?>
											<div class="divrow ">
												<div class="divcell"><?= $pedido->idpub ?></div>
												<div class="divcell"><?= $pedido->price_total ?></div>
												<div class="divcell"><?= lang("Site.status.{$pedido->status}", [], $user->lang); ?></div>
												<div class="divcell"><?= $created->format( $user->date_format ) ?></div>
												<div class="divcell"><?= $updated->format( $user->date_format ) ?></div>
												<div class="divcell">
													<div class="dropdown-list mouse-hover"><?= count($produtos) ?> <i class="fas fa-caret-right"></i>
														<div class="dropdown-list-itens">
														<?php foreach($produtos as $id => $prod): ?>
															<div class=""><?= ($prod['produto']['title']); ?> <?= ($prod['produto']['subtitle']); ?></div>
														<?php endforeach ?>
														</div>
													</div>
												</div>
											</div>
											<?php endforeach ?>
										</div>
									<?php endif ?>
							</div>

					</section>

			</div>
<script type="text/javascript">


$.ajax({
    url : '<?= site_url('cesta/get/json') ?>',
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