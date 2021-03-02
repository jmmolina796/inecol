<div class='contenedorPublicarComentario contenedorModificarComentario' data-idc='<?= $id_comentario_publicacion ?>'>
    <img src='<?= $imagen_usuario ?>'/>
    <textarea placeholder='Escribe el nuevo comentario:' autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"><?= $comentario_publicacion ?></textarea>
    <div>
        <div class='btnModificarComentario mt-button-blue'>Modificar</div>
    	<div class='btnCancelarComentario mt-button-orange'>Cancelar</div>
    </div>
</div>