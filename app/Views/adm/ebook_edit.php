
		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<section id="ebooks.labels" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><a href="<?= site_url('adm/home/ebooks') ?>">  <?= lang("Site.home.ebooks.title", [], $user->lang); ?></a></h2>
								<h5><?= lang("Site.home.ebooks.labels.key", [], $user->lang); ?> <a href="<?= site_url('adm/home/ebooks/'. $ebook->key) ?>"><?= $ebook->key ?? '' ?></a></h5>

									<div class="inner items">
										<form action="<?= site_url('adm/home/ebooks_save/'. ($ebook->idpub ?? 'new')) ?>" method="post">
											<?php if( $retorno ): ?>
												<div class="alert alert-info center">
													<p><img class="icon" src="<?= site_url('assets/images/ebook_icon.svg') ?>"><?= $retorno['msg'] ?> </p>
												</div>
											<?PHP endif ?>
											<?php if($ebook->deleted_at ): ?>
												<div class="alert alert-info text-danger">
													<h2><?= lang("Site.home.ebooks.error.deleted", [], $user->lang); ?> </h2>
													<a href="<?= site_url('adm/home/ebooks_save/'. $ebook->idpub .'/recover') ?>"><?= lang("Site.home.ebooks.error.deletedRecover", [], $user->lang); ?></a>
												</div>
											<?PHP endif ?>
											<label for="idpub"><?= lang("Site.home.ebooks.labels.idpub", [], $user->lang); ?></label>
											
											<input type="checkbox" id="idpubauto" name="idpubauto" value="S" <?= isset($postagens) && $postagens->public_at ? 'checked' : '' ?>>
											<label for="idpubauto">Auto</label>
											
											<input type="checkbox" id="idpubauto" name="idpubauto" value="S" />
											<input type="text" id="idpub" name="idpub" value="<?= $ebook->idpub ?? '' ?>" />

											<label for="title"><?= lang("Site.home.ebooks.labels.title", [], $user->lang); ?></label>
											<input type="text" id="title" name="title" value="<?= $ebook->title ?? '' ?>" />

											<label for="subtitle"><?= lang("Site.home.ebooks.labels.subtitle", [], $user->lang); ?></label>
											<input type="text" id="subtitle" name="subtitle" value="<?= $ebook->subtitle ?? '' ?>" />

											<label for="pages"><?= lang("Site.home.ebooks.labels.pages", [], $user->lang); ?></label>
											<input type="text" id="pages" name="pages" value="<?= $ebook->pages ?? '' ?>" />

											<label for="author"><?= lang("Site.home.ebooks.labels.author", [], $user->lang); ?></label>
											<input type="text" id="author" name="author" value="<?= $ebook->author ?? '' ?>" />

											<label for="description"><?= lang("Site.home.ebooks.labels.description", [], $user->lang); ?></label>
											<textarea id="description" name="description" style="height: 250px;"><?= $ebook->description ?? '' ?></textarea>
											<button type="submit"><?= lang("Site.form.save", [], $user->lang); ?></button>
											<button type="reset"><?= lang("Site.form.reset", [], $user->lang); ?></button>
										</form>
									</div>

									</div>

							</div>
						</section>

					</section>

			</div>

