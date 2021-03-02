<div class="form-modificar-modulos cntFormPrincl cntGrd">
	<h2>Modificar un módulo</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="modulo-nombre" name="modulo-nombre" data-name="Nombre:" maxlength="80" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{1,80}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_modulo ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<p>Seleccione qué grados contiene el módulo</p>
		<?= $checkboxGrados ?>
		<textarea name="modulo-descripcion" id="modulo-descripcion" data-name="Descripción:" maxlength="500" data-label="Campo requerido" data-require="true" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= $descripcion ?></textarea>
		<div class="mt-form">
            <input type="file" id="modulo-imagen" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen_portada ?>" data-color="<?= $color ?>" />
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelModulo">Regresar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateModulo" data-modulo="<?= $id_modulo ?>" >Modificar</div>
		</div>
	</div>
</div>