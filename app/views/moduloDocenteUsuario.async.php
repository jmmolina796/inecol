<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorModuloDocente cntDcMuro <?= $cssPublicaciones ?>">
		<div class="contenedorModuloLeft cntMuroLft">
			<div class="portadaModuloDocente ptdDcMuro">
				<div class="headModuloDocente hdDcMuro">
					<h2><?= $nombre_modulo ?></h2>
					<div class="extLink goToUrl">
						<a href="<?= moduleLink($url_modulo) ?>">
							<span></span>
						</a>
					</div>
				</div>
				<div class="backgroundModuloDocente bckDcMuro">
					<div class="backgroundBottom bckBtt">
						<a href="whatsapp://send?text=<?= userModuleLink($urlModulo) ?>" data-action="share/whatsapp/share">
							<span class="whatsAppMuro icSocMuro"></span>
						</a>
						<span class="codigoQrMuro icSocMuro"></span>
						<span class="relacionadosMuro icSocMuro"></span>
						<span class="infoMuro icSocMuro"></span>
					</div>
				</div>
				<div class="fondoModulo fndMuro">
					<div id="bckPtdMuro-img" class="imagenPortada imgPtd" style="background-image:url(<?= URL_SERVER.URL_MOD_IMG.$imagen_portada ?>)" data-color="<?= $color ?>"></div>
				</div>
				<div class="informationModuloDocente infDcMuro">
					<div class="informacionDocente infDc">
						<span class="goToUrl">
							<a href="<?= teacherProfileLink($nombre_usuario) ?>">
								<img src="<?= URL_SERVER.URL_DOC_IMG.$imagen_docente ?>" alt=" <?= $nombre_docente_completo ?> ">
							</a>
						</span>
						<span class="nombre-inciales goToUrl">
							<a href="<?= teacherProfileLink($nombre_usuario) ?>"><?= $nombre_docente_iniciales ?></a>
						</span>
						<span class="nombre-completo goToUrl">
							<a href="<?= teacherProfileLink($nombre_usuario) ?>"><?= $nombre_docente_completo ?></a>
						</span>
					</div>
					<div class="informacionModulo infMuro">
						<a href="whatsapp://send?text=<?= userModuleLink($urlModulo) ?>" data-action="share/whatsapp/share">
							<span class="whatsAppMuro icSocMuro"></span>
						</a>
						<span class="codigoQrMuro icSocMuro"></span>
						<span class="relacionadosMuro icSocMuro"></span>
						<span class="infoMuro icSocMuro"></span>
						<span class="icon-likes heart_likes <?= $css_likes ?>" ></span>
						<span class="likes"><?= $cant_likes ?></span> 
					</div>
				</div>
			</div>
			<div class="filtroModuloDocente fltDcMuro">
				<div class="infLblMuro lblMuroSty">Información del módulo</div>
				<div class="resumenInfoModulo rsmInfMuro">
					<span class="closeButton closeInfo"></span>
					<h4>Información del módulo</h4>
					<div class="infoP">
						<h3>Ciclo escolar</h3>
						<p><?= $nombre_ciclo_escolar ?></p>
					</div>
					<div class="infoP goToUrl">
						<h3>Clave de la escuela</h3>
						<p>
							<a href="<?= schoolLink($clave_escuela) ?>"> <?= $clave_escuela ?> </a>
						</p>
					</div>
					<div class="infoP goToUrl">
						<h3>Escuela</h3>
						<p>
							<a href="<?= schoolLink($clave_escuela) ?>"> <?= $nombre_escuela ?> </a>
						</p>
					</div>
					<div class="infoP">
						<h3>Grado</h3>
						<p><?= $nombre_grado ?></p>
					</div>
					<div class="infoP">
						<h3>Grupo</h3>
						<p><?= $nombre_grupo ?></p>
					</div> 
				</div>
				<div class="filtroModuloLabel fltLblMuro lblMuroSty">Filtrar publicaciones</div>
				<div class="filtroBody">
					<span class="closeButton closeFiltro"></span>
					<div class="filtroType">
						<h4>Tipo</h4>
						<div class="publicaciones selected">
							<p>Publicaciones</p>
						</div>
						<div class="imagenes">
							<p>Imágenes</p>
						</div>
						<div class="archivos">
							<p>Archivos</p>
						</div>
						<div class="youtubeVideos">
							<p>Videos YouTube</p>
						</div>
					</div>
					<div class="filtroDate">
						<h4>Fecha</h4>
						<div class="fechaDescendente selected">
							<p>Descendente</p>
						</div>
						<div class="fechaAscendente">
							<p>Ascendente</p>
						</div>
					</div>
				</div>
			</div>
			<div id="contendorPublicacionesProyectos" class="cntPubMuro">
				<?= $contenidoPublicacion ?>
			</div>
			<div class="modulo-vacio muroVc">Todavía no hay publicaciones.</div>
		</div>
		<div class="contenedorModuloRight cntMuroRgh">
			<div class="infLblMuro lblMuroSty">Información del módulo</div>
			<div class="resumenInfoModulo rsmInfMuro">
				<span class="closeButton closeInfo"></span>
				<h4>Información del módulo</h4>
				<div class="infoP">
					<h3>Ciclo escolar</h3>
					<p><?= $nombre_ciclo_escolar ?></p>
				</div>
				<div class="infoP goToUrl">
					<h3>Clave de la escuela</h3>
					<p>
						<a href="<?= schoolLink($clave_escuela) ?>"> <?= $clave_escuela ?> </a>
					</p>
				</div>
				<div class="infoP goToUrl">
					<h3>Escuela</h3>
					<p>
						<a href="<?= schoolLink($clave_escuela) ?>"> <?= $nombre_escuela ?> </a>
					</p>
				</div>
				<div class="infoP">
					<h3>Grado</h3>
					<p><?= $nombre_grado ?></p>
				</div>
				<div class="infoP">
					<h3>Grupo</h3>
					<p><?= $nombre_grupo ?></p>
				</div> 
			</div>
			<div class="filtroModuloDocente fltDcMuro">
				<div class="filtroModuloLabel fltLblMuro lblMuroSty">Filtrar publicaciones</div>
				<div class="filtroBody">
					<span class="closeButton closeFiltro"></span>
					<div class="filtroType">
						<h4>Tipo</h4>
						<div class="publicaciones selected">
							<p>Publicaciones</p>
						</div>
						<div class="imagenes">
							<p>Imágenes</p>
						</div>
						<div class="archivos">
							<p>Archivos</p>
						</div>
						<div class="youtubeVideos">
							<p>Videos YouTube</p>
						</div>
					</div>
					<div class="filtroDate">
						<h4>Fecha</h4>
						<div class="fechaDescendente selected">
							<p>Descendente</p>
						</div>
						<div class="fechaAscendente">
							<p>Ascendente</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php load("footer") ?>