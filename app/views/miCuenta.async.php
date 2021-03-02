<div id="content-user" class="menuCnt">
<div class="closeButton"></div>
<div class="tltMn">Mi cuenta</div>
	<ul>
		<?= $content ?>
		<li class="goToUrl"><a href="<?= messagesLink() ?>" class="no-style">Chat</a></li>
		<!-- <li class="goToUrl"><a href="<?= URL_SERVER ?>soporte" class="no-style">Soporte</a></li> -->
		<li class="goToUrl"><a href="<?= URL_SERVER ?>configuracion" class="no-style">Configuración</a></li>
		<li class="goToUrl"><a href="<?= URL_SERVER ?>descargar-modulos" class="no-style">Descargar módulos</a></li>
		<li id="closeSesion" class="openFile">Cerrar sesión</li>
	</ul>
</div>