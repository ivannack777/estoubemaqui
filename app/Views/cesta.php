

		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/produto_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
					</section>
						<div class="style2" id="produtos" >
							<div id="cestadiv" class="divtable divtable-full">

							</div>
						<section>
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.basket.title", [], $user->lang); ?></h2>


									<p id="centaAlert" class="alert alert-info" style="display:<?= count($itens) ? 'none' : 'block' ?>">
										<span class="fa-stack fa-2x">
											<i class="far fa-file fa-2x"></i>
											<i class="fas fa-times fa-stack-1x text-danger"></i>
										</span>
										<?= lang("Site.basket.empty", [], $user->lang); ?>
									</p>
								<?php if(count($itens)):
									$priceTotal = 0;
									?>
									<button type="button" id="clearCesta" title="<?= lang("Site.basket.buttons.clear", [], $user->lang); ?>"><i class="far fa-trash-alt"></i> <?= lang("Site.basket.buttons.clear", [], $user->lang); ?></button>
									<div id="cestadiv2" class="divtable divtable-full">
										<?php foreach($itens as $item):
											if(isset($item['produto']) && !empty($item['produto'])):
												// var_dump($item['produto']);
											?>
												<div class="divrow align-items-center inner items" id="row-<?= $item['produto']->idpub ?>">
													<div class="divcell">
														<?php if( file_exists(('assets/images/produtos/' . $item['produto']->cover)) ): ?>
															<img class="mini" src="<?= site_url('assets/images/produtos/' . $item['produto']->cover) ?>" alt="" data-position="center center" />
														<?php endif ?>
						            	                <button type="button" class="removeItem" data-item="<?= $item['produto']->idpub ?>" title="<?= lang("Site.basket.buttons.remove", [], $user->lang); ?>"><i class="far fa-trash-alt"></i></button>
														<strong><?= $item['produto']->title ?></strong>
														<?= $item['produto']->subtitle ?>
													</div>
													<div class="divcell align-right"><?= $user->price_simbol ?> <?= $item['produto']->price_promo ? $item['produto']->price_promo : $item['produto']->price ?></div>
													<div class="divcell">
														<div class="btn-group quantItemCestadiv" data-item="<?= $item['produto']->idpub ?>">
							                                <button type="button" class="decreaseItemCesta" data-item="<?= $item['produto']->idpub ?>" title="<?= lang("Site.basket.buttons.decrease", [], $user->lang); ?>" <?= $item['count'] < 2 ? 'disabled' :'' ?>>-</button>
							                                <input type="text" class="quantItemCesta text-center" class="text-center"  value="<?= $item['count'] ?>"  placeholder="<?= lang("Site.basket.buttons.quant", [], $user->lang); ?>" title="<?= lang("Site.basket.buttons.quant", [], $user->lang); ?>" style="width:90px;">
							                                <i class="fa fa-spinner fa-spin" style="display:none;"></i>
						        	                        <button type="button" class="increaseItemCesta" data-item="<?= $item['produto']->idpub ?>" title="<?= lang("Site.basket.buttons.increase", [], $user->lang); ?>">+</button>
						            	                </div>
						            	            </div>
													<div class="divcell align-right">
														<?= $user->price_simbol ?>
														<?php if($item['produto']->price_promo):
															$priceTotal += $item['produto']->price_promo * $item['count'];
														?>
															<?= $item['produto']->price_promo * $item['count'] ?>

														<?php else:
															$priceTotal += $item['produto']->price * $item['count'];
														?>
															<?= $item['produto']->price * $item['count'] ?>
														<?php endif ?>
													</div>

												</div>
											<?php endif; ?>
										<?php endforeach; ?>
												<div class="divrow">
													<div class="divcell"></div>
													<div class="divcell"></div>
													<div class="divcell">priceTotal</div>
													<div class="divcell align-right"><strong><?= $user->price_simbol ?> <?= $priceTotal ?></strong></div>
												</div>
									</div>
								<?php endif ?>

							</div>

					</section>

			</div>
