<div id="wrapper">
	<section class="wrapper style2 spotlights">
		<div>
		</div>
	</section>
	<section>
		<div class="style2" id="logindiv" >
			<div class="content">
				<!-- posts session -->
				<h2 class="sessions"><?= lang("Site.login.passforgot.title", [], $user->lang); ?></h2>
				<p class="sessions"><?= lang("Site.login.passforgot.text", [], $user->lang); ?></p>

				<form id="formlogin" method="post" action="#">
					<input type="hidden" id="uri" name="uri" value="<?= $retorno['uri'] ?? '' ?>">

					<div style="display: flex;flex-direction: row;align-content: space-around;width: 500px;">
						<div class="row align-items-center inner items">
							<div class="col">
								<label for="email"><?= lang("Site.users.email", [], $user->lang); ?></label>
							</div>
							<div class="col">
								<input type="text" id="email" name="email" value="<?= $email ?>">
	        	            </div>
						</div>


						<div class="row align-items-center inner items">
							<div class="col">
							</div>
							<div class="">
								<button type="buttom" class="background-transition" id="enviar"><i class="fas fa-arrow-right"></i> <?= lang("Site.login.passforgot.send", [], $user->lang); ?></button>
	        	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
								<div id="retornodiv"></div>
	        	            </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

$("#formlogin").submit(function (e) {
	console.log('#formlogin')
	e.preventDefault();
	var este = $("#enviar");
	enviar(este);
});

$("#enviar").click(function (e) {
	e.preventDefault();
	var este = $(this);
	enviar(este);
});

function enviar(este){

	console.log('enviar()')
	var password = $("#password").val()
	var repassword = $("#repassword").val()

	if(password != repassword){
		$("#retornodiv").html("<?= lang("Site.users.passnotequal", [], $user->lang); ?>").addClass('error')
		return false;
	}

	$.ajax({
        url: '<?= site_url('login/passforgotSend') ?>',
        dataType:'json',
        data:{
        	uri:$("#uri").val(),
        	nome:$("#nome").val(),
        	email:$("#email").val(),
        	telefone:$("#telefone").val(),
        	password:$("#password").val(),
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