<div class="form-registrar-modulos cntFormPrincl cntGrd">
	<h2>Registrar un módulo</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="modulo-nombre" name="modulo-nombre" data-name="Nombre:" maxlength="80" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{1,80}$/" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<p>Seleccione qué grados contiene el módulo</p>
		<?= $checkboxGrados ?>
		<textarea name="modulo-descripcion" id="modulo-descripcion" data-name="Descripción:" maxlength="500" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
		<div class="mt-form">
			<input type="file" id="modulo-imagen" data-button="Imagen" data-name="Imagen del módulo:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" />
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelModulo">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnCreateModulo">Registrar</div>
		</div>
	</div>
</div>