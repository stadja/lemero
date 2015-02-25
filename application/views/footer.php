	</div>
	<div class="push"></div>
</div>

<footer>
	bim bam boum
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