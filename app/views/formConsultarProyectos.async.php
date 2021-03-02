<div class="form-consultar-proyectos cntFormPrincl cntRdImg cntGrd">
	<h2>Consultar un desafío</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="proyecto-nombre" name="proyecto-nombre" data-name="Nombre:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $nombre_proyecto ?>">
		<input type="text" value="<?= $nombre_ciclo_escolar ?>" data-name="Ciclo escolar:" data-validate="none" data-label="Incorecto" data-require="false" disabled="diabled">
		<input type="text" id="proyecto-fechaInicioInscripcion" name="proyecto-fechaInicioInscripcion" data-name="Inicio de convocatoria:" disabled="disabled" data-validate="none" data-label="Incorrecto" data-require="false" data-date="true" value="<?= $fecha_inicio_inscripcion ?>">
		<input type="text" id="proyecto-fechaFinInscripcion" name="proyecto-fechaFinInscripcion" data-name="Fin de convocatoria:" disabled="disabled" data-validate="none" data-label="Incorrecto" data-require="false" data-date="true" value="<?= $fecha_fin_inscripcion ?>">
		<input type="text" id="proyecto-fechaInicio" name="proyecto-fechaInicio" data-name="Fecha de inicio:" disabled="disabled" data-validate="none" data-label="Incorrecto" data-require="false" data-date="true" value="<?= $fecha_inicio ?>">
		<input type="text" id="proyecto-fechaFin" name="proyecto-fechaFin" data-name="Fecha de fin:" disabled="disabled" data-validate="none" data-label="Incorrecto" data-require="false" data-date="true" value="<?= $fecha_fin ?>">
		<div class="mt-form">
			<select class="mlt" id="slct-alianzas" data-label="Campo requerido" data-require="false" data-name="Alianzas:" disabled="disabled" data-optionsSelected='<?= $alianzas_seleccionadas ?>'>
				<?= $selectAlianzas ?>
			</select>
		</div>
		<p>Seleccione qué grados van a participar en el desafío</p>
		<?= $checkboxGrados ?>
		<textarea name="proyecto-descripcion" id="proyecto-descripcion" data-name="Descripción:" disabled="disabled" data-label="Campo requerido" data-require="false"><?= $descripcion ?></textarea>
		<div class="mt-form">
			<div class="fotoPerfilConsultar">
                <p>Imagen del desafío</p>
                <img src='<?= URL_SERVER.URL_PRO_IMG.$imagen_portada ?>'>
            </div>
		</div>
		<div class="mt-button btnCancelProyecto">Regresar</div>
	</div>
</div>