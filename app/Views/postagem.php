
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>

							<img class="pages" src="<?= site_url('assets/images/ebook_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
						<section id="postagens" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.home.posts.title", [], $user->lang); ?></h2>

								<?php 
								// var_dump($postagem);exit;
								if(!isset($postagem)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/postagens_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>
									<div class="inner items">
										<h2><?= $postagem->title ?></h2>
										<h3><?= $postagem->subtitle ?></h3>
										<p><?= $postagem->text ?></p>
									</div>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

