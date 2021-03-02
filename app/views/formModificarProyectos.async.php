<div class="form-modificar-proyectos cntFormPrincl cntGrd">
	<h2>Modificar un desafío</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="proyecto-nombre" name="proyecto-nombre" data-name="Nombre:" maxlength="80" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{1,80}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_proyecto ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" value="<?= $nombre_ciclo_escolar ?>" data-name="Ciclo escolar:" data-validate="none" data-label="Incorecto" data-require="false" disabled="diabled" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="proyecto-fechaInicioInscripcion" name="proyecto-fechaInicioInscripcion" data-name="Inicio de convocatoria:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_inicio_inscripcion ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="proyecto-fechaFinInscripcion" name="proyecto-fechaFinInscripcion" data-name="Fin de convocatoria:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_fin_inscripcion ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="proyecto-fechaInicio" name="proyecto-fechaInicio" data-name="Fecha de inicio:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_inicio ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="text" id="proyecto-fechaFin" name="proyecto-fechaFin" data-name="Fecha de fin:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_fin ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<div class="mt-form">
			<select class="mlt" id="slct-alianzas" data-label="Campo requerido" data-require="false" data-name="Alianzas:" data-optionsSelected='<?= $alianzas_seleccionadas ?>'>
				<?= $selectAlianza ?>
			</select>
		</div>
		<p>Seleccione qué grados van a participar en el desafío</p>
		<?= $checkboxGrados ?>
		<textarea name="proyecto-descripcion" id="proyecto-descripcion" data-name="Descripción:" maxlength="500" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= $descripcion ?></textarea>
		<div class="mt-form">
            <input type="file" id="proyecto-imagen" data-button="Imagen" data-name="Imagen del desafío:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen_portada ?>" data-color="<?= $color ?>" />
		</div>
		<?= $renovar_proyecto ?>
		<div class="form-buttons">
			<div class="mt-button btnCancelProyecto">Regresar</div>
			<div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateProyecto" data-proyecto="<?= $id_proyecto ?>" >Modificar</div>
		</div>
	</div>
</div>