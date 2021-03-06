
		<!-- Wrapper -->
			<div id="wrapper">
				<section class="wrapper style2 spotlights">
					<div id="postagens" class="content">
						<!-- posts session -->
						<h2 class="sessions"><?= lang("Site.home.posts.title", [], $user->lang); ?></h2>
						<button type="edit"><a  href="<?= site_url("super/postagem/index/new") ?>"><?= lang("Site.form.add", [], $user->lang); ?></a></button>
						<?php
							// var_dump($postagens);
						if(!count($postagens)): ?>
							<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/postagens_icon.svg') ?>" alt=""/><?= lang("Site.home.posts.error.notFound", [], $user->lang); ?></p>
						<?php else: ?>

							<h3><?= lang("Site.home.posts.count", [count($postagens)], $user->lang); ?></h3>
							<?php foreach($postagens as $postagem): 
								$publicAt = App\Dates::format($postagem->public_at,  $user->dateTime_format);
								?>
								<div class="inner items separator">
									<h2><?= $postagem->title ?></h2>
									<h3><?= $postagem->subtitle ?></h3>
									<p>
										<?= strip_tags(substr($postagem->text, 0, 500)) . (strlen($postagem->text) >= 500 ? '...': '') ?><br />
									</p>
									<strong><?= lang("Site.home.posts.labels.public_at", [], $user->lang); ?> <?= $publicAt ?></strong>
									<ul class="actions">
										<li><a href="<?= site_url("super/postagem/index/".$postagem->key) ?>"><button class="primary" type="edit"><?= lang("Site.form.edit", [], $user->lang); ?></button></a></li>

										<li><a href="<?= site_url("super/postagem/save/".$postagem->key. "/delete") ?>"><button type="reset"><?= lang("Site.form.delete", [], $user->lang); ?></button></a></li>
									</ul>

								</div>
							<?php endforeach ?>
						<?php endif ?>
					</div>
				</section>
			</div>

