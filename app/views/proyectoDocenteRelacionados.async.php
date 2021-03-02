<?php load("loader","modal"); ?>
<div class="helpMessage">Cancelar acción</div>
<div class="content-modal content-proyecto-docente-info">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal body-proyecto-docente-info">
		<div class="proyecto-docente-relacionado-info pageSecCnt"></div>
		<div class="modal-proyecto-docente-relacionados">
			<h3 class="title">Docentes participando en este proyecto:</h3>
			<div class="mt-principal mt-form mt-no-validate">
				<select class="sgl" id="slCicloEscolarProyectosPub" data-label="Campo requerido" data-require="true" name="slCicloEscolar" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
			<div class="docRelMuro docRelMdlMuro docentes-relacionados-proyectos">
				<?= $docentesRelacionados ?>
			</div>
		</div>
	</div>
</div>