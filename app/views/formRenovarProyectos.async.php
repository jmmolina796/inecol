<div class="form-registrar-proyectos cntFormPrincl cntGrd">
	<h2>Renovar proyecto</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="proyecto-nombre" class="disabled" name="proyecto-nombre" data-name="Nombre:" maxlength="80" data-validate="/^[\s\S]{1,80}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_proyecto ?>" readonly>
		<input type="text" value="<?= $nombre_ciclo_escolar ?>" data-name="Ciclo escolar:" data-validate="none" data-label="Incorecto" data-require="false" disabled>
		<input type="text" id="proyecto-fechaInicioInscripcion" name="proyecto-fechaInicioInscripcion" data-name="Inicio de convocatoria:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_inicio_inscripcion ?>">
		<input type="text" id="proyecto-fechaFinInscripcion" name="proyecto-fechaFinInscripcion" data-name="Fin de convocatoria:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_fin_inscripcion ?>">
		<input type="text" id="proyecto-fechaInicio" name="proyecto-fechaInicio" data-name="Fecha de inicio:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_inicio ?>">
		<input type="text" id="proyecto-fechaFin" name="proyecto-fechaFin" data-name="Fecha de fin:" data-validate="empty-10" data-label="Campo requerido" data-require="true" data-date="true" value="<?= $fecha_fin ?>">
		<div class="mt-form">
			<select class="mlt" id="slct-alianzas" data-label="Campo requerido" data-require="false" data-name="Alianzas:" data-optionsSelected='<?= $alianzas_seleccionadas ?>'>
				<?= $selectAlianza ?>
			</select>
		</div>
		<p>Seleccione qué grados van a participar en el proyecto</p>
		<?= $checkboxGrados ?>
		<textarea name="proyecto-descripcion" class="disabled" id="proyecto-descripcion" data-name="Descripción:" maxlength="500" data-label="Campo requerido" data-require="true" readonly><?= $descripcion ?></textarea>
		<div class="mt-form">
            <input type="file" id="proyecto-imagen" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen_portada ?>" data-color="<?= $color ?>" />
		</div>
		<div class="form-buttons">
			<div class="mt-button btnCancelProyecto">Regresar</div>
			<div class="mt-button" data-check="div.mt-principal" id="btnRenovarProyecto" data-proyecto="<?= $id_proyecto ?>" >Renovar</div>
		</div>
	</div>
</div>