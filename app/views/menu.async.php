<div id="menu">
	<!-- <span class="menu-btn"></span> -->
	<nav>
		<div id="menu-pc">
			<span class="izquierdo"></span>
			<ul>
				<!-- <li class="goToUrl">
					<a href="<?= URL_SERVER.'descargar-modulos' ?>">
						Módulos SEVIC
					</a>
				</li>
				<li class="search-principal">Buscar</li>
				<li class="goToUrl">
					<a href="<?= URL_SERVER.'prensa' ?>">
						Prensa
					</a>
				</li>
				<li class="goToUrl">
					<a href="<?= URL_SERVER.'contacto' ?>">
						Contacto
					</a>
				</li>
				<li>
					<a href="http://transparencia.sev.gob.mx/" target="_blank">
						Transparencia
					</a>
				</li> -->
				<?php load("elementosMenu", 0) ?>
			</ul>
			<span class="derecho"></span>
		</div>
	</nav>
	<div id="menu-pc-sesion" class="menuCnt">
		<div class="closeButton"></div>
		<div class="tltMn">Menú</div>
		<ul>
			<?php load("elementosMenu") ?>
		</ul>
	</div>
</div>