<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorTabla">
	    <h2>Escuelas</h2>
		<div class="mt-form">
			<select class="sgl" id="escuelas-tipos" name="escuelas-tipos" data-label="Campo requerido" data-require="true" data-name="Tipos de escuelas:">
				<?= $selectTipoEscuela ?>
			</select>
			<select class="sgl" id="escuela-maestros" name="escuela-maestros" data-label="Campo requerido" data-require="true" data-name="Registro:">
				<option value="none" disabled="disabled" selected="selected">Selecciona una opción:</option>
				<option value="0" selected="selected">Con maestros</option>
				<option value="1">Todas</option>
			</select>
		</div>
	    <div class="divContainerTable tablaFiltroEscuelas">
	        <?= $htmlTabla ?>
	    </div>
	</div>
</div>
<?php load("footer") ?>