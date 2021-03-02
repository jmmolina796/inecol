<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="form-configuracion form-configuracion-docente cntFormPrincl cntTblEsc cntGrd">
		<h2><?= $nombre_docente ?></h2>
		<div class="mt-form mt-principal form-docentes">
			<div class="imagen-selector">
				<div id="imagen-configuracion" class="<?= $css_class ?>">
					<p>
						<img id="imagen-configuracion-img" src="<?= URL_SERVER.URL_DOC_IMG.$imagen ?>" data-color="<?= $color ?>">
						<span class="nuevaImagen"></span>
						<span class="eliminarImagen"></span>
					</p>
				</div>
			</div>
            <input type="file" id="docente-imagen-conf" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" accept="image/gif,image/jpeg,image/jpg,image/png" />
			<input type="text" id="docente-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_docente ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="docente-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_paterno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="docente-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_materno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="docente-correo" name="mail"  data-name="Email:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" value="<?= $email ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<input type="text" id="docente-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" value="<?= $nombre_usuario ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<input type="text" id="docente-telefono" name="telefono" data-name="Número de teléfono:" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" value="<?= $telefono ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <select class="sgl" id="slEntidad" data-label="Campo requerido" data-require="true" name="id_entidad" data-name="Entidad:">
                <?= $selectEntidad ?>
            </select>
            <select class="sgl" id="slMunicipio" data-label="Campo requerido" data-require="true" name="id_municipio" data-name="Municipio:">
                <?= $selectMunicipio ?>
            </select>
            <input type="text" id="docente-localidad" name="localidad" data-name="Localidad:" maxlength="100" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ.,\s]{1,100}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_localidad?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<div class="mt-form contenedor-buscar-escuela">
			     <input type="text" id="docente-escuelas" name="escuelas" data-name="Clave de la escuela:" data-validate="none" data-label="none" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			     <div>
			         <div data-check="div.mt-principal" class="mt-button-pink btnBuscarEscuelas">Buscar</div>
			     </div>
			 </div>
			<div id="containerTablaEscuelaEncontrada"></div>
			<div id="containerTablaEscuelasAgregadas" style="display:block">
			    <h4>Escuelas registradas</h4>
			    <table id='tblEscuelasAgregadasDocente'>
			        <thead>
			            <tr>
			                <th data-field='Clave'>Clave de escuela</th>
			                <th data-field='Nombre'>Escuela</th>
			                <th data-field='Nivel'>Nivel educativo</th>
			                <th data-field='Entidad'>Grado</th>
			                <th data-field='Municipio'>Grupo</th>
			                <th data-field='Eliminar'>Eliminar</th>
			            </tr>
			        </thead>
			        <tbody>
			            <?= $tablaEscuelasDocentes ?>
			        </tbody>
			    </table>
			    <div data-check="div.mt-principal" class="mt-button-pink btnOtraEscuela">Otra escuela</div>
			</div>
			<div class="form-buttons">
				<div class="mt-button" data-check="div.mt-principal" id="btnConfigDoc">Guardar</div>
			</div>
		</div>
		<div class="configuration-more">
			<p><span class="cambiarClave">-Cambiar mi contraseña.</span></p>
			<p><span class="cancelarCuenta">-Desactivar mi cuenta.</span></p>
		</div>
	</div>
</div>
<?php load("footer") ?>