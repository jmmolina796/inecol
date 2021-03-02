<div class="form-modificar-ciclosEscolares cntFormPrincl cntNtClEs">
	<h2>Modificar Ciclos Escolares</h2>
	<div class="nota-cicloEscolar">
		<h4>Los ciclos escolares registrados forman parte de los 3 niveles educativos (preescolar, primaria y secundaria).</h4>
	</div>
	<div class="mt-form mt-principal form-ciclos">
       	<input type="text" id="ciclo-nombre" name="nombre"  data-name="Ciclo Escolar:"  maxlength="100" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ0-9\_\.\-\s]{1,100}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_ciclo_escolar ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
		<input type="text" id="ciclo-fechaInicio" name="fecha_inicio" data-name="Fecha de Inicio:"  data-validate="empty-10"  data-label="Campo requerido"   data-require="true" value="<?= $fecha_inicio_ciclo_escolar ?>" data-date="true">
		<input type="text" id="ciclo-fechaFin" name="fecha_fin" data-name="Fecha de Fin:"  data-validate="empty-10"   data-label="Campo requerido" data-require="true" value="<?= $fecha_fin_ciclo_escolar ?>" data-date="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<input type="hidden" id="id-ciclo" name="id_ciclo" data-name="ciclo:" data-validate="none"   data-require="true" value="<?= $id_ciclo_escolar ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
		<div class="form-buttons">
			<div  class="mt-button btnCancelCiclos">Regresar</div>
			<div data-check="div.mt-principal" class="mt-button mt-button-blue btnModificarCiclos">Modificar</div>
		</div>
	</div>
</div>