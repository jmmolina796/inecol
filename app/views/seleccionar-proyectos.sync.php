<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorProyectosDisponibles cntFormPrincl">
		<h2>Proyectos disponibles</h2>
		<div id='contenedorBusquedas'>
			<div class="mt-form mt-principal marg-one">
				<input type="text" id="btnBuscarNameProyecto" data-name="Buscar nombre proyecto:" maxlength="40" data-validate="none" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			</div>
		</div>
		<div class="filtroProyectosAux fltrMrRsltAux">
			<?php load("loader","fltrMrRsltAux","false"); ?>
			<div class="contenedorProyectos cntPtdMuro <?= $proyectosCss ?>">
				<section class="proyectos">
					<?= $contenidoPosts ?>
				</section>
				<div class="sin-resultados">No se encontraron proyectos.</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>