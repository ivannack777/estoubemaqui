

		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/ebook_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
					</section>
						<div class="style2" id="ebooks" >
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
								<?php if(count($itens)): ?>
									<div id="cestadiv">
										<button type="button" id="clearCesta" title="<?= lang("Site.basket.buttons.clear", [], $user->lang); ?>"><i class="far fa-trash-alt"></i> <?= lang("Site.basket.buttons.clear", [], $user->lang); ?></button>
										<?php foreach($itens as $item):
											if(isset($item['ebook']) && !empty($item['ebook'])):
											?>
												<div class="row align-items-center inner items" id="row-<?= $item['ebook']->idpub ?>">
													<div class="col">
														<?php if( file_exists(('assets/images/ebooks/' . $item['ebook']->cover)) ): ?>
															<img class="mini" src="<?= site_url('assets/images/ebooks/' . $item['ebook']->cover) ?>" alt="" data-position="center center" />
														<?php endif ?>
						            	                <button type="button" class="removeItem" data-item="<?= $item['ebook']->idpub ?>" title="<?= lang("Site.basket.buttons.remove", [], $user->lang); ?>"><i class="far fa-trash-alt"></i></button>
														<?= $item['ebook']->title ?>
													</div>
													<div class="col"><?= $item['ebook']->subtitle ?></div>
													<div class="col">
														<div class="btn-group quantItemCestadiv" data-item="<?= $item['ebook']->idpub ?>">
							                                <button type="button" class="decreaseItemCesta" data-item="<?= $item['ebook']->idpub ?>" title="<?= lang("Site.basket.buttons.decrease", [], $user->lang); ?>" <?= $item['count'] < 2 ? 'disabled' :'' ?>>-</button>
							                                <input type="text" class="quantItemCesta text-center" class="text-center"  value="<?= $item['count'] ?>"  placeholder="<?= lang("Site.basket.buttons.quant", [], $user->lang); ?>" title="<?= lang("Site.basket.buttons.quant", [], $user->lang); ?>" style="width:90px;">
							                                <i class="fa fa-spinner fa-spin" style="display:none;"></i>
						        	                        <button type="button" class="increaseItemCesta" data-item="<?= $item['ebook']->idpub ?>" title="<?= lang("Site.basket.buttons.increase", [], $user->lang); ?>">+</button>
						            	                </div>
						            	            </div>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								<?php endif ?>

							</div>

					</section>

			</div>
<script type="text/javascript">

// $(".addItemCesta").click(function(){
//     var item = $(this).data('item');
//     if(addItem(item)){
//     	var itemVal = $(this).parent('div').find('input').val();
//     	itemVal = parseInt(itemVal) + 1;
//     	$(this).parent('div').find('input').val(itemVal);
//     	if(itemVal !== 0){
//     		 $(this).parent('li').find('button.removeItemCesta').prop('disabled', false);
//     	}
//     }
// });
// $(".removeItemCesta").click(function(){
//     var item = $(this).data('item');
//      if(removeItem(item)){
//     	var itemVal = $(this).parent('div').find('input').val();
//     	itemVal = parseInt(itemVal) -1;
//     	$(this).parent('div').find('input').val(itemVal);
//     	if(itemVal < 1){
//     		$(this).prop('disabled', true);
//     	}
//     }
// });

</script>