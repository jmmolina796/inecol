<?php load("loader","modal"); ?>
<div class="helpMessage">Cancelar acción</div>
<div class="content-modal content-proyecto-docente-info">
	<span class="cancelarModal closeButton"></span>
	<div class="body-modal body-proyecto-docente-info">
		<div class="proyecto-docente-relacionado-info pageSecCnt"></div>
		<h3 class="title">Docentes participando en este módulo:</h3>
		<div class="mt-principal mt-form mt-no-validate">
			<select class="sgl" id="slCicloEscolarPortadaModuloDocente" data-label="Campo requerido" data-require="true" name="slCicloEscolar" data-name="Ciclo Escolar:">
				<?= $selectCiclosEscolares ?>
			</select>
		</div>
		<div class="modal-proyecto-docente-relacionados">
			<div class="docentes-relacionados-proyectos docRelMuro">
				<?= $docentesRelacionados ?>
			</div>
		</div>
	</div>
</div>