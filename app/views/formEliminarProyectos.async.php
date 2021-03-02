<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-eliminar-proyecto">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja el desafío <span><?= $nombre ?></span> creado el <span><?= $fecha ?></span>?</h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button mt-button-blue" id="btnBajaProyecto">Dar de baja</div>
			</div>
		</div>
	</div>
</div>