<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-eliminar-escuela">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja la escuela <span><?= $nombre ?></span> con clave <span><?= $clave ?></span>?</h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button mt-button-blue" id="btnBajaEscuela">Dar de baja</div>
			</div>
		</div>
	</div>
</div>