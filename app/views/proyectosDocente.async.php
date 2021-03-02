<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorMisProyectos cntFormPrincl">
		<h2>Mis proyectos</h2>
		<div id="contenedorSelectsFiltros">
			<div class="mt-principal mt-form mt-no-validate marg-one">
        		<!--<select class="sgl" id="slEstadosProyecto" data-label="Campo requerido" name="slEstadosProyecto" data-name="Estados de proyecto:">
					<option value="none" disabled="disabled" >Selecciona el estado:</option>
					<option value='1' selected="selected">Activo</option>
					<option value='2' >Finalizado</option>
					<option value='3' >Pendiente</option>
				</select>-->
        		<select class="sgl" id="slCicloEscolarProyec" data-label="Campo requerido" data-require="true" name="slCicloEscolar" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
		</div>
		<div class="filtroProyectosAux fltrMrRsltAux">
			<?php load("loader","fltrMrRsltAux","false"); ?>
			<div class="contenedorProyectos cntPtdMuro <?= $proyectosCss ?>">
				<section class="proyectos">
					<?= $contenidoProyectosDocente ?> 
				</section>
				<div class="sin-resultados">No se encontraron proyectos.</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>