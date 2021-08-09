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

        url : '<?= site_url('cesta/get/json') ?>',
        dataType:'json',
        beforeSend: function(){

        },
        success: function(retorno){
            $("#cesta").html(Object.keys(retorno).length);
            cestaMount(retorno);
            calcCesta(retorno);
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

$("#cestadiv").on('click', '.checkItemCesta', function(){
    setQuant(this);
});

$("#cestadiv").on('keypress', '.quantItemCesta', function(evt){
    console.log('quantItemCesta keypress', evt, $("#formCesta"));
    if(evt.which == 13){
        setQuant(this);
         $("#formCesta").submit(function(frmEvt){
            frmEvt.preventDefault();
         });
    }
});

function setQuant(este){
    var saida = false;

    var parent = $(este).parent('div');
    var itemId = parent.data('item');
    var input = parent.find('input');
    var quant = $("#quant"+itemId).val();
    var btnSent = $("#pedidoSave");
    var checkbox = $("#checkbox"+itemId).is(':checked');
    var row = $("#row-"+ itemId);
    btnSent.prop('disabled', true);

    parent.addClass('border-animate');

 // console.log('quant btnSent', btnSent);

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

    // if($(este).hasClass('quantItemCesta') && (quant < 1 || isNaN(quant) ) ){ 
    //     input.css('background-color', 'rgba(255, 121, 104, 0.7)');
    //     setTimeout(function(){
    //         input.css('background-color', '');
    //     }, 600)
    //     return false;
    // }

    $.ajax({
        async: false,
        url : '<?= site_url('cesta/setQuant/') ?>/'+ itemId +'/'+ quant+'/'+(checkbox?1:0),
        dataType:'json',
        beforeSend: function(){
            console.log(parent.find('svg'));
            parent.find('svg').css('display', 'initial');
            $("#priceTotal").parent('div').find('svg').css('visibility', 'initial');
            $("#priceTotalSelected").parent('div').find('svg').css('visibility', 'initial');

        },
        success: function(retorno){
            input.val(retorno.quant);

            row.addClass('ok');
            setTimeout(function(){
                row.removeClass('ok', '');
                countItens();
            }, 1600);

            parent.find('svg').css('display', 'none');
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



function cestaMount(CestaObj){
    var price,priceParce,quant;
    console.log('cestaMount');
    $("#cestadiv").html('');
    var $divTable = $('<div class="divtable divtable-full table-background">');
    var $form = $('<form id="formCesta" method="post" action="<?= site_url('pedidos/salvar') ?>"></form>');
    var $btnSent= $('<button type="button" id="pedidoSave"><?= lang("Site.basket.buttons.sent", [], $user->lang) ?></button>');
    var $cestaAlert = $("#cestaAlert").clone();
    // var $cestaAlert = $('<div id="cestaAlert">');
    $("#cestadiv").append($form);
    // console.log(Object.keys(CestaObj));
    if(Object.keys(CestaObj).length){
        for(let i in CestaObj){
            priceItem = 0;
            priceItens = null;
            // console.log(i);
            console.log(CestaObj[i]);

            // console.log('price_promo', (CestaObj[i].produto.price_promo));
            // console.log('price', CestaObj[i].produto.price);
            if(CestaObj[i].produto.price){
                priceItem = parseFloat(CestaObj[i].produto.price);
            }
            if(CestaObj[i].produto.price_promo){
                priceItem = parseFloat(CestaObj[i].produto.price_promo);
            }
            quant = CestaObj[i].quant;
            priceItens = priceItem && quant ?  priceItem * quant : 0;
            let checked = CestaObj[i].checked ? 'checked':'';
            $divTable.append(
            '<div class="divrow items background-transition" id="row-'+ CestaObj[i].produto.key +'">'+
            '    <div class="divcell">'+
            '      <div data-item="'+ CestaObj[i].produto.key +'">'+
            '        <img class="mini" src="<?= site_url('assets/images/produtos/') ?>'+ (CestaObj[i].produto.cover?CestaObj[i].produto.cover:'pic01.jpg') +'" alt="" data-position="center center" />'+
            '        <input '+checked+' type="checkbox" id="checkbox'+ CestaObj[i].produto.key +'" class="checkItemCesta" name="selectedItems[]" value="'+ CestaObj[i].produto.key +'" title="<?= lang("Site.form.selectItem", [], $user->lang) ?>" />'+
            '        <label for="checkbox'+ CestaObj[i].produto.key +'" title="<?= lang("Site.form.selectItem", [], $user->lang) ?>"><strong>'+ CestaObj[i].produto.title +'</strong> '+ CestaObj[i].produto.subtitle +'</label>'+
            '      </div>'+
            '    </div>'+
            '    <div class="divcell align-right"><?= $user->price_simbol ?> '+ (priceItem).toFixed(2) +'</div>'+
            '    <div class="divcell">'+
            '        <div class="btn-group" data-item="'+ CestaObj[i].produto.key +'">'+
            '            <button type="button" class="decreaseItemCesta" title="<?= lang("Site.basket.buttons.decrease", [], $user->lang) ?>" '+ (CestaObj[i].quant < 2 ? "disabled" :"") +'>-</button>'+
            '            <input id="quant'+ CestaObj[i].produto.key +'" type="text" class="quantItemCesta text-center" class="text-center"  value="'+ CestaObj[i].quant +'"  placeholder="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" title="<?= lang("Site.basket.buttons.quant", [], $user->lang) ?>" style="width:90px;")>'+
            '            <i class="fa fa-spinner fa-spin" style="display:none;"></i>'+
            '            <button type="button" class="increaseItemCesta" title="<?= lang("Site.basket.buttons.increase", [], $user->lang) ?>">+</button>'+
            '        </div>'+
            '    </div>'+
            '    <div class="divcell align-right">'+
            '        <?= $user->price_simbol ?> '+ priceItens.toFixed(2) +
            '    </div>'+
            '    <div class="divcell align-right">'+
            '        <button type="button" class="removeItem" data-item="'+ CestaObj[i].produto.key +'" title="<?= lang("Site.basket.buttons.remove", [], $user->lang) ?>"><i class="far fa-trash-alt"></i></button>'+
            '    </div>'+
            '</div>');
        }
        $form.append($divTable);
        $form.append(
            '<div class="align-rigth">'+
            ' <div class="divtable">'+
            '  <div class="divrow">'+
            '    <div class="divcell text-right"><?= lang("Site.basket.total", [], $user->lang) ?></div>'+
            '    <div class="divcell text-right">'+
            '      <i class="fa fa-spinner fa-spin" style="visibility:hidden;"></i>'+
            '      <input type="text" id="priceTotal" name="priceTotal" value="" style="text-align: right; background-color: rgba(0,0,0,0);" />'+
            '    </div>'+
            '  </div>'+
            '  <div class="divrow">'+
            '    <div class="divcell text-right"><?= lang("Site.basket.totalSelected", [], $user->lang) ?></div>'+
            '    <div class="divcell text-right">'+
            '      <i class="fa fa-spinner fa-spin" style="visibility:hidden;"></i>'+
            '      <input type="text" id="priceTotalSelected" name="priceTotalSelected" value="" style="text-align: right; background-color: rgba(0,0,0,0);" />'+
            '    </div>'+
            '  </div>'+
            ' </div>'+
            '</div>');

        $form
            .append( $btnSent)
            .append($cestaAlert)
    }
    $form.submit(function(e){
        console.log('form submit', e);
        // e.preventDefault();
    });

    $btnSent.click(function(){

        $btnSent.data('clicked', 1);
        if($(".checkItemCesta:checked").length){
            $form.submit();
        }else{
            $cestaAlert.find("#cestaAlertText").html('<?= lang("Site.basket.noSelected", [], $user->lang) ?>');
            $cestaAlert.addClass('alert-warning').show('slow');
        }

    });
    
}

function calcCesta(CestaObj){
    var price,priceParce, priceTotal=0,priceTotalSelected = 0,quant;
        console.log('calcCesta');
    for(i in CestaObj){
        console.log('item: ', CestaObj[i]);
        priceItem = 0;
        priceItens = null;
        if(CestaObj[i].produto.price){
            priceItem = parseFloat(CestaObj[i].produto.price);
        }
        if(CestaObj[i].produto.price_promo){
            priceItem = parseFloat(CestaObj[i].produto.price_promo);
        }
        quant = CestaObj[i].quant;
        priceItens = priceItem && quant ?  priceItem * quant : 0;
        if(priceItens){
          priceTotal += priceItens;
        // console.log('priceTotal :: ', priceTotal );
          if( CestaObj[i].checked )  priceTotalSelected += priceItens;
        }
        // console.log('calculo: ', priceItem +'*'+ quant );
        // console.log('=', priceItem * quant );
        // console.log('priceTotal: ', priceTotal );
        // console.log('priceTotalSelected: ', priceTotalSelected );
        $("#priceTotal").val(priceTotal.toFixed(2));
        $("#priceTotalSelected").val(priceTotalSelected.toFixed(2));
    }
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
