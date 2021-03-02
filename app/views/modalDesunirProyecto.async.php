<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-desunir-proyecto">
			<h2>Mensaje:</h2>
			<p><?= $mensaje ?></p>
			<div class="mt-form form-text">
				<input type="password" id="claveUsuario" name="claveUsuario" data-name="Contraseña:" data-validate="empty-4" data-label="Incorrecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			</div>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button-red" data-check="div.form-desunir-proyecto" id="btnDesunirProyecto"><?= $boton ?></div>
			</div>
		</div>
	</div>
</div>
