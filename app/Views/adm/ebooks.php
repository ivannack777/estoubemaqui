
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<section id="ebooks" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.home.ebooks.title", [], $user->lang); ?></h2>
								<button type="edit"><a  href="<?= site_url("adm/home/ebooks/new") ?>"><?= lang("Site.form.add", [], $user->lang); ?></a></button>
								<?php 
									// var_dump($ebooks);
								if(!count($ebooks)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/ebook_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>

									<h3><?= lang("Site.home.ebooks.count", [count($ebooks)], $user->lang); ?></h3>
									<?php foreach($ebooks as $ebook): ?>
										<div class="inner items separator">
											<h2><?= $ebook->title ?></h2>
											<h3><?= $ebook->subtitle ?></h3>
											
											<p><?= substr($ebook->description, 0, 50) . (strlen($ebook->description) >= 50 ? '...': '') ?></p>
											<ul class="actions">
												<li><a href="<?= site_url("adm/home/ebooks/".$ebook->idpub) ?>"><button type="edit"><?= lang("Site.form.edit", [], $user->lang); ?></button></a></li>
												
												<li><a href="<?= site_url("adm/home/ebooks_save/".$ebook->idpub. "/delete") ?>"><button type="reset"><?= lang("Site.form.delete", [], $user->lang); ?></button></a></li>
											</ul>

										</div>
									<?php endforeach ?>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

