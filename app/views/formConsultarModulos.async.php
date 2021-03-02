<div class="form-consultar-modulos cntFormPrincl cntRdImg cntGrd">
	<h2>Consultar un módulo</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="modulo-nombre" name="modulo-nombre" data-name="Nombre:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $nombre_modulo ?>">
		<p>Grados que contiene el módulo</p>
		<?= $checkboxGrados ?>
		<textarea name="modulo-descripcion" id="modulo-descripcion" data-name="Descripción:" disabled="disabled" data-label="Campo requerido" data-require="false"><?= $descripcion ?></textarea>
		<div class="mt-form">
			<div class="fotoPerfilConsultar">
                <p>Imagen de portada</p>
                <img src='<?= URL_SERVER.URL_MOD_IMG.$imagen_portada ?>'>
            </div>
		</div>
		<div class="mt-button btnCancelModulo">Regresar</div>
	</div>
</div>