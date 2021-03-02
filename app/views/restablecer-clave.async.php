<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div class="form-cambiar-password">
	<h2 style="width: 300px;margin: 40px auto">Elige una contraseña nueva</h2>
	<div class="mt-form mt-principal">
		<h3>Escribe una contraseña nueva que tenga entre 8 y 30 caracteres.</h3>
		<br><br>
		<input type="password" id="usuario-password" name="password" data-name="Contraseña:" maxlength="30" data-validate="/^[\s\S]{8,30}$/" data-label="Se requiere entre 8 y 30 caracteres" data-require="true">
		<br><br>
		<input type="password" id="usuario-passwordCon" data-name="Confirmar contraseña:"  maxlength="30" data-validate="/^[\s\S]{8,30}$/i" data-label="Solo entre 8 y 30 caracteres" data-require="true">
		<br><br>
		<div class="form-buttons">
			<div class="mt-button" data-check="div.mt-principal" id="btnCambiarContrasena">Cambiar contraseña</div>
		</div>
	</div>
</div>
<?php load("footer") ?>