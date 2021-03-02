<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorVerProyecto cntVrPtdMuro">
		<div class="headerProyecto hdrPtdMurp">
			<h2>
				Fairchild Challenge
			</h2>
			<div class="backgroundProyecto bckPtdMuro">
				<div id="bckPtdMuro-img" class="imgProyecto imgPtdMuro" style="background-image:url(<?= URL_SERVER.URL_PRO_IMG.$imagen_portada ?>)" data-color="<?= $color ?>"></div>
			</div>
		</div>
		<section class="informacionCompletaProyecto infCmpPtdMuro">
			<?= $loader ?>
			<h2>Información</h2>
			<div class="infoP">
				<h3>Estado</h3>
				<p class="<?= $css_estado ?>"><?= $estado ?></p> 
			</div>
			<div class="infoP">
				<h3>Ciclo escolar</h3>
				<p><?= $nombre_ciclo_escolar ?></p>
			</div>
			<div class="infoP">
				<h3>Periodo de convocatoria</h3>
				<p>Del <?= $fecha_ini_ins_tex ?> al <?= $fecha_fin_ins_tex ?> </p>
			</div>
			<div class="infoP">
				<h3>Duración del proyecto</h3>
				<p>Del <?= $fecha_ini_tex ?> al <?= $fecha_fin_tex ?> </p>
			</div>
			<div class="infoP">
				<h3>Descripción</h3>
				<p><?= $descripcion ?></p>
			</div>
			<?= $botonUnirse ?>
		</section>
		<section class="docentesRelacionados">
			<?= $loader ?>
			<h2>Docentes participando</h2>
			<div class="mt-principal mt-form mt-no-validate">
				<select class="sgl" id="slCicloEscolarProyectos" data-label="Campo requerido" data-require="true" name="slCicloEscolar" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
			<div class="docentes-relacionados-proyectos docRelMuro">
			<?= $contentDocentesRelacionados ?>
			</div>
			<div class="proyecto-docente-relacionado-info pageSecCnt"></div>
		</section>
	</div>
</div>
<?php load("footer") ?>