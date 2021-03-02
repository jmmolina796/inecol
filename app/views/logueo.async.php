<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
	<div class='form-recuperar-password'></div>
		<div class="form-logueo">
			<h2>Iniciar sesión</h2>
			<p class="modal-error"></p>
			<div class="mt-form form-text">
				<input type="text" id="logueoUsuario" name="logueoUsuario" data-name="Usuario o correo:" data-validate="/^[a-z\d!·,.@_$%&/()'+*-]{3,40}$/i" data-label="De 3 a 40 caracteres" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
				<input type="password" id="logueoPassword" name="logueoPassword" data-name="Contraseña:" data-validate="empty-4" data-label="Incorecto" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			</div>
			<div class="mt-form modal-buttons">
				<div class="mt-button-orange cancelarModal">Cancelar</div>
				<div class="mt-button-blue" data-check="div.form-logueo" id="logueoUsuarios">Ingresar</div>
			</div>
			<p class="fPassword" >¿Olvidaste la contraseña?</p>
		</div>	
	</div>
</div>