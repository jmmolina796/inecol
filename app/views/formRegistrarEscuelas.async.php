<div class="form-registrar-escuela cntFormPrincl">
	<h2>Registrar una escuela</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="escuela-clave" name="escuela-clave" data-name="Clave de la escuela:" maxlength="15" data-validate="/^[a-zA-Z0-9]{1,15}$/" data-label="Se requiere solo letras o números" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="escuela-nombre" name="escuela-nombre" data-name="Nombre:" maxlength="100" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ.,\s]{1,100}$/" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<div class="mt-form">
			<select class="sgl" id="escuela-nivelE" name="escuela-nivelE" data-label="Campo requerido" data-require="true" data-name="Nivel educativo:">
				<?= $selectNivel ?>
			</select>
			<select class="sgl" id="escuela-entidad" name="escuela-entidad" data-label="Campo requerido" data-require="true" data-name="Entidad Federativa:">
				<?= $selectEntidad ?>
			</select>
			<select class="sgl" id="escuela-municipio" name="escuela-municipio" data-label="Campo requerido" data-require="true" disabled="disabled" data-name="Municipio:">
				<option value="none" disabled="disabled" selected="selected">Selecciona el municipio:</option>
			</select>
			<input type="text" id="escuela-localidad" name="escuela-localidad" data-name="Localidad:" maxlength="100" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ.,\s]{1,100}$/" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelEscuelas">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnCreateEscuela">Registrar</div>
		</div>
	</div>
</div>