<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorVerModulo cntVrPtdMuro">
		<div class="headerModulo hdrPtdMurp">
			<h2>
				<?= $nombre_modulo ?>
			</h2>
			<div class="backgroundModulo bckPtdMuro">
				<div id="bckPtdMuro-img" class="imgModulo imgPtdMuro" style="background-image:url(<?= URL_SERVER.URL_MOD_IMG.$imagen_portada ?>)" data-color="<?= $color ?>">
				</div>
			</div>
		</div>
		<section class="informacionCompletaModulo infCmpPtdMuro">
			<h2>Información</h2>
			<div class="infoP">
				<h3>Descripción</h3>
				<p><?= $descripcion ?></p>
				<h3>Guías de apoyo</h3>
				<p class="goToUrl">
					<a href="<?= URL_SERVER."descargar-modulos" ?>">Descargar guías</a>
				</p>
			</div>
		</section>
		<section class="docentesRelacionados">
			<?php load("loader","docModules","false"); ?>
			<h2>Docentes participando</h2>
			<div class="mt-principal mt-form mt-no-validate">
				<?= $selectCiclosEscolares ?>
			</div>
			<div class="docentes-relacionados-modulos docRelMuro">
				<?= $contentDocentesRelacionados ?>
			</div>
			<div class="modulo-docente-relacionado-info pageSecCnt"></div>
		</section>
	</div>
</div>
<?php load("footer") ?>