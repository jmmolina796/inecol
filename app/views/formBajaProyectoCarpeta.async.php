<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-baja-proyecto_carpeta">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja el proyecto <span><?= $nombre_proyecto ?></span> de la carpeta <span><?= $nombre_carpeta ?></span>  ?</h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button" id="btnBajaProyectoCarpeta">Dar de baja</div>
			</div>
		</div>
	</div>
</div>