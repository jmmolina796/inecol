<?php load("loader","modal"); ?>
<div class="content-modal">
	<span class="closeButton cancelarModal"></span>
	<div class="body-modal">
		<div class="form-eliminar-administrador">
			<h2>Mensaje:</h2>
			<h4>¿Desea dar de baja al administrador <span><?= $nombre ?></span>?</h4>
			<div class="modal-buttons">
				<div class="mt-button cancelarModal">Cancelar</div>
				<div class="mt-button mt-button-blue" id="btnBajaAdmin">Dar de baja</div>
			</div>
		</div>
	</div>
</div>