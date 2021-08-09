
		<!-- Wrapper -->
			<div id="wrapper">
					<section class="wrapper style2 spotlights">
						<section id="produtos.labels" >
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><a href="<?= site_url('adm/produtos') ?>">  <?= lang("Site.home.products.title", [], $user->lang); ?></a></h2>
								<h5><?= lang("Site.home.products.labels.key", [], $user->lang); ?> <a href="<?= site_url('adm/produtos/'. ($produto->key??'new')) ?>"><?= $produto->key ?? '' ?></a></h5>

									<div class="inner items">
										<form action="<?= site_url('adm/produtos/save/'. ($produto->key ?? 'new')) ?>" method="post">
											<?php if( $retorno ): ?>
												<div class="alert alert-info center">
													<p><img class="icon" src="<?= site_url('assets/images/produto_icon.svg') ?>"><?= $retorno['msg'] ?> </p>
												</div>
											<?PHP endif ?>
											<?php if( $produto->deleted_at ?? false): ?>
												<div class="alert alert-info text-danger">
													<h2><?= lang("Site.home.products.error.deleted", [], $user->lang); ?> </h2>
													<a href="<?= site_url('adm/produtos_save/'. $produto->idpub .'/recover') ?>"><?= lang("Site.home.products.error.deletedRecover", [], $user->lang); ?></a>
												</div>
											<?PHP endif ?>
											<label for="idpub"><?= lang("Site.home.products.labels.category", [], $user->lang); ?></label>
											<select id="categoriao" name="categorias_id">
												<option value="">Selecione...</option> 
												<?php foreach($categorias as $categoria): 
													$categoriaSelected = $categoria->id == $produto->categorias_id ? 'selected' : '';
													?>
													<option value="<?= $categoria->id ?>" <?= $categoriaSelected ?>><?= $categoria->nome ?></option> 
												<?php endforeach ?>
											</select>

											<input type="checkbox" id="idpubauto" name="idpubauto" value="S">
											<label for="idpubauto">Auto</label>

											<input type="checkbox" id="idpubauto" name="idpubauto" value="S" />
											<input type="text" id="idpub" name="idpub" value="<?= $produto->idpub ?? '' ?>" />

											<label for="title"><?= lang("Site.home.products.labels.title", [], $user->lang); ?></label>
											<input type="text" id="title" name="title" value="<?= $produto->title ?? '' ?>" />

											<label for="subtitle"><?= lang("Site.home.products.labels.subtitle", [], $user->lang); ?></label>
											<input type="text" id="subtitle" name="subtitle" value="<?= $produto->subtitle ?? '' ?>" />

											<label for="pages"><?= lang("Site.home.products.labels.pages", [], $user->lang); ?></label>
											<input type="text" id="pages" name="pages" value="<?= $produto->pages ?? '' ?>" />

											<label for="author"><?= lang("Site.home.products.labels.author", [], $user->lang); ?></label>
											<input type="text" id="author" name="author" value="<?= $produto->author ?? '' ?>" />

											<label for="description"><?= lang("Site.home.products.labels.description", [], $user->lang); ?></label>
											<textarea id="description" name="description" style="height: 250px;"><?= $produto->description ?? '' ?></textarea>
											<button type="submit"><?= lang("Site.form.save", [], $user->lang); ?></button>
											<button type="reset"><?= lang("Site.form.reset", [], $user->lang); ?></button>
										</form>
									</div>

									</div>

							</div>
						</section>

					</section>

			</div>

