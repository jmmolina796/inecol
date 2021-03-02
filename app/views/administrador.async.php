<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="perfil-informacion">
		<div class="portada-usuario">
			<p class="goToUrl">
				<a href="<?= URL_SERVER ?>configuracion">
					<span></span>
					<span>Editar</span>
				</a>
			</p>
			<img id="portada-usuario-img" src="<?= URL_SERVER.URL_ADM_IMG.$imagen ?>" title="<?= $nombre_completo ?>" data-color="<?= $color ?>">
			<h2><?= $nombre_completo ?></h2>
		</div>
		<div class="tipo-usuario">
			<div class="fondo">
				<div class="contenido"><?= $tipoUsuario ?></div>
			</div>
		</div>
		<div class="informacion-usuario">
			<div class="infoUsuario-header goToUrl">
				<h3>Mi información</h3>
				<a href="<?= URL_SERVER ?>configuracion">
					<span></span>
					<span>Editar</span>
				</a>
			</div>
			<p>
				<span>Correo electrónico:</span>
				<span><?= $email ?></span> 
			</p>
			<p>
				<span>Teléfono:</span>
				<span><?= $telefono ?></span>
			</p>
		</div>
	</div>
</div>
<?php load("footer") ?>