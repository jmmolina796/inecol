<div class="form-consultar-capacitacion cntFormPrincl">
	<h2>Consultar una capacitación</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="capacitacion-nombre" name="capacitacion-nombre" data-name="Nombre:" maxlength="70" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" value="<?= $nombre_capacitacion ?>" disabled />
        <select class="sgl" id="slct-proyectos" name="slct-proyectos" data-label="Campo requerido" data-require="true" data-name="Desafío:" disabled>
            <?= $selectProyectos ?>
        </select>
		<div class="mt-form">
			<textarea name="capacitacion-descripcion" id="capacitacion-descripcion" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" disabled><?= $descripcion_capacitacion ?></textarea>
		</div>
        <div class="tr-sessions">
            <?= $capSesiones ?>
        </div>
		<div class="form-buttons">
			<div class="mt-button btnCancelCapacitacion">Regresar</div>
		</div>
	</div>
</div>