<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorMisModulos cntFormPrincl">
		<h2>Mis módulos</h2>
		<div id="contenedorSelectsFiltros">
			<div class="mt-principal mt-form mt-no-validate marg-one">
        		<select class="sgl" id="slCicloEscolarMod" data-label="Campo requerido" data-require="true" name="slCicloEscolarMod" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
		</div>
		<div class="filtroModulosAux fltrMrRsltAux">
			<?php load("loader","fltrMrRsltAux","false"); ?>
			<div class="contenedorModulos cntPtdMuro <?= $modulosCss ?>">
				<section class="modulos">
					<?= $contenidoModulosDocente ?> 
				</section>
				<div class="sin-resultados">No se encontraron módulos.</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>