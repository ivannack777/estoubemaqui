
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<section id="produtos" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.home.produtos.title", [], $user->lang); ?></h2>
								<button type="edit"><a  href="<?= site_url("adm/produtos/new") ?>"><?= lang("Site.form.add", [], $user->lang); ?></a></button>
								<?php
									// var_dump($produtos);
								if(!count($produtos)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/produto_icon.svg') ?>" alt=""/><?= lang("Site.home.produtos.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>

									<h3><?= lang("Site.home.produtos.count", [count($produtos)], $user->lang); ?></h3>
									<?php foreach($produtos as $produto): ?>
										<div class="inner items separator">
											<h2><?= $produto->title ?></h2>
											<h3><?= $produto->subtitle ?></h3>
											<p><?= lang("Site.home.products.labels.idpub", [], $user->lang); ?>: <?= $produto->idpub ?><br />
												<?= lang("Site.home.products.labels.description", [], $user->lang); ?>:</label> <?= substr($produto->description, 0, 50) . (strlen($produto->description) >= 50 ? '...': '') ?>

											</p>
											<ul class="actions">
												<li><a href="<?= site_url("adm/produtos/index/".$produto->key) ?>"><button type="edit"><?= lang("Site.form.edit", [], $user->lang); ?></button></a></li>

												<li><a href="<?= site_url("adm/produtos/save/".$produto->key. "/delete") ?>"><button type="reset"><?= lang("Site.form.delete", [], $user->lang); ?></button></a></li>
											</ul>

										</div>
									<?php endforeach ?>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

