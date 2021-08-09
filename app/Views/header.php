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
        <link rel="stylesheet" href="<?php echo site_url('assets/css/main.css') ?>" />
        <!-- <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css') ?>" /> -->
        <link rel="stylesheet" href="<?php echo site_url('assets/fontawesome/css/all.min.css') ?>" />
        <noscript><link rel="stylesheet" href="<?php echo site_url('assets/css/noscript.css') ?>" /></noscript>
        <script type="text/javascript" src="<?= site_url('assets/js/jquery.min.js') ?>"></script>
        <!-- <script type="text/javascript" src="<?= site_url('assets/js/bootstrap.min.js') ?>"></script> -->
        <script type="text/javascript" src="<?= site_url('assets/fontawesome/js/all.min.js') ?>"></script>
    </head>
    <body class="is-preload">
        <div style="position: fixed; right: 250px; top:20px; z-index: 1;">
            <?php if($loginsession ?? false): ?>
                <a href="<?= site_url('login/sair')?>"><span class="fas fa-user text-success"></span></a>
                <a href="<?= site_url('pedidos')?>"><span class="fas fa-box"></span></a>
            <?php else: ?>
                <a href="<?= site_url('login')?>"><span class="fas fa-user text-info"></span></a>
            <?php endif ?>
        </div>
        <div style="position: fixed; right: 50px; top:20px; z-index: 1;">
            <a href="<?= site_url('cesta') ?>">
                <img src="<?= site_url('assets/images/cesta.svg') ?>" style="width: 48px; opacity: 0.8;">
                <div id="cesta" style="position: absolute; right: 14px; top:-15px;font-size: 2em; font-weight: 600; color: #A8AAFB;"></div>
            </a>
        </div>
        <div id="cestaAlert" class="alert" style="display:none">
            <span id="cestaAlertIcon"><i class="fas fa-times text-danger"></i></span>
            <span id="cestaAlertText"></span>
        </div>