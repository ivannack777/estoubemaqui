        <!-- Footer -->
            <footer id="footer" class="wrapper style1-alt">
                <div class="inner">
                    <ul class="menu">
                        <li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                    </ul>
                </div>
            </footer>

        <!-- Scripts -->
        <!-- <script src="<?php echo site_url('assets/js/jquery.scrollex.min.js') ?>"></script> -->
        <!-- <script src="<?php echo site_url('assets/js/jquery.scrolly.min.js') ?>"></script> -->
        <script src="<?php echo site_url('assets/js/browser.min.js') ?>"></script>
        <script src="<?php echo site_url('assets/js/breakpoints.min.js') ?>"></script>
        <!-- <script src="<?php echo site_url('assets/js/util.js') ?>"></script> -->
        <script src="<?php echo site_url('assets/js/main.js') ?>"></script>



<script type="text/javascript">

$(document).ready(function(){
    countItens();
});

function countItens(animate=false){
    $.ajax({

        url : '<?= site_url('cesta/get') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            $("#cesta").html(Object.keys(retorno).length);
            if(animate){
                $("#cesta").animate({
                    fontSize: "3em",
                    fontWeight: "300",
                  }, {
                    duration: 200,
                    queue: true,
                })
                .animate({
                    fontSize: "2em",
                    fontWeight: "600",
                  }, {
                    duration: 500,
                    queue: true,
                } );
            }
        },
        error: function(st, text){
            console.log(st, text);
        }
    });
}

$(".addItem").click(function(){
    var itemId = $(this).data('item');
    addItem(itemId);
});

$(".removeItem").click(function(){
    removeItem(this);
});

$(".quantItemCesta").change(function(){
    setQuant(this);
});


$(".increaseItemCesta").click(function(){
    setQuant(this);
});

$(".decreaseItemCesta").click(function(){
    setQuant(this);
});

function setQuant(este){
    var saida = false;

    var parent = $(este).parent('div');
    var itemId = parent.data('item');
    var input = parent.find('input');
    var quant = parent.find('input').val();

    

    if($(este).hasClass('increaseItemCesta')){
        quant = eval(+quant +1);
        if(quant>1 && parent.find('.decreaseItemCesta').prop('disabled')){
            parent.find('.decreaseItemCesta').prop('disabled', false);
        }
    }

    if($(este).hasClass('decreaseItemCesta')){

        quant = eval(+quant -1);
        if(quant < 2){
            $(este).prop('disabled', true);
        } else {
            $(este).prop('disabled', false);
        }
    }

    if($(este).hasClass('quantItemCesta') && (quant < 1 || isNaN(quant) ) ){ 
        input.css('background-color', 'rgba(255, 121, 104, 0.7)');
        setTimeout(function(){
            input.css('background-color', '');
        }, 600)
        return false;
    }

    $.ajax({
        async: false,
        url : '<?= site_url('cesta/setQuant/') ?>/'+ itemId +'/'+ quant,
        dataType:'json',
        beforeSend: function(){
            console.log(parent.find('svg'));
            parent.find('svg').css('display', 'initial');

        },
        success: function(retorno){
            saida = retorno;
            countItens();
            input.val(retorno).css('background-color', 'rgba(31, 121, 104, 0.7)');
            setTimeout(function(){
                input.css('background-color', '');
            }, 600);
            parent.find('svg').css('display', 'none');
            //console.log('addItem', saida);
        },
        error: function(st, text){
            console.log(st, text);
            parent.find('svg').css('display', 'none');
        }
    });
    return saida;
}

function addItem(item){
   var saida = false;
    $.ajax({
        async: false,
        url : '<?= site_url('cesta/add') ?>/'+ item,
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            saida = retorno;
            countItens(true)
        },
        error: function(st, text){
            console.log(st, text);
        }
    });
    return saida;
}

function removeItem(este){
    var itemId = $(este).data('item');
    var row = $("#row-"+itemId);
    var saida = false;
    $.ajax({
        async: false,
        url : '<?= site_url('cesta/remove') ?>/'+ itemId,
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            saida = retorno
            countItens(true);
            row.css('transition', 'background 1s')
            .css('background-color', '#ee5353');
                row.hide(1200, function(){
                row.remove();
            });

        },
        error: function(st, text){
            console.log(st, text);
        }
    });
    return saida;
}

$("#clearCesta").click(function(){
    $.ajax({

        url : '<?= site_url('cesta/clear') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            countItens(true);
            $("#cestadiv").hide(1200, function(){
                $("#cestadiv").html('');
            });
            $("#centaAlert").show('slow');

        },
        error: function(st, text){
            console.log(st, text);
        }
    });
});
</script>
    </body>
</html>
