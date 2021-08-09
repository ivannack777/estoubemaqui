<?php
$public_at = null;
if(isset($postagens->public_at) && $postagens->public_at){
	$public_at = new \DateTime($postagens->public_at, new \DateTimeZone('UTC'));
	$public_at->setTimezone( new \DateTimeZone($user->timezone));
}

$postagens = $postagens[0] ?? null;

?>
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<section id="postagens" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><a href="<?= site_url('adm/home/postagens') ?>">  <?= lang("Site.home.posts.title", [], $user->lang); ?></a></h2>

								<div class="inner items">
									<form action="<?= site_url('adm/postagens/save/'. ($postagens->idpub ?? 'new')) ?>" method="post">
										<?php
										$retorno = $session->get('retorno');

										if( $retorno ): ?>
											<div class="alert alert-info center">
												<p><img class="icon" src="<?= site_url('assets/images/postagens_icon.svg') ?>"><?= $retorno['msg'] ?> </p>
											</div>
										<?php endif ?>
										<?php if(isset($postagens) && $postagens->deleted_at ): ?>
											<div class="alert alert-info text-danger">
												<h2><?= lang("Site.home.posts.error.deleted", [], $user->lang); ?> </h2>
												<a href="<?= site_url('adm/postagens/save/'. $postagens->idpub .'/recover') ?>"><?= lang("Site.home.posts.error.deletedRecover", [], $user->lang); ?></a>
											</div>
										<?php endif ?>
										<label for="title"><?= lang("Site.home.posts.labels.title", [], $user->lang); ?></label>
										<input type="text" id="title" name="title" value="<?= $postagens->title ?? '' ?>" autofocus/>

										<label for="subtitle"><?= lang("Site.home.posts.labels.subtitle", [], $user->lang); ?></label>
										<input type="text" id="subtitle" name="subtitle" value="<?= $postagens->subtitle ?? '' ?>" />

										<label for="text"><?= lang("Site.home.posts.labels.text", [], $user->lang); ?></label>
										<textarea id="text" name="text" style="height: 250px;"><?= $postagens->text ?? '' ?></textarea>

										<label for="author"><?= lang("Site.home.posts.labels.author", [], $user->lang); ?></label>
										<input type="text" id="author" name="author" value="<?= $postagens->author ?? '' ?>" />


										<br />
										<input type="checkbox" id="publicado" name="public" value="S" <?= isset($postagens) && $postagens->public_at ? 'checked' : '' ?>>
										<label for="publicado"><?= lang("Site.home.posts.labels.public", [], $user->lang); ?></label>

										<br />
										<?= lang("Site.home.posts.labels.public_at", [], $user->lang); ?> <?= $public_at ? $public_at->format('d/m/Y H:i:s') : '' ?>

										<br />
										<button type="submit"><?= lang("Site.form.save", [], $user->lang); ?></button>
										<button type="reset"><?= lang("Site.form.reset", [], $user->lang); ?></button>
									</form>
								</div>

							</div>
						</section>

					</section>

			</div>

