<div class='comentarioPublicado' data-idc="<?= $id_comentario_publicacion ?>" data-tiempo-horas="<?= $horas ?>" data-tiempo-minutos-faltantes="<?= $minutosFaltantes ?>"  data-tiempo-minutos="<?= $minutos ?>"  data-idp="<?= $id_publicacion_proyecto_docente ?>"  data-fecha-completa="<?= $fecha_completa ?>" data-fecha-publicacion="<?= $fecha_publicacion ?>" >
	<div>
	    <img src="<?= $imagen_usuario ?>">
	    <p>
	        <a class="nombreIniciales" href="<?= URL_SERVER.$nombre_usuario ?>"><?= $nombre_iniciales ?></a>
	        <a class="nombreCompleto" href="<?= URL_SERVER.$nombre_usuario ?>"><?= $nombre_completo ?></a>
	    </p>
	    <p><?= $tiempo_comentario ?></p>
	</div>
	<div class="divComentarioPublicado"><?= $comentario_publicacion ?></div>
	<div class="opcionesComentario">
	    <span class="editarComentario"></span>
	    <span class="eliminarComentario"></span>
</div>