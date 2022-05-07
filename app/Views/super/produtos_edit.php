
		<!-- Wrapper -->
			<div id="wrapper">
				<section id="produtos.labels" >
					<div class="content">
						<!-- posts session -->
						<h2 class="sessions"><a href="<?= site_url('super/produtos') ?>">  <?= lang("Site.home.products.title", [], $user->lang); ?></a></h2>
						<h5><?= lang("Site.home.products.labels.key", [], $user->lang); ?> <a href="<?= site_url('super/produtos/index/'. ($produto->key??'new')) ?>"><?= $produto->key ?? '' ?></a></h5>
						<a  id="idpub" href="<?= site_url('home/produtos/'. ($produto->idpub ?? '') )?>"target="site" title="idpub"><?= $produto->idpub ?? '' ?></a>
							<div class="form-items">
								<form action="<?= site_url('super/produtos/save/'. ($produto->key ?? 'new')) ?>" method="post" enctype="multipart/form-data"  accept-charset="utf-8">
									<?php if( $retorno ): ?>
										<div class="alert alert-<?= $retorno['status'] ? 'success':'error' ?> center">
											<p><img class="icon" src="<?= site_url('assets/images/produtos.webp') ?>"><?= $retorno['msg'] ?> </p>
										</div>
									<?PHP endif ?>
									<?php if( $produto->deleted_at ?? false): ?>
										<div class="alert alert-info text-danger">
											<h2><?= lang("Site.home.products.error.deleted", [], $user->lang); ?> </h2>
											<a href="<?= site_url('super/produtos_save/'. $produto->idpub .'/recover') ?>"><?= lang("Site.home.products.error.deletedRecover", [], $user->lang); ?></a>
										</div>
									<?PHP endif ?>
									<label for="idpub"><?= lang("Site.home.products.labels.category", [], $user->lang); ?></label>
									<!-- <?php var_dump($categorias); ;?> -->
									<select id="categoriao" name="categorias_id">
										<option value="">Selecione...</option>
										<?php foreach($categorias as $categoria):
											$categoriaSelected = $categoria->id == ($produto->categorias_id??null) ? 'selected' : '';
											?>
											<option value="<?= $categoria->id ?>" <?= $categoriaSelected ?>><?= $categoria->nome ?></option>
										<?php endforeach ?>
									</select>


									<label for="idpub"><?= lang("Site.home.products.labels.idpub", [], $user->lang); ?></label>
									<input type="text" id="idpub" name="idpub" value="<?= $produto->idpub ?? '' ?>" />
									<input type="checkbox" id="idpubauto" name="idpubauto" value="S">
									<label for="idpubauto">Auto</label>

									<label for="title"><?= lang("Site.home.products.labels.title", [], $user->lang); ?></label>
									<input type="text" id="title" name="title" value="<?= $produto->title ?? '' ?>" />

									<label for="subtitle"><?= lang("Site.home.products.labels.subtitle", [], $user->lang); ?></label>
									<input type="text" id="subtitle" name="subtitle" value="<?= $produto->subtitle ?? '' ?>" />

									<label for="cover"><?= lang("Site.home.products.labels.cover", [], $user->lang); ?></label>
									<?php if(isset($produto->cover) && !empty($produto->cover) ):
										$img = "assets/images/produtos/{$produto->cover}";

										if(file_exists($img) ): ?>
											<img class="imgthumb" src="/<?= $img ?>">
										<?php endif ?>
									<?php endif; ?>
									<br>
									<input type="file" id="cover" name="cover" value="<?= $produto->cover ?? '' ?>" />

									<label for="price"><?= lang("Site.home.products.labels.price", [], $user->lang); ?></label>
									<input type="text" id="price" name="price" value="<?= $produto->price ?? '' ?>" />

									<label for="price_promo"><?= lang("Site.home.products.labels.price_promo", [], $user->lang); ?></label>
									<input type="text" id="price_promo" name="price_promo" value="<?= $produto->price_promo ?? '' ?>" />

									<label for="tags"><?= lang("Site.home.products.labels.tags", [], $user->lang); ?></label>
									<input type="text" id="tags" name="tags" value="<?= $produto->tags ?? '' ?>" />

									<label for="pages"><?= lang("Site.home.products.labels.pages", [], $user->lang); ?></label>
									<input type="text" id="pages" name="pages" value="<?= $produto->pages ?? '' ?>" />

									<label for="author"><?= lang("Site.home.products.labels.author", [], $user->lang); ?></label>
									<input type="text" id="author" name="author" value="<?= $produto->author ?? '' ?>" />

									<label for="description"><?= lang("Site.home.products.labels.description", [], $user->lang); ?></label>
									<textarea id="description" name="description" style="height: 350px; width:100%"><?= $produto->description ?? '' ?></textarea>
									<button type="submit" class="primary"><?= lang("Site.form.save", [], $user->lang); ?></button>
									<button type="reset"><?= lang("Site.form.reset", [], $user->lang); ?></button>
								</form>
							</div>

							</div>

					</div>
				</section>

			</div>

