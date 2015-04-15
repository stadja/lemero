	</div>
	<div class="push"></div>
</div>

<footer>
	<div class="bigger">
        <div class="col-xs-3 col-xs-offset-1">
            Contact:
            <ul>
                <li><a href="tel:+33658013367">06&nbsp;58&nbsp;01&nbsp;33&nbsp;67</a></li>
                <li><a href="mailto:bob@fneu.com">contact@lemero.fr</a></li>
            </ul>
        </div>
        <div class="col-xs-3 col-xs-offset-1">
            Information entreprise:
            <ul>
                <li>Siret: 339&nbsp;338&nbsp;543</li>
                <li><a href="https://www.google.fr/maps/place/68+Rue+Jules+Steeg,+33500+Libourne/@44.9199576,-0.2371305,17z/data=!3m1!4b1!4m7!1m4!3m3!1s0xd55495bdc8c3b87:0x23ce3853e9e6eed5!2s68+Rue+Jules+Steeg,+33500+Libourne!3b1!3m1!1s0xd55495bdc8c3b87:0x23ce3853e9e6eed5" target="_blank">68&nbsp;rue&nbsp;Jules&nbsp;Steeg, 33500&nbsp;Libourne</a></li>
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

    </body>
</html>