<script type="text/javascript">

get();

function get(){
    $.ajax({

        url : '<?= site_url('cesta/get') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
        	console.log(retorno.length, retorno);
        	var priceTotal;
        	for(var i=0; i<=retorno.length; i++){
        		console.log(i);
        		console.log(retorno[i]);
	        	$("#cestadiv").append('<div class="divrow align-items-center inner items" id="row-'+ retorno[i].produto.idpub +'">');
				$("#cestadiv").append('    <div class="divcell">');
				$("#cestadiv").append('            <img class="mini" src="<?= site_url('assets/images/produtos/') ?> . retorno[i].produto.cover) ?>" alt="" data-position="center center" />');
				$("#cestadiv").append('        <button type="button" class="removeItem" data-item="'+ retorno[i].produto.idpub +'" title="<?= lang("Site.basket.buttons.remove", [], $user->lang) ?>"><i class="far fa-trash-alt"></i></button>');
				$("#cestadiv").append('        <strong>'+ retorno[i].produto.title +'</strong>');
				$("#cestadiv").append(        retorno[i].produto.subtitle );
				$("#cestadiv").append('    </div>');
				$("#cestadiv").append('    <div class="divcell align-right"><?= $user->price_simbol ?>'+ retorno[i].produto.price_promo ? retorno[i].produto.price_promo : retorno[i].produto.price +'</div>');
				$("#cestadiv").append('    <div class="divcell">');
				$("#cestadiv").append('        <div class="btn-group quantItemCestadiv" data-item="'+ retorno[i].produto.idpub +'">');
				$("#cestadiv").append('            <button type="button" class="decreaseItemCesta" data-item="'+ retorno[i].produto.idpub +'" title="<?= lang("Site.basket.buttons.decrease", [], $user->lang) ?>" '+ (retorno[i].count < 2 ? "disabled" :"") +'>-</button>');
				$("#cestadiv").append('            <input type="text" class="quantItemCesta text-center" class="text-center"  value="'+ retorno[i].count +'"  placeholder="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" title="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" style="width:90px;")>');
				$("#cestadiv").append('            <i class="fa fa-spinner fa-spin" style="display:none;"></i>');
				$("#cestadiv").append('            <button type="button" class="increaseItemCesta" data-item="'+ retorno[i].produto.idpub +'" title="<?= lang("Site.basket.buttons.increase", [], $user->lang) ?>">+</button>');
				$("#cestadiv").append('        </div>');
				$("#cestadiv").append('    </div>');
				$("#cestadiv").append('    <div class="divcell align-right">');
				$("#cestadiv").append('        <?= $user->price_simbol ?>');
				                                if(retorno[i].produto.price_promo){
				                                priceTotal += parseFloat(retorno[i].produto.price_promo) * parseFloat(retorno[i].count);
				$("#cestadiv").append(            parseFloat(retorno[i].produto.price_promo) * parseFloat(retorno[i].count) );
				                                } else {
											        priceTotal += parseFloat(retorno[i].produto.price) * parseFloat(retorno[i].count);
				$("#cestadiv").append(      	    parseFloat(retorno[i].produto.price) * parseFloat(retorno[i].count) );
				                                }
				$("#cestadiv").append('    </div>');
				$("#cestadiv").append('</div>');
				$("#cestadiv").append('<div class="divrow">');
				$("#cestadiv").append('    <div class="divcell"></div>');
				$("#cestadiv").append('    <div class="divcell"></div>');
				$("#cestadiv").append('    <div class="divcell">priceTotal</div>');
				$("#cestadiv").append('    <div id="priceTotal" class="divcell align-right"><strong><?= $user->price_simbol ?>'+ priceTotal +'</strong></div>');
				$("#cestadiv").append('</div>');
			}

        },
        error: function(st, text){
            console.log(st, text);
        }
    });
}


</script>