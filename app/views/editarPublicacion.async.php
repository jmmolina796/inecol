<div class='publicarPost modificarPost'>
	<?= $loader_section ?>
	<h4>Modificar publicación:</h4>
	<input type='file' class='publicacion-imagen' accept='.png, .jpg, .jpeg' data-type='png, jpg, jpeg'>
	<input type='file' class='publicacion-archivo' accept='.doc,.xls,.ppt,.docx,.xlsx,.pptx,.pages,.keynote,.numbers,.pdf,.jpeg' data-type='doc, xls, ppt, docx, xlsx, pptx, pages, keynote, numbers, pdf, jpeg'>

	<?= $contenidoMultimedia ?>
	
	<div class='opciones'>
		<span class='texto'>Texto</span>
		<span class='youtube'>YouTube</span>
		<span class='foto'>Foto</span>
		<span class='archivo'>Archivo</span>
	</div>
	<div class='botones' data-idp='<?= $id_publicacion_proyecto_docente ?>'>
		<div class='mt-button-orange btnCancelarPub'>Cancelar</div>
		<div class='mt-button-blue btnModificarPub'>Modificar</div>
	</div>
</div>