<?php load("loader","modal"); ?>
<div class="content-modal content-modal-info-muro">
	<div class="header">
		<span class="closeButton cancelarModal"></span>
		<h2 class="title"><?= $nombre ?></h2>
	</div>
	<div class="body-modal">
		<div id="ctdInfMuro">	
			<div class="image">
				<div class="imgPtdInfMuro" style="background-image:url(<?= URL_SERVER.URL_PRO_IMG.$imagen_portada ?>)"></div>
			</div>
			<div class="text">
				<h2>Información</h2>
				<div class="infoP">
					<h3>Propietario</h3>
					<p class="goToUrl">
						<a href="<?= teacherProfileLink($nombre_usuario) ?>"><?= $nombre_docente_completo ?></a>
					</p> 
				</div>
				<div class="infoP">
					<h3>Clave de la escuela</h3>
					<p class="goToUrl">
						<a href="<?= schoolLink($clave_escuela) ?>"><?= $clave_escuela ?></a>
					</p> 
				</div>
				<div class="infoP">
					<h3>Escuela</h3>
					<p class="goToUrl">
						<a href="<?= schoolLink($clave_escuela) ?>"><?= $nombre_escuela ?></a>
					</p> 
				</div>
				<div class="infoP">
					<h3>Grado</h3>
					<p><?= $grado ?></p> 
				</div>
				<div class="infoP">
					<h3>Grupo</h3>
					<p><?= $grupo ?></p> 
				</div>
				<div class="infoP">
					<h3>Estado</h3>
					<p class="<?= $css_estado ?>"><?= $estado ?></p> 
				</div>
				<div class="infoP">
					<h3>Ciclo escolar</h3>
					<p><?= $ciclo_escolar ?></p> 
				</div>
				<div class="infoP">
					<h3>Duración del proyecto</h3>
					<p>Del <?= $fecha_ini_tex ?> al <?= $fecha_fin_tex ?> </p>
				</div>
				<div class="infoP">
					<h3>Descripción</h3>
					<p><?= $descripcion ?></p> 
				</div>
			</div>
		</div>
	</div>
</div>