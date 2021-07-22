<div id="wrapper">
	<section class="wrapper style2 spotlights">
		<div>
			ola
		</div>
	</section>
	<section>
		<div class="style2" id="ebooks" >
			<div class="content">
				<!-- posts session -->
				<h2 class="sessions"><?= lang("Site.login.title", [], $user->lang); ?></h2>
				<h3 class="sessions"><?= lang("Site.login.subtitle", [], $user->lang); ?></h3>


				<p id="centaAlert" class="alert alert-info" style="display:<?= $retorno['status'] ? 'none' : 'block' ?>">
					<span class="fa-stack fa-2x">
						<i class="far fa-file fa-2x"></i>
						<i class="fas fa-times fa-stack-1x text-danger"></i>
					</span>
					<?= lang("Site.basket.empty", [], $user->lang); ?>
				</p>
				<div id="logindiv" style="width: 50%;">
					<form id="formlogin" method="post" action="<?= site_url('login/entrar') ?>">
						<div class="row align-items-center inner items">
							<div class="col">
								<label for="identifier"><?= lang("Site.users.identifier", [], $user->lang); ?></label>
							</div>
							<div class="col">
								<input type="text" id="identifier" name="identifier" autofocus="">
            	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
								<label for="password"><?= lang("Site.users.password", [], $user->lang); ?></label>
							</div>
							<div class="col">
								<input type="text" id="password" name="password">
            	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
							</div>
							<div class="col">
								<button type="submit" class="background-transition" id="ir"><i class="fas fa-arrow-right"></i></button>
            	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
							</div>
							<div class="col">
								<div id="retornodiv"></div>
            	            </div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">

$("#formlogin").submit(function (e) {
	e.preventDefault();
	console.log('form');
	var este = $("#ir");
	login(este);
});

$("#ir").click(function (e) {
	e.preventDefault();
	console.log('click');
	var este = $(this);
	login(este);
});

function login(este){
	console.log(este)
	$.ajax({
        url: '<?= site_url('login/entrar') ?>',
        dataType:'json',
        data:{
        	identifier:$("#identifier").val(),
        	password:$("#password").val(),
        },
        method:'post',
        beforeSend: function(){
            console.log(parent.find('svg'));
            este.css('background-color', 'rgba(97, 31, 121, 0.7)').find('svg').removeClass('fa-arrow-right').addClass('fa-spin fa-spinner');

        },
        success: function(retorno){
        	console.log(retorno);
            este.find('svg').removeClass('fa-spin fa-spinner').addClass('fa-arrow-right');
            // $("#retornodiv").removeClass();
        	if(retorno.status){
				$("#retornodiv").addClass('text-success');
				este.css('background-color', 'rgba(31, 131, 91, 0.7)');
	            setTimeout(function(){
	                este.css('background-color', '')();
	            }, 600);
	            setTimeout(function(){
	                location.href = '<?= site_url() ?>';
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