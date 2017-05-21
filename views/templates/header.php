<!DOCTYPE html>

<html>

    <head>

        <link href="<?= URL; ?>public/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= URL; ?>public/css/bootstrap-theme.min.css" rel="stylesheet"/>
        <link href="<?= URL; ?>public/css/styles.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="http://s3.amazonaws.com/codecademy-content/courses/hour-of-code/js/alphabet.js"></script>
        
        <?php if (isset($title)): ?>
            <title>C$50 Finance: <?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Iaroslav's Stock app</title>
        <?php endif ?>

    </head>

    <body>

        <div class="container">

            <div id="top">
                	<canvas id="myCanvas"></canvas>
                        <script type="text/javascript" src="<?= URL; ?>public/js/bubbles.js"></script>
                        <script type="text/javascript" src="<?= URL; ?>public/js/logo.js"></script>
            </div>
	    
            <div id="middle">
                <?php if(Session::get('logged_in') === TRUE) : ?>
                <ul class="nav nav-pills nav-justified nav-stacked">
                        <li><a href="<?= URL; ?>portfolio/index">Portfolio</a></li>
                        <li><a href="<?= URL; ?>stock/quote">Quote</a></li>
                        <li><a href="<?= URL; ?>stock/get_buy">Buy</a></li>
                        <li><a href="<?= URL; ?>stock/get_sell">Sell</a></li>
                        <li><a href="<?= URL; ?>stock/history">History</a></li>
			<li><a href="<?= URL; ?>index/logout"><strong>Log Out</strong></a></li>
                </ul>
                <?php endif; ?>
                <br><br><br>
                