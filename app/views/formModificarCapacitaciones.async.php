<div class="form-modificar-capacitacion cntFormPrincl">
	<h2>Modificar una capacitación</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="capacitacion-nombre" name="capacitacion-nombre" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" value="<?= $nombre_capacitacion ?>" />
        <select class="sgl" id="slct-proyectos" name="slct-proyectos" data-label="Campo requerido" data-require="true" data-name="Desafío:">
            <?= $selectProyectos ?>
        </select>
		<div class="mt-form">
			<textarea name="capacitacion-descripcion" id="capacitacion-descripcion" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= $descripcion_capacitacion ?></textarea>
		</div>
        <div class="tr-sessions">
            <?= $capSesiones ?>
        </div>
		<div class="form-buttons">
			<div class="mt-button btnCancelCapacitacion">Cancelar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateCapacitacion" data-capacitacion="<?= $id_capacitacion ?>">Modificar</div>
		</div>
	</div>
</div>