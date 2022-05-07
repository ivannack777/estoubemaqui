<style type="text/css">
*
{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
body
{
    background-color: #E3CD81FF;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
  flex-direction:column;
}
h1
{
  color:#30b0abFF;
  font-size:3.4em;
  margin-bottom:19px;
  text-transform:uppercase;
  font-family:sans-serif;
  letter-spacing:5px;
}
.container
{
    width: 90%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    height: auto;
    gap: 7%;
}
.btn
{
    outline: none;
    border: none;
    width: 90px;
    height: 30px;
    background: transparent;
    color: white;
    position: relative;
    font-size: 0.9em;
    margin: 17px 0;
}

/* first button -----------------------------*/

.first-btn
{
    border-bottom: 3px solid #89ABE3FF;
    transition:  all 400ms ease-out;
}
.first-btn:hover
{
    background: #89ABE3FF;

}


/* second button ---------------------------*/

.second-btn
{
    border: 3px solid #7DB46CFF;
   
    z-index: 4;
    transform-style: preserve-3d;
}
.second-btn::after
{
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    background:#9de6b8 ;
    left: 7px;
    top: 5px;
    z-index: -2;
    transition: all 300ms linear;
    transform: translateZ(-20px);
}
.second-btn:hover::after
{
    left: 0; top: 0;
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
    background: linear-gradient(to left , transparent 44% , #606060FF 84%);
    left: 0;top: 0;
    z-index: -5;
    
    animation: fourth-btn-anime 1.4s linear infinite ;
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
    0%{
        transform:  rotateZ(0deg);
    }
    0%{
        transform:  rotateZ(360deg);
    }
}


/* fifth button --------------------------*/

.fifth-btn
{
    background: #101820FF;
   z-index: 0;
   overflow: hidden;
}
.fifth-btn::after
{
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background: #F2AA4CFF;
    z-index: -5;
    transform: skewX(45deg) scaleX(0);
    transform-origin: center;
    transition: all 500ms ease;
}
.fifth-btn:hover::after
{
    transform: skewX(45deg) scaleX(1.4);
}


/* sixth button ------------------------------*/

.sixth-btn::before
{
    content: "";
    position: absolute;
    width: 100%;
    height:100%;
    bottom: 0;
    left: 0;
    background: #603F83FF;
    z-index: -2;
    transform-origin: bottom;
    transform: scaleY(0.15);
   transition: all 500ms ease;
}
.sixth-btn:hover:before
{
    transform: scaleY(1);
}

/* seventh button ---------------------------*/

.seventh-btn
{
    background: #28334AFF;
}
.seventh-btn::before
{
    content: "";
    position: absolute;
    width: 90%;
    height:90%;
    bottom: 0;
    left:5px;
    background: #FC766AFF;
    transform-origin: left;
    transform: rotateZ(0deg);
    z-index: -2;
    transition: all 500ms ease-out;
}
.seventh-btn::after
{
    content: "";
    position: absolute;
    width: 90%;
    height:90%;
    top: 0;
    right:5px;
    background: #FFBA52FF;
    transform-origin: right;
    transform: rotateZ(0deg);
    z-index: -2;
    transition: all 500ms ease-out;
}
.seventh-btn:hover::before , .seventh-btn:hover::after
{
    transform: rotateZ(-10deg);
}


/* eigth button ----------------------------*/

.eigth-btn 
{
    background: #339E66FF;
    z-index: 0;
    overflow: hidden;
    
}
.eigth-btn::before
{
    content: "";
    position: absolute;
    width: 100%;
    height:100%;
    bottom: 0;
    left: 0;
    background: #95DBE5FF;
    z-index: -2;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform  500ms 0.5s;
}
.eigth-btn:hover:before
{
   
    transform: scaleY(1);
    transition: transform 500ms ;
   
}


.eigth-btn::after
{
    content: "";
    position: absolute;
    width: 100%;
    height:100%;
    bottom: 0;
    left: 0;
    background: orchid;

    z-index: -2;
    transform: scaleY(0);
    transform-origin: bottom;
    transition: transform 500ms  linear ;
}
.eigth-btn:hover:after
{
    transform: scaleY(1);
    transition: transform 500ms 0.5s linear;
}


/* ninth button ------------------------ */

.ninth-btn
{
    background: blueviolet;
    z-index: 0;
    overflow: hidden;
}
.ninth-btn::before
{
    content: "";
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: -100%;
    background: rgba(220, 193, 245, 0.699);
    z-index: -5;
    transform: skewX(45deg) scaleX(0.5);
    transition: left 500ms linear;
}
.ninth-btn:hover:before
{
    left: 100%;
}


/* tenth button -------------------------- */

.tenth-btn
{
    background: #EE2737FF;
    border-radius: 30px;
    z-index: 0;
    overflow: hidden;
}
.tenth-btn::before
{
    content: "";
    position: absolute;
    width:200px;
    height: 200px;
    top: -200%;
    left:-20%;
    background: #643E46FF;
    border-radius: 50%;
    transition: all 700ms linear;
    transform: scale(0);
    transform-origin: left;
    z-index: -1;
}
.tenth-btn:hover:before
{
    transform: scale(1);
}


</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Document</title>
</head>
<body>
  <h1>Unique Buttons</h2>
   <div class="container">
    <button class="first-btn btn">Hover me</button>
    <button class="second-btn btn">Hover me</button>
    <button class="third-btn btn">Hover me</button>
    <button class="fourth-btn btn">Hover me</button>
    <button class="fifth-btn btn">Hover me</button>
    <button class="sixth-btn btn">Hover me</button>
    <button class="seventh-btn btn">Hover me</button>
    <button class="eigth-btn btn">Hover me</button>
    <button class="ninth-btn btn">Hover me</button>
    <button class="tenth-btn btn">Hover me</button>
   </div>
</body>
</html>

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
								 <div class="rainbow">
									<button type="submit" class="background-transition border-animate" id="ir"><i class="fas fa-arrow-right"></i> <?= lang("Site.login.enter", [], $user->lang); ?></button>
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

<div>
  <div class="rotating-border rotating-border--google">
    Rotating<br>border<br>animation
  </div>
  <br>
  <div class="rotating-border rotating-border--black-white  rotating-border--reverse">🏁</div>
    <div class="rotating-border rotating-border--rainbow">🌈</div>
  <div class="rotating-border rotating-border--black-yellow">💡</div>
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