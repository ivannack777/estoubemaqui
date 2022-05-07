<div id="wrapper">
	<section class="wrapper style2 spotlights">
		<div>
		</div>
	</section>
	<section>
		<div class="style2" id="logindiv" >
			<div class="content">
				<!-- posts session -->
				<h2 class="sessions"><?= lang("Site.users.passrecover.title", [], $user->lang); ?></h2>
				<p class="sessions"><?= lang("Site.users.passrecover.text", [], $user->lang); ?></p>

					<input type="hidden" id="email" name="email" value="<?= $email ?>">

					<div style="display: flex;
						flex-direction: column;
						align-content: space-around;
						width: 500px;">
							<div><?= $retorno['msg'] ?></div>
							<?php if($timeExpired): ?>
								<?= $retorno['msg']; ?>
								<button><?= lang("Site.users.passrecover.randonCodeNew", [], $user->lang); ?></button>
							<?php else: ?>
								<div>
									<label for="newpass"><?= lang("Site.users.passrecover.newpass", [], $user->lang); ?></label>
								</div>
								<div style="margin-bottom: 9px;">
									<input type="text" id="newpass" name="newpass" value="">
								</div>
								<div>
									<label for="renewpass"><?= lang("Site.users.passrecover.renewpass", [], $user->lang); ?></label>
								</div>
								<div style="margin-bottom: 9px;">
									<input type="text" id="renewpass" name="renewpass" value="">
								</div>

								<div style="margin-bottom: 9px;">
									<button id="enviar" type="buttom" class="background-transition"><?= lang("Site.users.passrecover.send", [], $user->lang); ?></button>
								</div>
							<?php endif ?>
							<div class="col">
								<div id="retornodiv"></div>
	        	            </div>
						</div>
					</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">


$("#enviar").click(function (e) {
	e.preventDefault();
	var este = $(this);
	enviar(este);
});

function enviar(este){

	console.log('enviar()')
	var newpass = $("#newpass").val()
	var renewpass = $("#renewpass").val()

	if(newpass != renewpass){
		$("#retornodiv").html("<?= lang("Site.users.passnotequal", [], $user->lang); ?>").addClass('error')
		return false;
	}

	$.ajax({
        url: '<?= site_url('login/passrecoverSave/'. $email) ?>',
        dataType:'json',
        data:{
        	newpass:$("#newpass").val(),
        	renewpass:$("#renewpass").val(),
        },
        method:'post',
        beforeSend: function(){
            console.log(parent.find('svg'));
            este.css('background-color', 'rgba(97, 31, 121, 0.7)').find('svg').removeClass('fa-arrow-right').addClass('fa-spin fa-spinner');

        },
        success: function(retorno){
        	// console.log(retorno);
            este.find('svg').removeClass('fa-spin fa-spinner').addClass('fa-arrow-right');
            $("#retornodiv").removeClass();
        	if(retorno.status){
				$("#retornodiv").addClass('bold text-success');
				este.css('background-color', 'rgba(31, 131, 91, 0.7)');
	            setTimeout(function(){
	                este.css('background-color', '');
	            }, 600);
	            setTimeout(function(){
	                //location.href = '<?= site_url() ?>'+retorno.uri;
	            }, 600);

        	} else {
        		$("#retornodiv").addClass('bold text-danger');
        		este.css('background-color', 'rgba(189, 23, 90, 0.7)');
	            setTimeout(function(){
	                este.css('background-color', '');
	            }, 1200);
        	}
            $("#retornodiv").html(retorno.msg);
        },
        error: function(st, text){
            console.log(st, text);
            este.removeClass().find('svg').removeClass('fa-spin fa-spinner').addClass('fa-arrow-right');
            $("#retornodiv").addClass('text-danger').html(st.status +' '+ st.statusText);
        }
	});
}
</script>