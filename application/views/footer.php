	</div>
	<div class="push"></div>
</div>

<footer>
	<div class="row">
        <div class="col-xs-3 col-xs-offset-1">
            Contact:
            <ul>
                <li><a href="tel:06060606">06&nbsp;06&nbsp;06&nbsp;06</a></li>
                <li><a href="mailto:bob@fneu.com">mail@mail.com</a></li>
            </ul>
        </div>
        <div class="col-xs-3 col-xs-offset-1">
            Information entreprise:
            <ul>
                <li>Siret: 0602742543</li>
                <li>3 rue des trois rues</li>
            </ul>
        </div>
        <div class="col-xs-3 col-xs-offset-1">
            Réalisé par:
            <ul>
                <li><a href="http://www.stadja.net" target="_blank">stadja.net</a></li>
            </ul>
        </div>
    </div>
</footer>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo site_url("assets/js/vendor/jquery-1.11.2.min.js"); ?>"><\/script>')</script>
        <script src="<?php echo site_url("assets/js/vendor/bootstrap.min.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/vendor/chosen.min.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/vendor/jquery.fancybox.pack.js?v=2.1.5"); ?>"></script>

        <script src="<?php echo site_url("assets/js/plugins.js"); ?>"></script>
        <script src="<?php echo site_url("assets/js/main.js"); ?>"></script>
		<?php foreach($js_files as $file): ?>
			<script src="<?php echo $file; ?>"></script>
		<?php endforeach; ?>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
    </body>
</html>