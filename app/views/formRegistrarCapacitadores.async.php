<div class="form-registrar-capacitador cntFormPrincl cntGrd">
	<h2>Registrar un capacitador</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="capacitador-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" id="capacitador-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" id="capacitador-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" id="capacitador-correo" name="email"  data-name="Email:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="capacitador-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="password" id="capacitador-password" name="password" data-name="Contraseña:" maxlength="35" data-validate="/^[\s\S]{8,35}$/" data-label="Se requiere entre 8 y 35 caracteres" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="password" id="capacitador-passwordCon" data-name="Confirmar contraseña:"  maxlength="35" data-validate="/^[\s\S]{8,35}$/i" data-label="Solo entre 8 y 35 caracteres" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="capacitador-telefono" name="telefono" data-name="Número de teléfono:" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <select class="sgl" id="slct-instituciones" data-label="Campo requerido" data-require="false" data-name="Institución de procedencia:">
            <?= $selectInstituciones ?>
        </select>
        <select class="mlt" id="slct-cap-sesiones" data-label="Campo requerido" data-require="false" data-name="Sesiones de capacitación:">
            <?= $selectCapSesiones ?>
        </select>
		<div class="mt-form">
			<input type="file" id="capacitador-imagen" data-button="Imagen" data-name="Imagen de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" />
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelCapacitador">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnCreateCapacitador">Registrar</div>
		</div>
	</div>
</div>