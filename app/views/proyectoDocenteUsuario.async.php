<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="contenedorProyectoDocente cntDcMuro <?= $cssPublicaciones ?>">
		<div class="contenedorProyectoLeft cntMuroLft">
			<div class="portadaProyectoDocente ptdDcMuro">
				<div class="headProyectoDocente hdDcMuro">
					<h2><?= $nombre_proyecto ?></h2>
					<div class="extLink goToUrl">
						<a href="<?= projectLink($url_proyecto) ?>">
							<span></span>
						</a>
					</div>
				</div>
				<div class="backgroundProyectoDocente bckDcMuro">
					<div class="backgroundTop bckTop">
						<span class="estatus">Estado: <span class="<?= $css_estatus_proyecto ?>"><?= $rel_estatus_fecha_proyecto ?></span></span>
					</div>
					<div class="backgroundBottom bckBtt">
						<a href="whatsapp://send?text=<?= userProjectLink($urlProyecto) ?>" data-action="share/whatsapp/share">
							<span class="whatsAppMuro icSocMuro"></span>
						</a>
						<span class="codigoQrMuro icSocMuro"></span>
						<span class="relacionadosMuro icSocMuro"></span>
						<span class="infoMuro icSocMuro"></span>
					</div>
				</div>
				<div class="fondoProyecto fndMuro">
					<div id="bckPtdMuro-img" class="imagenPortada imgPtd" style="background-image:url(<?= URL_SERVER.URL_PRO_IMG.$imagen_portada ?>)" data-color="<?= $color ?>"></div>
				</div>
				<div class="informationProyectoDocente infDcMuro">
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
					<div class="informacionProyecto infMuro">
						<a href="whatsapp://send?text=<?= userProjectLink($urlProyecto) ?>" data-action="share/whatsapp/share">
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
			<div class="filtroProyectoDocente fltDcMuro">
				<div class="infLblMuro lblMuroSty">Información del proyecto</div>
				<div class="resumenInfoProyecto rsmInfMuro">
					<span class="closeButton closeInfo"></span>
					<h4>Información del proyecto</h4>
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
				<div class="filtroProyectoLabel fltLblMuro lblMuroSty">Filtrar publicaciones</div>
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
			<div class="proyecto-vacio muroVc">Todavía no hay publicaciones.</div>
		</div>
		<div class="contenedorProyectoRight cntMuroRgh">
			<div class="infLblMuro lblMuroSty">Información del proyecto</div>
			<div class="resumenInfoProyecto rsmInfMuro">
				<span class="closeButton closeInfo"></span>
				<h4>Información del proyecto</h4>
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
			<div class="filtroProyectoDocente fltDcMuro">
				<div class="filtroProyectoLabel fltLblMuro lblMuroSty">Filtrar publicaciones</div>
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