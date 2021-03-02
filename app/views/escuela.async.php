<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="perfil-informacion">
		<div class="portada-usuario">
			<h2><?= $escuela ?></h2>
		</div>
		<div class="tipo-usuario">
			<div class="fondo">
				<div class="contenido">Escuela</div>
			</div>
		</div>
		<div class="informacion-usuario">
			<div class="infoUsuario-header">
				<h3>Información</h3>
			</div>
			<p>
				<span>Clave de la escuela:</span>
				<span><?= $clave_escuela ?></span> 
			</p>
			<p>
				<span>Nivel educativo:</span>
				<span><?= $nivel_educativo ?></span>
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
				<span><?= $localidad ?></span>
			</p>
		</div>
		<div class="informacion-usuario">
			<div class="infoUsuario-header">
				<h3>Docentes</h3>
			</div>
			<div class="docentes-relacionados-proyectos docRelMuro">
				<?= $docentesRelacionados ?>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>