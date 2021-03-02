<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="form-ingresar-llave cntFormPrincl">
		<h2>Escribe la llave de confirmación</h2>
		<div class="mt-form mt-principal">
			<input type="password" id="ingresar-llave" data-name="Llave:" data-validate="empty-5" data-label="Incorecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<div class="mt-form">
				<div class="mt-button" data-check="div.mt-principal" id="btnIngresarLlave">Ingresar</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>