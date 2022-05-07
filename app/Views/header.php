<!DOCTYPE HTML>
<!--
    Hyperspace by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
    <head>
        <title>Estou bem aqui</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="<?= site_url('assets/css/main.css') ?>" />
        <link rel="stylesheet" href="<?= site_url('assets/fontawesome/css/all.min.css') ?>" />
        <link rel="stylesheet" href="<?= site_url('assets/css/vivify.css') ?>" />
        <noscript><link rel="stylesheet" href="<?= site_url('assets/css/noscript.css') ?>" /></noscript>
        <script type="text/javascript" src="<?= site_url('assets/js/jquery.min.js') ?>"></script>
        <script type="text/javascript" src="<?= site_url('assets/fontawesome/js/all.min.js') ?>"></script>
    </head>
    <body class="is-preload">
        <div id="header" >
            <nav>
                <ul>
                    <li>
                        <div style="position:relative;">
                            <img src="<?= site_url('assets/images/cesta.svg') ?>" style="width: 48px; opacity: 0.8;">

                            <a href="<?= site_url('cesta') ?>">
                                <span id="cesta" style="position: absolute; left: 50%;margin-left: -0.3em;top: 50%;margin-top: -1em;font-size: 2em; font-weight: 600; color: #A8AAFB;"></span>
                            </a>
                        </div>
                    </li>
                  <?php if($loginsession ?? false): ?>

                    <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fas fa-user text-success">
                      </button>
                      <div class="dropdown-menu">
                        <a href="<?= site_url('pedidos')?>" style="display: block;" title="<?= lang("Site.login.order.title", [], $user->lang); ?>"><span class="fas fa-box"></span> <?= lang("Site.login.order.text", [], $user->lang); ?></a>
                        <a href="<?= site_url('login/sair')?>" style="display: block;" title="<?= lang("Site.login.logout.title", [], $user->lang); ?>"><span class="fas fa-sign-out-alt"></span> <?= lang("Site.login.logout.text", [], $user->lang); ?></a>
                      </div>
                    </div>

                    
                  <?php else: ?>
                    <li><a href="<?= site_url('login?uri='. urlencode( uri_string() ) )?>" title="<?= lang("Site.login.join.title", [], $user->lang); ?>"><button class="button"><span class="fas fa-user text-default"></span> <?= lang("Site.login.join.text", [], $user->lang); ?></button></a></li>
                  <?php endif ?>
                </ul>
            </nav>
        </div>
        <div style="position: fixed; right: 50px; top:20px; z-index: 1;">

        </div>
        <div id="cestaAlert" class="alert" style="display:none">
            <span id="cestaAlertIcon"><i class="fas fa-times text-danger"></i></span>
            <span id="cestaAlertText"></span>
        </div>