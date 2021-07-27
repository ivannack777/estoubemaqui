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
            cestaMount(retorno)
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


$("#cestadiv").on('click', '.increaseItemCesta', function(){
    setQuant(this);
});

$("#cestadiv").on('click', '.decreaseItemCesta', function(){
    setQuant(this);
});

function setQuant(este){
    var saida = false;

    var parent = $(este).parent('div');
    var itemId = parent.data('item');
    var input = parent.find('input');
    var quant = parent.find('input').val();
    var row = $("#row-"+ itemId);


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
            input.val(retorno);

            row.addClass('ok');
            setTimeout(function(){
                row.removeClass('ok', '');
                countItens();
            }, 1600);



            parent.find('svg').css('display', 'none');
            //console.log('addItem', saida);
        },
        error: function(st, text){
            parent.find('svg').css('display', 'none');
            row.addClass('error');
            setTimeout(function(){
                row.removeClass('error');
            }, 1600);
            $("#cestaAlert").css('display', 'block').removeClass().addClass('alert alert-error')
                .html('Descupe, mas um erro acontceu aqui: '+ st.status +' '+ st.statusText)

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



function cestaMount(CestaArray){
    var price,priceParce, priceTotal=0,quant;
    $("#cestadiv").html('');
    for(var i=0; i<CestaArray.length; i++){
        priceItem = 0;
        priceItens = null;
        console.log(i);
        console.log(CestaArray[i]);

        console.log('price_promo', (CestaArray[i].produto.price_promo));
        console.log('price', CestaArray[i].produto.price);
        if(CestaArray[i].produto.price){
            priceItem = parseFloat(CestaArray[i].produto.price);
        }
        if(CestaArray[i].produto.price_promo){
            priceItem = parseFloat(CestaArray[i].produto.price_promo);
        }
        quant = CestaArray[i].count;
        priceItens = priceItem && quant ?  priceItem * quant : 0;
        if(priceItens)  priceTotal += priceItens;
        console.log('calculo', priceItem +'*'+ quant );
        console.log('=', priceItem * quant );
        console.log('priceTotal', priceTotal );
        $("#price_total").val(priceTotal);
        
        $("#cestadiv").append(
        '<div class="divrow items background-transition" id="row-'+ CestaArray[i].produto.key +'">'+
        '    <div class="divcell">'+
        '            <img class="mini" src="<?= site_url('assets/images/produtos/') ?>'+ CestaArray[i].produto.cover +'" alt="" data-position="center center" />'+
        '        <button type="button" class="removeItem" data-item="'+ CestaArray[i].produto.key +'" title="<?= lang("Site.basket.buttons.remove", [], $user->lang) ?>"><i class="far fa-trash-alt"></i></button>'+
        '        <strong>'+ CestaArray[i].produto.title +'</strong> '+ CestaArray[i].produto.subtitle +
        '    </div>'+
        '    <div class="divcell align-right"><?= $user->price_simbol ?> '+ (priceItem).toFixed(2) +'</div>'+
        '    <div class="divcell">'+
        '        <div class="btn-group quantItemCestadiv" data-item="'+ CestaArray[i].produto.key +'">'+
        '            <button type="button" class="decreaseItemCesta" title="<?= lang("Site.basket.buttons.decrease", [], $user->lang) ?>" '+ (CestaArray[i].count < 2 ? "disabled" :"") +'>-</button>'+
        '            <input type="text" class="quantItemCesta text-center" class="text-center"  value="'+ CestaArray[i].count +'"  placeholder="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" title="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" style="width:90px;")>'+
        '            <i class="fa fa-spinner fa-spin" style="display:none;"></i>'+
        '            <button type="button" class="increaseItemCesta" title="<?= lang("Site.basket.buttons.increase", [], $user->lang) ?>">+</button>'+
        '        </div>'+
        '    </div>'+
        '    <div class="divcell align-right">'+
        '        <?= $user->price_simbol ?> '+ priceItens.toFixed(2) +
        '    </div>'+
        '</div>');
    }
    $("#cestadiv").append(
        '<div class="divrow">'+
        '    <div class="divcell"></div>'+
        '    <div class="divcell"></div>'+
        '    <div class="divcell">Total</div>'+
        '    <div id="priceTotal" class="divcell align-right"><strong><?= $user->price_simbol ?> '+ priceTotal.toFixed(2) +'</strong></div>'+
        '</div>');
}

$('.rolar').on('click', function(event) {

    <?php if(isset($home) && $home === true): ?>
        event.preventDefault();
    <?php endif ?>

    var target = $('#' + $(this).data('destino'));

    if( target.length ) {

        $('html, body').animate({
            scrollTop: target.offset().top - 8
        }, 1000, 'swing');
    }

});

</script>
    </body>
</html>
