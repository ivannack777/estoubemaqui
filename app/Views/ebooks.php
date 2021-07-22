
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
								<h2 class="sessions"><?= lang("Site.home.ebooks.title", [], $user->lang); ?></h2>

								<?php 
									// var_dump($ebooks);
								if(!count($ebooks)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/ebook_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>
									<?php foreach($ebooks as $ebook): ?>
									<div class="inner items">
										<h2><?= $ebook->title ?></h2>
										<h3><?= $ebook->subtitle ?></h3>
										
										<p><?= substr($ebook->description, 0, 50) . (strlen($ebook->description) >= 50 ? '...': '') ?></p>
										<ul class="actions">
											<li><a href="<?= site_url("home/ebooks/".$ebook->idpub) ?>" class="button"><?= lang("Site.home.buttons.learnmore", [], $user->lang); ?></a></li>
										</ul>

									</div>
									<?php endforeach ?>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

