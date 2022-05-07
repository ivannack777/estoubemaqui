		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/produto_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/produto_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
						<section id="produtos" >
							<div class="content">
								<!-- posts session -->

								<?php 
								if(!count($produtos)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/produto_icon.svg') ?>" alt=""/><?= lang("Site.home.produtos.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>
									<?php foreach($produtos as $produto): ?>
									<div class="inner items">
										<h2><?= $produto->title ?></h2>
										<h3><?= $produto->subtitle ?></h3>

										<?php if(count($produtos)===1): ?>
											<p><?= substr($produto->description, 0, 500) . (strlen($produto->description) >= 500 ? '...': '') ?></p>
										<?php else: ?>
											<p><?= substr($produto->description, 0, 50) . (strlen($produto->description) >= 50 ? '...': '') ?></p>
										<?php endif ?>
										<p class="price">
											<span class="<?= $produto->price_promo ? 'price-promo' : 'price' ?>"><?= $user->price_simbol ?> <?= $produto->price ?></span>
											<?php if($produto->price_promo): ?>
												<span class="price"><?= $user->price_simbol ?> <?= $produto->price_promo ?></span>
											<?php endif ?>
											<?php if(empty($produto->price) && empty($produto->price_promo)): ?>
												<span class="price">0.00</span>
											<?php endif ?>
										</p>

										<ul class="actions">
											<li><button class="button addItem" data-item="<?= $produto->key ?>"><?= lang("Site.home.buttons.add", [], $user->lang); ?></button></li>
										</ul>

									</div>
									<?php endforeach ?>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

