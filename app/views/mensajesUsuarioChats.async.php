<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
	<div id="webContent">
		<section class="contenedor-chats onlyMensajes">
			<div class="chats">
				<?= $contenidoChatsNuevo ?>
				<?= $contenidoChats ?>
			</div> 
			<div class="mensajes">
				<?php load("loader","chat","false") ?>
				<div class="mensajesContent">
					<?= $contenidoHeaderMensajes ?>
					<div class='contenido'>
						<div class='contInt'>
							<?= $contenidoMensajes ?>
						</div>
					</div>
					<?= $contenidoFooterMensajes ?>
				</div>
			</div>
		</section>
	</div>
<?php load("footer") ?>