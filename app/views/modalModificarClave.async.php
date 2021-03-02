<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal body-cambiar-clave">
		<div class="form-cambiar-clave">
			<h2>Cambiar mi contraseña:</h2>
			<p class="modal-error"></p>
			<div class="mt-form form-text">
				<input type="password" id="claveActual" name="claveActual" data-name="Contraseña actual:" data-validate="empty-4" data-label="Incorrecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<input type="password" id="claveNueva" name="claveNueva" autocorrect="off" autocapitalize="off" data-name="Nueva contraseña:" data-validate="empty-4" data-label="Incorecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<input type="password" id="claveNueva2" name="claveNueva2" autocorrect="off" autocapitalize="off" data-name="Confirma nueva contraseña:" data-validate="empty-4" data-label="Incorecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			</div>
			<div class="mt-form modal-buttons">
				<div class="mt-button-orange cancelarModal">Cancelar</div>
				<div class="mt-button-blue" data-check="div.form-cambiar-clave" id="modificarClaveUsuario">Guardar</div>
			</div>
		</div>	
	</div>
</div>