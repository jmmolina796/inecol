<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<h2><?= $nombre_carpeta ?></h2>
	<div class="contenedorProyectos cntPtdMuro">
		<section class="proyectos">
			<?= $proyectosCarpetas ?>
		</section>
	</div>
</div>
<?php load("footer") ?>