<?php
$postagens = $postagens[0] ?? null;
$public_at = null;
if(isset($postagens->public_at) && $postagens->public_at){
	$public_at = new \DateTime($postagens->public_at, new \DateTimeZone('UTC'));
	$public_at->setTimezone( new \DateTimeZone($user->timezone));
}
?>
		<!-- Wrapper -->
			<div id="wrapper">
				<section id="postagens" >
					<div class="content">
						<!-- posts session -->
						<h2 class="sessions"><a href="<?= site_url('super/postagem') ?>">  <?= lang("Site.home.posts.title", [], $user->lang); ?></a></h2>
						<h5><?= lang("Site.home.posts.labels.key", [], $user->lang); ?> <a href="<?= site_url('super/postagem/index/'. ($postagens->key??'new')) ?>"><?= $postagens->key ?? '' ?></a></h5>
						<a  id="idpub" href="<?= site_url('home/postagens/'. ($postagens->idpub ?? '') )?>"target="site" title="idpub"><?= $postagens->idpub ?? '' ?></a>
						<div class="form-items">
							<form action="<?= site_url('super/postagem/save/'. ($postagens->key ?? 'new')) ?>" method="post">
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
										<a href="<?= site_url('super/postagem/save/'. $postagens->key .'/recover') ?>" title="Recuperar postagem"><?= lang("Site.home.posts.error.deletedRecover", [], $user->lang); ?></a>
									</div>
								<?php endif ?>

								<label for="title"><?= lang("Site.home.posts.labels.title", [], $user->lang); ?></label>
								<input type="text" id="title" name="title" value="<?= $postagens->title ?? '' ?>" autofocus/>

								<label for="subtitle"><?= lang("Site.home.posts.labels.subtitle", [], $user->lang); ?></label>
								<input type="text" id="subtitle" name="subtitle" value="<?= $postagens->subtitle ?? '' ?>" />

								<label for="idpub"><?= lang("Site.home.posts.labels.idpub", [], $user->lang); ?></label>
								<input type="text" id="idpub" name="idpub" value="<?= $postagens->idpub ?? '' ?>" />

								<label for="text"><?= lang("Site.home.posts.labels.text", [], $user->lang); ?></label>
								<textarea id="text" name="text" style="height: 350px; width:100%"><?= $postagens->text ?? '' ?></textarea>

								<label for="author"><?= lang("Site.home.posts.labels.author", [], $user->lang); ?></label>
								<input type="text" id="author" name="author" value="<?= $postagens->author ?? '' ?>" />


								<br />
								<input type="checkbox" id="publicado" name="public" value="S" <?= isset($postagens) && $postagens->public_at ? 'checked' : '' ?>>
								<label for="publicado"><?= lang("Site.home.posts.labels.public", [], $user->lang); ?></label>

								<?= $public_at ? $public_at->format('d/m/Y H:i:s') : '' ?>

								<br />
								<br />
								<button type="submit" class="primary"><?= lang("Site.form.save", [], $user->lang); ?></button>
								<button type="reset"><?= lang("Site.form.reset", [], $user->lang); ?></button>
							</form>
						</div>

					</div>
				</section>

			</div>

<script>
Simditor.i18n = 'en-US';
var editor = new Simditor({
  textarea: $('#text'),
  placeholder: '',
  toolbar: 
  [
  // 'title',
  'bold',
  'italic',
  'underline',
  'strikethrough',
  'fontScale',
  // 'color',
  'ol',             // ordered list
  'ul',             // unordered list
  'blockquote',
  'code',           // code block
  'table',
  'link',
  'image',
  'hr',             //horizontal ruler
  'indent',
  'outdent',
  'alignment',
  // 'html'
]
});

</script>