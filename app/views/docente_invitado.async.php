<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="perfil-informacion">
		<div class="portada-usuario">
			<img id="portada-usuario-img" src="<?= URL_SERVER.URL_DOC_IMG.$imagen ?>" title="<?= $nombre_completo ?>" data-color="<?= $color ?>">
			<h2><?= $nombre_completo ?></h2>
			<?= $infoChat ?>
		</div>
		<div class="tipo-usuario">
			<div class="fondo">
				<div class="contenido">Docente</div>
			</div>
		</div>
		<?= $infoUsuario ?>
		<div class="informacion-usuario">
			<div class="infoUsuario-header">
				<h3>Escuelas</h3>
			</div>
			<div class="tabla-esculas">
				<?= $escuelasDocente ?>
			</div>
		</div>
		<!-- <div class="informacion-usuario">
			<?php load("loader","docModules","false"); ?>
			<div class="infoUsuario-header">
				<h3>Módulos</h3>
			</div>
			<div class="mt-principal mt-form mt-no-validate">
        		<select class="sgl" id="slCicloEscolarMod" data-label="Campo requerido" data-require="true" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
			<div class="contenedorModulos cntPtdMuro <?= $modulosCss ?>">
				<section class="modulos">
					<?= $contenidoModulosDocente ?> 
				</section>
				<div class="sin-resultados">No se encontraron módulos.</div>
			</div>
		</div> -->
		<div class="informacion-usuario">
			<?php load("loader","docProjects","false"); ?>
			<div class="infoUsuario-header">
				<h3>Desafíos</h3>
			</div>
			<div class="mt-principal mt-form mt-no-validate">
        		<select class="sgl" id="slCicloEscolarPerfilDoc" data-label="Campo requerido" data-require="true" data-name="Ciclo Escolar:">
					<?= $selectCiclosEscolares ?>
				</select>
			</div>
			<div class="contenedorProyectos cntPtdMuro">
				<section class="proyectos">
					<?= $proyectosDocente ?>
				</section>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>