<div id="wrapper">
	<section class="wrapper style2 spotlights">
		<div>
		</div>
	</section>
	<section>
		<div class="style2" id="logindiv" >
			<div class="content">
				<!-- posts session -->
				<h2 class="sessions"><?= lang("Site.login..register.title", [], $user->lang); ?></h2>
				<h3 class="sessions"><?= lang("Site.login.register.subtitle", [], $user->lang); ?></h3>


				<p id="centaAlert" class="alert alert-info" style="display:<?= $retorno['status'] ? 'none' : 'block' ?>">
					<span class="fa-stack fa-2x">
						<i class="fas fa-user fa-2x"></i>
						<i class="fas fa-check fa-stack-1x text-danger"></i>
					</span>
					<?= $retorno['msg'] ?? '' ?>
				</p>

				<form id="formlogin" method="post" action="#">
					<input type="hidden" id="uri" name="uri" value="<?= $retorno['uri'] ?? '' ?>">
					<div class="row align-items-center inner items">
						<div class="col">
							<label for="nome"><?= lang("Site.users.name", [], $user->lang); ?></label>
						</div>
						<div class="col">
							<input type="text" id="nome" name="nome" autofocus="">
        	            </div>
					</div>
					<div class="row align-items-center inner items">
						<div class="col">
							<label for="email"><?= lang("Site.users.email", [], $user->lang); ?></label>
						</div>
						<div class="col">
							<input type="text" id="email" name="email">
        	            </div>
					</div>
					<div class="row align-items-center inner items">
						<div class="col">
							<label for="telefone"><?= lang("Site.users.phone", [], $user->lang); ?></label>
						</div>
						<div class="col">
							<input type="text" id="telefone" name="telefone">
        	            </div>
					</div>
					<div class="row align-items-center inner items">
						<div class="col">
							<label for="password"><?= lang("Site.users.password", [], $user->lang); ?></label>
						</div>
						<div class="col">
							<input type="password" id="password" name="password">
        	            </div>
					</div>
				    <div class="row align-items-center inner items">
						<div class="col">
							<label for="repassword"><?= lang("Site.users.repassword", [], $user->lang); ?></label>
						</div>
						<div class="col">
							<input type="password" id="repassword" name="repassword">
        	            </div>
					</div>

					<div class="row align-items-center inner items">
						<div class="col">
							<span id="passforgot"><?= lang("Site.users.passforgot", [], $user->lang); ?></span>
						</div>
						<div class="">
							<button type="buttom" class="background-transition" id="salvar"><i class="fas fa-arrow-right"></i> <?= lang("Site.users.save", [], $user->lang); ?></button>
        	            </div>
					</div>
					<div class="row align-items-center inner items">
						<div class="col">
							<div id="retornodiv"></div>
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
	var este = $("#salvar");
	salvar(este);
});

$("#passforgot").click(function (e) {
	e.preventDefault();
	var email = $("#email").val();
	console.log(email);
	window.location.href = "<?= site_url('login/passforgot?email=') ?>"+email
});

$("#salvar").click(function (e) {
	e.preventDefault();
	var este = $(this);
	salvar(este);
});

function salvar(este){

	console.log('salvar()')
	var password = $("#password").val()
	var repassword = $("#repassword").val()

	if(password != repassword){
		$("#retornodiv").html("<?= lang("Site.users.passnotequal", [], $user->lang); ?>").addClass('error')
		return false;
	}

	$.ajax({
        url: '<?= site_url('login/salvar') ?>',
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
	                location.href = '<?= site_url() ?>'+retorno.uri;
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