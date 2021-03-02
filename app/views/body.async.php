<body>
	<div id="load-bar">
		<div class="bar"></div>
		<div class="bar"></div>
		<div class="bar"></div>
	</div>
	<div id="wrapper" class="<?= setClassPrincipal() ?>">
		<div class="message-alert">
			<div class="bodyMessage">
				<div class="content"></div>
			</div>
			<!-- <span class="close-message">X</span> -->
		</div>
		<div class="alert-modal">
			<div class="contentAlert">
				<div class="headerAlert">
					<h4></h4>
				</div>
				<div class="bodyAlert"></div>
				<div class="buttonsAlert two-btn">
					<div class="mt-button-orange btnAlertCancelar"></div>
					<div class="mt-button-blue btnAlertAceptar"></div>
				</div>
			</div>
		</div>
		<div class="window-modal">
			<?php load("loader","modal"); ?>
			<div class="helpMessage">Cancelar acción</div>
		</div>
		<?php load("loader","principal"); ?>
		<div class="menu-btn btnMnStyl">
			<span></span>
		</div>
		<div class="search-principal sp-body btnMnStyl">
			<span></span>
		</div>
		<?php load("botonMiCuenta"); ?>
		<div id="main">
			<?php load("loader","content"); ?>
			<?php controller(); ?>
		</div>
	</div>

	<?php
		/*
		<script src="<?= URL_SERVER ?>public/js/table/table-bt.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/data-picker.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/material.datepicker.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/jquery.qrcode.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/velocity.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/velocity.ui.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/jquery.mobile-events.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/autosize.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/materialValidation.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/color-thief.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/download.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/images-loaded.js" type="text/javascript"></script>

		<script src="<?= URL_SERVER ?>public/js/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/scripts.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/script.js"></script>
		<script src="<?= URL_SERVER ?>public/js/parallax.min.js" type="text/javascript"></script>
		<script src="<?= URL_SERVER ?>public/js/prefixfree.min.js" type="text/javascript"></script>

		<script src="<?= URL_SERVER ?>public/js/socketsClient.js"></script>
		*/
	?>

	<script src="<?= URL_SERVER ?>client/built/index.js"></script>

</body>