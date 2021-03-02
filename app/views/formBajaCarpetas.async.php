<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-baja-proyecto_carpeta">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja la carpeta <span><?= $nombre_carpeta ?> </span>? al hacerlo sus proyectos relacionados quedarán libres </h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button" id="btnBajaCarpeta">Dar de baja</div>
			</div>
		</div>
	</div>
</div>