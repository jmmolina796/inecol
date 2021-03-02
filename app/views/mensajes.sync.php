<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
	<div id="webContent">
		<section class="contenedor-chats onlyChats">
			<div class="chats">
				<?= $contenidoChats ?>
			</div> 
			<div class="mensajes">
				<?php load("loader","chat","false") ?>
				<div class="mensajesContent">
					<div class="noSelected">
						<p class="note">No se ha seleccionado ninguna conversación</p>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php load("footer") ?>