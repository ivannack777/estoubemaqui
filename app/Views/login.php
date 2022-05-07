<style type="text/css">

.btn
{
    outline: none;
    border: none;
    width: 190px;
    height: 30px;
    background: transparent;
    color: white;
    position: relative;
    font-size: 0.9em;
    margin: 17px 0;
}


/* Third button ----------------------------*/

.third-btn
{
   
    
    transition: all 400ms;
}
.third-btn::before
{
    content: "";
    position: absolute;
    width: 15px;
    height: 15px;
    top: 0; left: 0;
   border-left: 3px solid blue;
   border-top: 3px solid blue;
   transition: all 400ms;
}
.third-btn::after
{
    content: "";
    position: absolute;
    width: 15px;
    height: 15px;
    bottom: 0; right: 0;
   border-right: 3px solid blue;
   border-bottom: 3px solid blue;
   transition: all 400ms;
}
.third-btn:hover::before,.third-btn:hover::after
{
    width: 100%;
    height: 100%;
}

/* fourth button ---------------------------*/

.fourth-btn
{
  
    overflow: hidden;
    
}
.fourth-btn::before
{
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to left , transparent 24% , #606060A0 84%, #606060A0 24%);
    left: 0;top: 0;
    z-index: -5;
    
    animation: fourth-btn-anime 4.4s linear infinite ;
}
.fourth-btn::after
{
    content: "";
    position: absolute;
    width: 95%;
    height: 95%;
    transform:translate(-50%,-50%) ;
    left:50%;top: 50%;
    background: #E3CD81FF;
    z-index: -4;
}
@keyframes fourth-btn-anime
{
    0%{transform:  rotateY(0deg);   }
    10%{transform: rotateY(36deg);  }
    20%{transform: rotateY(72deg);  }
    30%{transform: rotateZ(108deg); }
    40%{transform: rotateZ(144deg); }
    50%{transform: rotateZ(180deg); }
    60%{transform: rotateX(216deg); }
    70%{transform: rotateX(252deg); }
    80%{transform: rotateX(288deg); }
    90%{transform: rotateX(324deg); }
   100%{transform: rotateX(360deg); }

}



</style>
    <button class="third-btn btn">Hover me</button>
    <button class="fourth-btn btn">Hover me</button>
   </div>

<div id="wrapper">
	<section class="wrapper style2 spotlights">
		<div>
		</div>
	</section>
	<section>
		<div class="style2" id="logindiv" >
			<div class="content">
				<!-- posts session -->
				<h2 class="sessions"><?= lang("Site.login.title", [], $user->lang); ?></h2>
				<h3 class="sessions"><?= lang("Site.login.subtitle", [], $user->lang); ?></h3>


				<p id="centaAlert" class="alert alert-info" style="display:<?= $retorno['status'] ? 'none' : 'block' ?>">
					<span class="fa-stack fa-2x">
						<i class="fas fa-user fa-2x"></i>
						<i class="fas fa-check fa-stack-1x text-danger"></i>
					</span>
					<?= $retorno['msg'] ?? '' ?>
				</p>

					<form id="formlogin" method="post" action="<?= site_url('login/entrar') ?>">
						<input type="hidden" id="uri" name="uri" value="<?= $retorno['uri'] ?? '' ?>">
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
								<input type="password" id="password" name="password">
            	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
							</div>
							<div class="col">
                                 <div class="">
									<button type="submit" class="background-transition fourth-btn" id="ir"><i class="fas fa-arrow-right"></i> <?= lang("Site.login.enter", [], $user->lang); ?></button>
									<a href="<?= site_url('login/cadastro') ?>"><i class="fab fa-wpforms"></i> <?= lang("Site.login.register.invite", [], $user->lang); ?></a>
								</div>
            	            </div>
						</div>
						<div class="row align-items-center inner items">
							<div class="col">
								<div id="retornodiv"></div>
            	            </div>
						</div>
					</form>


		</div>
	</section>
</div>


<script type="text/javascript">

$("#formlogin").submit(function (e) {
	e.preventDefault();
	var este = $("#ir");
	login(este);
});

$("#ir").click(function (e) {
	e.preventDefault();
	var este = $(this);
	login(este);
});

function login(este){
	$.ajax({
        url: '<?= site_url('login/entrar') ?>',
        dataType:'json',
        data:{
        	uri:$("#uri").val(),
        	identifier:$("#identifier").val(),
        	password:$("#password").val(),
        },
        method:'post',
        beforeSend: function(){
            console.log(parent.find('svg'));
            este.css('background-color', 'rgba(97, 31, 121, 0.7)').find('svg').removeClass('fa-arrow-right').addClass('fa-spin fa-spinner border-animate');

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