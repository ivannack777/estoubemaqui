		<!-- Wrapper -->
			<div id="wrapper">


					<section class="wrapper style2 spotlights">
						<div>
							<img class="pages" src="<?= site_url('assets/images/produto_02.jpeg') ?>" alt="" data-position="center center" />
						</div>
					</section>
						<section>
							<div class="content">
								<!-- posts session -->

								<h2 class="sessions"><?= lang("Site.basket.order", [], $user->lang); ?></h2>
								<?php 

								if(!isset($pedido[0])): ?>
									<?= lang("Site.order.not", [], $user->lang); ?>
								<?php else: 
									$pedido = $pedido[0];
									// var_dump(($pedido));exit;
									?>
									<div class="style2" id="pedidos" >
										<div id="pedidosdiv" class="divtable divtable-full">
											<div class="divrow">
												<div class="divcell" style="vertical-align: top;">
												   <h3>Seu pedido <?= $pedido->idpub ?> está fechado!</h3>
												   O valor total é  <span style="font-size: 1.5em;"><?= $pedido->price_total ?></span><br>
													O pagamento pode ser feito por transfência PIX <br />
												   Copiar e colar <button id="pixcopy" onclick="copyToClipboard('<?= $pix['copy'] ?>')" title="Copiar chave pix" style="padding: 7px; font-size: 1em; height: auto; line-height: 0.75em;"><i class="far fa-copy"></i></button><br>
												   <div id="pixcopy" style="border:1px solid grey; word-wrap: anywhere; padding: 9px;"><?= $pix['copy'] ?></div>
													Chave: 0d3003ff-2f13-4c30-90b0-7feb1d6218d6
												</div>
												<div class="divcell" style="vertical-align: top;">
													<img src="<?= site_url('assets/images/logo_pix.png') ?>" alt="logo pix" style="width: 160px;">
												   <img src="data:image/png;base64,<?= $pix['qrcode'] ?>" style="width: 160px;">
												</div>
											</div>
										</div>
									</div>
								<?php endif ?>
							</div>
					</section>
			</div>

<script type="text/javascript">

   $.ajax({

        url : '<?= site_url('cesta/get/json') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            cesta = retorno;
        },
        error: function(st, text){
            console.log(st, text);
        }
    });


// Copies a string to the clipboard. Must be called from within an
// event handler such as click. May return false if it failed, but
// this is not always possible. Browser support for Chrome 43+,
// Firefox 42+, Safari 10+, Edge and Internet Explorer 10+.
// Internet Explorer: The clipboard feature may be disabled by
// an administrator. By default a prompt is shown the first
// time the clipboard is used (per session).
function copyToClipboard(text) {
	console.log(text);
    if (window.clipboardData && window.clipboardData.setData) {
        // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
        return window.clipboardData.setData("Text", text);

    }
    else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
        var textarea = document.createElement("textarea");
        textarea.textContent = text;
        textarea.style.position = "fixed";  // Prevent scrolling to bottom of page in Microsoft Edge.
        document.body.appendChild(textarea);
        textarea.select();
        try {
            return document.execCommand("copy");  // Security exception may be thrown by some browsers.
        }
        catch (ex) {
            console.warn("Copy to clipboard failed.", ex);
            return false;
        }
        finally {
            document.body.removeChild(textarea);
        }
    }
}
</script>