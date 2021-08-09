
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Intro -->
					<section id="intro" class="wrapper style1 fullscreen fade-up">
						<div class="inner">

							<h1><?= lang("Site.home.title", [], $user->lang); ?></h1>
							<h2><?= lang("Site.home.subtitle", [], $user->lang); ?></h2>
							<p><?= lang("Site.home.maintext", [], $user->lang); ?></p>
							<ul class="actions">

								<li><a href="#one" class="button scrolly"><?= lang("Site.home.buttons.learnmore", [], $user->lang); ?></a></li>
							</ul>
						</div>
					</section>

				<!-- One -->
					<section class="wrapper style2 spotlights">
						<section id="ebooks" >
							<a href="#" class="image"><img src="<?= site_url('assets/images/ebook_04.jpeg') ?>" alt="" data-position="center center" /></a>
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.home.ebooks.title", [], $user->lang); ?></h2>
									<?php foreach($ebooks as $ebook): ?>
										<div class="inner items separator">
											<h2><?= $ebook->title ?></h2>
											<h3><?= $ebook->subtitle ?></h3>
											<p><?= substr($ebook->description, 0, 50) . (strlen($ebook->description) >= 50 ? '...': '') ?></p>
											<p>
												<span class="<?= $ebook->price_promo ? 'price-promo' : 'price' ?>"><?= $user->price_simbol ?> <?= $ebook->price ?></span>
												<?php if($ebook->price_promo): ?>
													<span class="price"><?= $user->price_simbol ?> <?= $ebook->price_promo ?></span>
												<?php endif ?>
												<?php if(empty($ebook->price) && empty($ebook->price_promo)): ?>
													<span class="price">0.00</span>
												<?php endif ?>
											</p>

											<ul class="actions">
												<li><a href="<?= site_url("home/ebooks/". $ebook->key ) ?>" class="button"><?= lang("Site.home.buttons.learnmore", [], $user->lang); ?></a></li>
												<li><button class="button addItem" data-item="<?= $ebook->key ?>"><?= lang("Site.home.buttons.add", [], $user->lang); ?></button></li>
											</ul>
										</div>
									<?php endforeach ?>
							</div>
						</section>

						<section id="posts" >
							<a href="#" class="image"><img src="<?= site_url('assets/images/lang/'. $user->lang .'/posts.jpg') ?>" alt="" data-position="center center" /></a>
							<div class="content">
								<!-- posts session -->
								<h2 class="sessions"><?= lang("Site.home.posts.title", [], $user->lang); ?></h2>

								<?php foreach($postagens as $postagem): ?>
									<div class="inner items separator">
										<h2><a href="<?= site_url("home/postagens/". $postagem->key ) ?>"><?= $postagem->title ?></a></h2>
										<h3><?= $postagem->subtitle ?></h3>
										<p><?= substr($postagem->text, 0, 250) . (strlen($postagem->text) >= 250 ? '...': '') ?></p>

										<ul class="actions">
											<li><a href="<?= site_url("home/postagens/". $postagem->key ) ?>" class="button"><?= lang("Site.home.buttons.learnmore", [], $user->lang); ?></a></li>
										</ul>
									</div>
								<?php endforeach ?>
							</div>
						</section>


					</section>

				<!-- Two -->
					<section id="whatweare" class="wrapper style3 fade-up">
						<div class="inner">
							<h2 class="sessions"><?= lang("Site.home.whatweare.title", [], $user->lang); ?></h2>
							<p><?= lang("Site.home.whatweare.text", [], $user->lang); ?></p>
							<div class="features">
								<section>
									<span class="icon solid major fa-code"></span>
									<h3><?= lang("Site.home.whatweare.items.1.title", [], $user->lang); ?></h3>
									<p><?= lang("Site.home.whatweare.items.1.text", [], $user->lang); ?></p>
								</section>
								<section>
									<span class="icon solid major fa-code"></span>
									<h3><?= lang("Site.home.whatweare.items.2.title", [], $user->lang); ?></h3>
									<p><?= lang("Site.home.whatweare.items.2.text", [], $user->lang); ?></p>
								</section>
								<section>
									<span class="icon solid major fa-code"></span>
									<h3><?= lang("Site.home.whatweare.items.3.title", [], $user->lang); ?></h3>
									<p><?= lang("Site.home.whatweare.items.3.text", [], $user->lang); ?></p>
								</section>
								<section>
									<span class="icon solid major fa-code"></span>
									<h3><?= lang("Site.home.whatweare.items.4.title", [], $user->lang); ?></h3>
									<p><?= lang("Site.home.whatweare.items.4.text", [], $user->lang); ?></p>
								</section>
							</div>
							<ul class="actions">
								<li><a href="generic.html" class="button">Learn more</a></li>
							</ul>
						</div>
					</section>

				<!-- Three -->
					<section id="contacts" class="wrapper style1 fade-up">
						<div class="inner">
							<h2><?= lang("Site.home.contacts.title", [], $user->lang); ?></h2>
							<p><?= lang("Site.home.contacts.text", [], $user->lang); ?></p>
							<div class="split style1">
								<section>
									<form method="post" action="#">
										<div class="fields">
											<div class="field half">
												<label for="name">Name</label>
												<input type="text" name="name" id="name" />
											</div>
											<div class="field half">
												<label for="email">Email</label>
												<input type="text" name="email" id="email" />
											</div>
											<div class="field">
												<label for="message">Message</label>
												<textarea name="message" id="message" rows="5"></textarea>
											</div>
										</div>
										<ul class="actions">
											<li><a href="" class="button submit">Send Message</a></li>
										</ul>
									</form>
								</section>
								<section>
									<ul class="contact">
										<li>
											<h3>Address</h3>
											<span>12345 Somewhere Road #654<br />
											Nashville, TN 00000-0000<br />
											USA</span>
										</li>
										<li>
											<h3>Email</h3>
											<a href="#">user@untitled.tld</a>
										</li>
										<li>
											<h3>Phone</h3>
											<span>(000) 000-0000</span>
										</li>
										<li>
											<h3>Social</h3>
											<ul class="icons">
												<li><a href="#" class="icon brands fa-twitter"><span class="label">Twitter</span></a></li>
												<li><a href="#" class="icon brands fa-facebook-f"><span class="label">Facebook</span></a></li>
												<li><a href="#" class="icon brands fa-github"><span class="label">GitHub</span></a></li>
												<li><a href="#" class="icon brands fa-instagram"><span class="label">Instagram</span></a></li>
												<li><a href="#" class="icon brands fa-linkedin-in"><span class="label">LinkedIn</span></a></li>
											</ul>
										</li>
									</ul>
								</section>
							</div>
						</div>
					</section>

			</div>

