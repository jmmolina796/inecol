<div class="form-consultar-ciclosEscolares cntFormPrincl cntNtClEs">
	<h2>Consultar Ciclos Escolares</h2>
	<div class="nota-cicloEscolar">
		<h4>Los ciclos escolares registrados forman parte de los 3 niveles educativos (preescolar, primaria y secundaria).</h4>
	</div>
	<div class="mt-form mt-principal form-ciclos">
        <input type="text" id="ciclo-nombre" name="nombre"  data-name="Ciclo Escolar:" disabled="disabled" data-validate="none" data-label="Incorecto" data-require="false" value="<?= $nombre_ciclo_escolar ?>" >
		<input type="text" id="ciclo-fechaInicio" name="fecha_inicio" data-name="Fecha de Inicio:" disabled="disabled" data-validate="none"  data-label="Incorecto" data-require="false" value="<?= $fecha_inicio_ciclo_escolar ?>" >
		<input type="text" id="ciclo-fechaFin" name="fecha_fin" data-name="Fecha de Fin:"  data-validate="none"  disabled="disabled" data-label="Incorecto" data-require="false" value="<?= $fecha_fin_ciclo_escolar ?>" >
		<div class="mt-form">
			<div class="mt-button btnCancelCiclos">Regresar</div>
		</div>
	</div>
</div>