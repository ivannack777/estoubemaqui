
		<!-- Wrapper -->
			<div id="wrapper">

					<section class="wrapper style2 ">
						<div>

							<img class="pages" src="<?= site_url('assets/images/ebook_02.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_03.jpeg') ?>" alt="" data-position="center center" />
							<img class="pages" src="<?= site_url('assets/images/ebook_04.jpeg') ?>" alt="" data-position="center center" />
						</div>
						<section id="postagens" >

							<div class="content">
								<!-- posts session -->
								<h1 class="pages-title"><a href="<?= site_url('#posts') ?>"><?= lang("Site.home.posts.title", [], $user->lang); ?></a></h1>

								<?php
								if(!isset($postagem)): ?>
									<p class="alert alert-info"><img class="icon" src="<?= site_url('assets/images/postagens_icon.svg') ?>" alt=""/><?= lang("Site.home.ebooks.error.notFound", [], $user->lang); ?></p>
								<?php else:
									$publicAt = App\Dates::format($postagem->public_at,  $user->dateTime_format, $user->timezone);
									?>
									<div class="inner items">
										<h2><a href="<?= site_url('/home/postagens/'. $postagem->idpub) ?>"><?= $postagem->title ?></a></h2>
										<h3><?= $postagem->subtitle ?></h3>
										<span class="secundary">Publicado em <?= $publicAt ?></span>
										<div class="post-text">
											<?= $postagem->text ?>
											<div class="post-rating">
			                                <?= lang("Site.home.rating.title", [], $user->lang) ?><br />
											<div style="display: flex; flex-direction:row; justify-content:start;">
												<svg
												   viewBox="0 0 330 330"
												   xmlns="http://www.w3.org/2000/svg"
												   xmlns:svg="http://www.w3.org/2000/svg"
												   style="width: 39px;transform: rotate(180deg); margin: 3px;"
												   >
												  <path
												     class="like mouse-hover" id="like1" data-value="-2"
												     style="<?= !empty($avaliacoesUsuario) && $avaliacoesUsuario->nota == '-2' ? 'fill: #CCC;' : '' ?>"
												     d="m 101.66403,158.65901 c 23.84566,13.67826 46.70648,-54.83557 61.69492,-86.825567 7.96534,-17.000481 4.6279,-45.535464 14.26121,-54.272813 9.63331,-8.7373429 17.75737,-6.894313 23.10298,-1.207528 17.60865,18.7325 12.53566,56.812585 4.37909,84.367708 -4.34309,14.67212 -13.46763,26.02573 -11.86191,30.62584 4.70067,13.46663 94.75971,-9.13586 113.21363,5.92452 18.45392,15.06036 8.74077,16.93356 6.04564,25.24238 -2.69513,8.30882 -10.8302,6.04404 -16.35976,16.07474 -3.07349,5.5754 6.78322,17.03545 6.56671,25.54017 -0.17292,6.79621 -13.96422,11.32672 -16.26393,17.37638 -2.50532,6.59064 7.50977,23.25466 2.4401,29.02828 -5.4073,6.15812 -14.95245,8.42542 -16.27718,15.32213 -2.56675,13.36277 13.04204,5.9997 -3.53916,28.79134 -16.58119,22.79166 -127.44384,7.97481 -127.44384,7.97481 l -38.84058,-20.761 c -8.884698,-7.87653 -6.695722,30.41878 -6.695722,30.41878 0,0 -84.564595,16.99287 -84.540336,-10.64681 0.0358,-40.78734 0.624939,-112.17741 0,-171.59257 -0.290704,-27.63828 84.998609,-11.08142 84.998609,-11.08142 0,0 0.36813,36.97516 5.119529,39.70063 z"
												     id="path1259"
												     sodipodi:nodetypes="sazsssszssssszcccsscs" />
												</svg>

												<svg
												   viewBox="0 0 330 330"
												   xmlns="http://www.w3.org/2000/svg"
												   xmlns:svg="http://www.w3.org/2000/svg"
												   style="width: 30px;transform: rotate(180deg); margin: 3px;"
												   >
												  <path
												    class="like mouse-hover" id="like2" data-value="-1"
												    style="<?= !empty($avaliacoesUsuario) && $avaliacoesUsuario->nota == '-1' ? 'fill: #CCC;' : '' ?>"
												    d="m 101.66403,158.65901 c 23.84566,13.67826 46.70648,-54.83557 61.69492,-86.825567 7.96534,-17.000481 4.6279,-45.535464 14.26121,-54.272813 9.63331,-8.7373429 17.75737,-6.894313 23.10298,-1.207528 17.60865,18.7325 12.53566,56.812585 4.37909,84.367708 -4.34309,14.67212 -13.46763,26.02573 -11.86191,30.62584 4.70067,13.46663 94.75971,-9.13586 113.21363,5.92452 18.45392,15.06036 8.74077,16.93356 6.04564,25.24238 -2.69513,8.30882 -10.8302,6.04404 -16.35976,16.07474 -3.07349,5.5754 6.78322,17.03545 6.56671,25.54017 -0.17292,6.79621 -13.96422,11.32672 -16.26393,17.37638 -2.50532,6.59064 7.50977,23.25466 2.4401,29.02828 -5.4073,6.15812 -14.95245,8.42542 -16.27718,15.32213 -2.56675,13.36277 13.04204,5.9997 -3.53916,28.79134 -16.58119,22.79166 -127.44384,7.97481 -127.44384,7.97481 l -38.84058,-20.761 c -8.884698,-7.87653 -6.695722,30.41878 -6.695722,30.41878 0,0 -84.564595,16.99287 -84.540336,-10.64681 0.0358,-40.78734 0.624939,-112.17741 0,-171.59257 -0.290704,-27.63828 84.998609,-11.08142 84.998609,-11.08142 0,0 0.36813,36.97516 5.119529,39.70063 z"
												    id="path1259"
												    sodipodi:nodetypes="sazsssszssssszcccsscs" />
												</svg>

												<svg
												   viewBox="0 0 330 330"
												   xmlns="http://www.w3.org/2000/svg"
												   xmlns:svg="http://www.w3.org/2000/svg"
												   style="width: 30px; margin: 3px;"
												   >
												  <path
												  	class="like mouse-hover" id="like3" data-value="1"
	 												style="<?= !empty($avaliacoesUsuario) && $avaliacoesUsuario->nota == '1' ? 'fill: #CCC;' : '' ?>"
												    d="m 101.66403,158.65901 c 23.84566,13.67826 46.70648,-54.83557 61.69492,-86.825567 7.96534,-17.000481 4.6279,-45.535464 14.26121,-54.272813 9.63331,-8.7373429 17.75737,-6.894313 23.10298,-1.207528 17.60865,18.7325 12.53566,56.812585 4.37909,84.367708 -4.34309,14.67212 -13.46763,26.02573 -11.86191,30.62584 4.70067,13.46663 94.75971,-9.13586 113.21363,5.92452 18.45392,15.06036 8.74077,16.93356 6.04564,25.24238 -2.69513,8.30882 -10.8302,6.04404 -16.35976,16.07474 -3.07349,5.5754 6.78322,17.03545 6.56671,25.54017 -0.17292,6.79621 -13.96422,11.32672 -16.26393,17.37638 -2.50532,6.59064 7.50977,23.25466 2.4401,29.02828 -5.4073,6.15812 -14.95245,8.42542 -16.27718,15.32213 -2.56675,13.36277 13.04204,5.9997 -3.53916,28.79134 -16.58119,22.79166 -127.44384,7.97481 -127.44384,7.97481 l -38.84058,-20.761 c -8.884698,-7.87653 -6.695722,30.41878 -6.695722,30.41878 0,0 -84.564595,16.99287 -84.540336,-10.64681 0.0358,-40.78734 0.624939,-112.17741 0,-171.59257 -0.290704,-27.63828 84.998609,-11.08142 84.998609,-11.08142 0,0 0.36813,36.97516 5.119529,39.70063 z"
												    id="path1259"
												    sodipodi:nodetypes="sazsssszssssszcccsscs" />
												</svg>

												<svg
												   viewBox="0 0 330 330"
												   xmlns="http://www.w3.org/2000/svg"
												   xmlns:svg="http://www.w3.org/2000/svg"
												   style="width: 39px; margin: 3px;"
												   >
												  <path
												    class="like mouse-hover" id="like4" data-value="2"
												    style="<?= !empty($avaliacoesUsuario) && $avaliacoesUsuario->nota == '2' ? 'fill: #CCC;' : '' ?>"
												    d="m 101.66403,158.65901 c 23.84566,13.67826 46.70648,-54.83557 61.69492,-86.825567 7.96534,-17.000481 4.6279,-45.535464 14.26121,-54.272813 9.63331,-8.7373429 17.75737,-6.894313 23.10298,-1.207528 17.60865,18.7325 12.53566,56.812585 4.37909,84.367708 -4.34309,14.67212 -13.46763,26.02573 -11.86191,30.62584 4.70067,13.46663 94.75971,-9.13586 113.21363,5.92452 18.45392,15.06036 8.74077,16.93356 6.04564,25.24238 -2.69513,8.30882 -10.8302,6.04404 -16.35976,16.07474 -3.07349,5.5754 6.78322,17.03545 6.56671,25.54017 -0.17292,6.79621 -13.96422,11.32672 -16.26393,17.37638 -2.50532,6.59064 7.50977,23.25466 2.4401,29.02828 -5.4073,6.15812 -14.95245,8.42542 -16.27718,15.32213 -2.56675,13.36277 13.04204,5.9997 -3.53916,28.79134 -16.58119,22.79166 -127.44384,7.97481 -127.44384,7.97481 l -38.84058,-20.761 c -8.884698,-7.87653 -6.695722,30.41878 -6.695722,30.41878 0,0 -84.564595,16.99287 -84.540336,-10.64681 0.0358,-40.78734 0.624939,-112.17741 0,-171.59257 -0.290704,-27.63828 84.998609,-11.08142 84.998609,-11.08142 0,0 0.36813,36.97516 5.119529,39.70063 z"
												    id="path1259"
												    sodipodi:nodetypes="sazsssszssssszcccsscs" />
												</svg>
												<div class="dialog">
													
												<?= ($avaliacoes->notaMedia ? lang("Site.home.rating.avg", [], $user->lang) .': ' . round($avaliacoes->notaMedia,1) .' '. lang("Site.home.rating.of", [], $user->lang) :'') ?>
												<?= ($avaliacoes->notaCount) ?> <?= ($avaliacoes->notaCount === '1' ? lang("Site.home.rating.singular", [], $user->lang) : lang("Site.home.rating.plural", [], $user->lang)) ?>
												</div>
												<div id="likeretorno" class="dialog"></div>
											</div>
										</div>		
										</div>
										

										<div class="post-comments">
			                                <?= lang("Site.home.comments.title", [], $user->lang) ?><br />
                                            <?php if($loginsession): ?>
                                                <textarea class="form-items" id="userComment" name="comentario"></textarea><br />
                                                <div style="display:flex; flex-direction: row; justify-content: space-between;">
	                                                <div id="comentarioretorno" class="wait"></div>
	                                                <div>
	                                            	    <button type="reset"><?= lang("Site.form.reset", [], $user->lang) ?></button>
	                                            	    <button class="comments"><?= lang("Site.home.comments.send", [], $user->lang) ?></button>
	                                            </div>
	                                            </div>
                                            <?php endif ?>
                                            <div id="comments">
												<?php echo view('postagens_comentarios') ?>
											</div>
										</div>

									</div>

								<?php endif ?>

							</div>
						</section>

					</section>

			</div>

