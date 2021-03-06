<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
        <?php if ($title): ?>
            <?php echo $title.' - '; ?>
        <?php endif ?>
        Le Mero Pièces Auto
        </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="<?php echo site_url("assets/img/apple-touch-icon.png"); ?>">
        <!-- Place favicon.ico in the root directory -->
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">

		<?php foreach($css_files as $file): ?>
			<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
		<?php endforeach; ?>
        <link rel="stylesheet" href="<?php echo site_url("assets/css/normalize.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/main.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/bootstrap.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/chosen/chosen.min.css"); ?>">
        <link rel="stylesheet" href="<?php echo site_url("assets/css/fancybox/jquery.fancybox.css?v=2.1.5"); ?>">

        <link rel="stylesheet" href="<?php echo site_url("assets/css/styles.css"); ?>">
        <link href='http://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
        <script src="<?php echo site_url("assets/js/vendor/modernizr-2.8.3.min.js"); ?>"></script>
        <meta name="google-site-verification" content="9wnzyJol-p_Bi0t0h2hp0GMDrPHL1glMXMQvv3BDpXc" />

    </head>
    <body>
    <script type="text/javascript">
        var mainUrl = '<?php echo site_url(); ?>';
    </script>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
<div class="wrapper">
	<div class="container-fluid" id="mainContainer">
		<div class="page-header">
			<h1><a href="<?php echo site_url(''); ?>">Le&nbsp;Mero Pieces auto</a></h1>
            <div class="subheader">Stock de pièces automobiles occasions et neuves pour voitures américaines et françaises.</div>
		</div>
        <div class="row">
            <div class="col-md-12 bigger">Les pièces sont classées par année, ensuite par modèle, puis par type de pièce disponible: <strong>stock remis à jour régulièrement</strong><br/>
            Tout n'est pas listé, <a href="mailto:contact@lemero.fr">contactez-moi</a>.</div>
        </div>
