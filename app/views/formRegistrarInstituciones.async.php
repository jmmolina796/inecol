<div class="form-registrar-institucion cntFormPrincl">
	<h2>Registrar una institución</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="institucion-nombre" name="nombre" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<div class="mt-form">
			<textarea name="institucion-descripcion" id="institucion-descripcion" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelInstitucion">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnCreateInstitucion">Registrar</div>
		</div>
	</div>
</div>