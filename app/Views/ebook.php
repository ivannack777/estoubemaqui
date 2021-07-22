<li><button id="clearCesta" class="button"><?= lang("Site.home.buttons.clear", [], $user->lang); ?></button></li>

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
								if(!count($ebooks)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/ebook_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else: ?>
									<div class="inner items">
										<h2><?= $ebook->title ?></h2>
										<h3><?= $ebook->subtitle ?></h3>
										<?php if( file_exists(site_url('assets/images/ebooks/' . $ebook->cover)) ): ?>
											<img class="pages" src="<?= site_url('assets/images/ebooks/' . $ebook->cover) ?>" alt="" data-position="center center" />
										<?php endif ?>
										<p><?= $ebook->description ?></p>
										<ul class="actions">
											<li><button class="button addItem" data-item="<?= $ebook->idpub ?>"><?= lang("Site.home.buttons.add", [], $user->lang); ?></button></li>
										</ul>
									</div>
								<?php endif ?>

							</div>
						</section>

					</section>

			</div>
<script type="text/javascript">

</script>