<script type="text/javascript">
	$('.like').click(function(){

		$('.like').css("fill", "#5052B5");
		$(this).css("fill", "#CCC");
		var value = $(this).data('value');
		$.ajax({

	        url : '<?= site_url('avaliacao/set/'.$postagem->id) ?>',
	        data:{
	        	pagina: 'postagem',
	        	value: value
	        },
	        type:'post',
	        dataType:'json',
	        beforeSend: function(){
				$("#likeretorno").removeClass().addClass('dialog wait').html('<i class="fas fa-spinner fa-spin"></i> <?= lang("Site.form.wait", [], $user->lang) ?>');
	        },
	        success: function(retorno){
	            console.log(retorno);
	            $("#likeretorno").removeClass();
	            if(retorno.status===true){
	            	$("#likeretorno").addClass('dialog ok').html(retorno.msg);
	            } else{
	            	$("#likeretorno").addClass('dialog error').html(retorno.msg);
	            }
	        },
	        error: function(st, text){
	            console.log(st, text);
	        }
	    });
	});

	$('button[type="reset"]').click(function(){
		$("#userComment").val('');
	});


	$('.comments').click(function(){

		var value = $("#userComment").val();
		if(value.length < 2){
			$("#comentarioretorno").html('<?= lang("Site.home.comments.invalid", [], $user->lang) ?>').addClass('error');
			return false;
		}
		$.ajax({

	        url : '<?= site_url('comentarios/set/'.$postagem->id) ?>',
	        data:{
	        	pagina: 'postagem',
	        	value: value
	        },
	        type:'post',
	        dataType:'json',
	        beforeSend: function(){
				$("#comentarioretorno").removeClass().html('<i class="fas fa-spinner fa-spin"></i> <?= lang("Site.form.wait", [], $user->lang) ?>');
	        },
	        success: function(retorno){
	            console.log(retorno);
	            console.log($("#comments"));
	            $("#comentarioretorno").removeClass();
	            if(retorno.status===true){
	            	$("#comentarioretorno").addClass('dialog ok').html(retorno.msg);

	            	$("#comments").html(retorno.content).addClass('vivify delay-0 fadeIn');
	            	$("#userComment").val('');
	            } else{
	            	$("#comentarioretorno").addClass('dialog error').html(retorno.msg);
	            }
	        },
	        error: function(st, text){
	            console.log(st, text);
	        }
	    });
	});


	$('body').on('click','.comentarios-excluir', function(){

		var comentarios = $(this).parents(".comentarios");
		var CommentControlReturn = $(this).parent(".comentarios-comp-control").find(".comentarios-comp-control-retorno");
		var key = $(this).data('key');
		$.ajax({

	        url : '<?= site_url('comentarios/delete/') ?>'+key,
	        data:{
	        	pagina: 'postagem',
	        },
	        type:'post',
	        dataType:'json',
	        beforeSend: function(){
				CommentControlReturn.removeClass().html('<i class="fas fa-spinner fa-spin"></i> <?= lang("Site.form.wait", [], $user->lang) ?>');
	        },
	        success: function(retorno){
	            console.log(comentarios,CommentControlReturn,retorno);

	            if(retorno.status===true){
	            	CommentControlReturn.addClass('dialog ok').html(retorno.msg);
	            	comentarios.find('.comentarios-text').css('opacity',0.3);
	            	comentarios.find('.comentarios-comp-by').css('opacity',0.3);
	            } else{
	            	CommentControlReturn.addClass('dialog error').html(retorno.msg);
	            }
	        },
	        error: function(st, text){
	            console.log(st, text);
	        }
	    });
	});

</script>