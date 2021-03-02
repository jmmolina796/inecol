<div class="form-consultar-alianza cntFormPrincl">
	<h2>Consultar una alianza</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="alianza-nombre" name="nombre" data-name="Nombre:"  disabled="disabled" data-validate="none" data-require="false" value="<?= $nombre ?>">
		<div class="mt-form">
			<textarea name="proyecto-descripcion" id="proyecto-descripcion" data-name="Descripción:" disabled="disabled" data-label="Campo requerido" data-require="false"><?= $descripcion ?></textarea>
		</div>
		<div class="mt-button btnCancelAlianza">Regresar</div>
</div>