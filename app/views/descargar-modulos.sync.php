<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<section class="descargar-modulos sectCnt">
		<?php load("loader","docModules","false"); ?>
		<h3>Descarga los módulos SEVIC</h3>
		<div class="mt-form">
			<select class="sgl" id="modulo-niveles" name="modulo-niveles" data-label="none" data-require="false" data-name="Nivel educativo:">
				<option value="none" disabled="disabled" selected="selected">Selecciona el nivel educativo:</option>
				<option value="1">Preescolar</option>
				<option value="2">Especial</option>
				<option value="3">Primaria</option>
				<option value="4">Secundaria</option>
			</select>
		</div>
		<div id="nivelesModulos">
			<div class="noSelected">
				<p>No se ha seleccionado el nivel educativo</p>
			</div>
		</div>
	</section>
</div>
<?php load("footer") ?>