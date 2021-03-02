<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="perfil-informacion">
		<div class="portada-usuario">
			<p class="goToUrl">
				<a href="<?= URL_SERVER ?>configuracion">
					<span></span>
					<span>Editar</span>
				</a>
			</p>
			<img id="portada-usuario-img" src="<?= URL_SERVER.URL_DOC_IMG.$imagen ?>" title="<?= $nombre_completo ?>" data-color="<?= $color ?>">
			<h2><?= $nombre_completo ?></h2>
		</div>
		<div class="tipo-usuario">
			<div class="fondo">
				<div class="contenido">Docente</div>
			</div>
		</div>
		<div class="informacion-usuario">
			<div class="infoUsuario-header goToUrl">
				<h3>Mi información</h3>
				<a href="<?= URL_SERVER ?>configuracion">
					<span></span>
					<span>Editar</span>
				</a>
			</div>
			<p>
				<span>Correo electrónico:</span>
				<span><?= $email ?></span> 
			</p>
			<p>
				<span>Teléfono:</span>
				<span><?= $telefono ?></span>
			</p>
			<p>
				<span>Entidad:</span>
				<span><?= $entidad ?></span>
			</p>
			<p>
				<span>Municipio:</span>
				<span><?= $municipio ?></span>
			</p>
			<p>
				<span>Localidad:</span>
				<span><?= $nombre_localidad ?></span>
			</p>
		</div>
		<div class="informacion-usuario">
			<div class="infoUsuario-header goToUrl">
				<h3>Mis escuelas</h3>
				<a href="<?= URL_SERVER ?>configuracion">
					<span></span>
					<span>Editar</span>
				</a>
			</div>
			<div class="tabla-esculas">
				<?= $escuelasDocente ?>
			</div>
		</div>
		<!-- <div class="informacion-usuario">
			<?php load("loader","docModules","false"); ?>
			<div class="infoUsuario-header goToUrl">
				<h3>Mis módulos</h3>
				<a href="<?= URL_SERVER.'docentes/'.$nombre_usuario ?>/modulos">
					<span></span>
					<span>Editar</span>
				</a>
			</div>
			<div class="mt-principal mt-form mt-no-validate marg-one">
        		<select class="sgl" id="slCicloEscolarMod" data-label="Campo requerido" data-require="true" name="slCicloEscolarMod" data-name="Ciclo Escolar:">
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
			<div class="infoUsuario-header goToUrl">
				<h3>Mis desafíos</h3>
				<a href="<?= URL_SERVER.'docentes/'.$nombre_usuario ?>/proyectos">
					<span></span>
					<span>Editar</span>
				</a>
			</div>
			<div class="mt-principal mt-form mt-no-validate marg-one">
        		<select class="sgl" id="slCicloEscolarPerfilDoc" data-label="Campo requerido" data-require="true" name="slCicloEscolarMod" data-name="Ciclo Escolar:">
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