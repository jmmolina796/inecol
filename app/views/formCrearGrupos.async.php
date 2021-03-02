<div class="form-modificar-alianza cntFormPrincl">
	<h2>Modificar una alianza</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="alianza-nombre" name="nombre" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<div class="mt-form">
			<textarea name="alianza-descripcion" id="alianza-descripcion" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= $descripcion ?></textarea>
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelAlianza">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateAlianza" data-alianza="<?= $id_alianza ?>">Modificar</div>
		</div>
	</div>
</div>