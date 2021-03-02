<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-eliminar-ciclo_escolar">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja el ciclo escolar <span><?= $nombre ?></span>?</h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button mt-button-blue" id="btnBajaCicloEscolar">Dar de baja</div>
			</div>
		</div>
	</div>
</div>