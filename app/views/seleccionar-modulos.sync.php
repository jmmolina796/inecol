<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorModulosDisponibles cntFormPrincl">
		<h2>Todos los módulos</h2>
		<p>Selecciona los módulos en los que quieres compartir tu experiencia.</p>
		<div id='contenedorBusquedasMod'>
			<div class="mt-form mt-principal marg-one">
				<input type="text" id="btnBuscarNameModulo" data-name="Buscar nombre módulo:" maxlength="40" data-validate="none" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			</div>
		</div>
		<div class="filtroModulosAux fltrMrRsltAux">
			<?php load("loader","fltrMrRsltAux","false"); ?>
			<div class="contenedorModulos cntPtdMuro <?= $modulosCss ?>">
				<section class="modulos">
					<?= $contenidoPosts ?>
				</section>
				<div class="sin-resultados">No se encontraron módulos.</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>