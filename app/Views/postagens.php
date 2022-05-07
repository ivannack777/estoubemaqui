
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/ebook_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
						<section id="ebooks" >
							<div class="content">
								<!-- posts session -->
								<h1 class="sessions"><?= lang("Site.home.posts.title", [], $user->lang); ?></h1>

								<?php 
									// var_dump($ebooks);
								if(!count($postagens)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/ebook_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>
									<?php foreach($postagens as $postagem): ?>
									<div class="inner items">
										<h2><?= $postagem->title ?></h2>
										<h3><?= $postagem->subtitle ?></h3>
										
										<p><?= substr($postagem->text, 0, 50) . (strlen($postagem->text) >= 50 ? '...': '') ?></p>
										<ul class="actions">
											<li><a href="<?= site_url("home/postagens/".$postagem->idpub) ?>" class="button"><?= lang("Site.home.buttons.learnmore", [], $user->lang); ?></a></li>
										</ul>

									</div>
									<?php endforeach ?>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

