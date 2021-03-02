<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="form-configuracion form-configuracion-asesor cntFormPrincl">
		<h2><?= $nombre_asesor ?></h2>
		<div class="mt-form mt-principal">
		<div class="imagen-selector">
			<div id="imagen-configuracion" class="<?= $css_class ?>">
				<p>
					<img id="imagen-configuracion-img" src="<?= URL_SERVER.URL_ASE_IMG.$imagen ?>" data-color="<?= $color ?>">
					<span class="nuevaImagen"></span>
					<span class="eliminarImagen"></span>
				</p>
			</div>
		</div>
            <input type="file" data-color="<?= $color ?>" id="asesor-imagen-conf" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" accept="image/gif,image/jpeg,image/jpg,image/png" />				
			<input type="text" id="asesor-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_asesor ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="asesor-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_paterno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="asesor-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_materno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
			<input type="text" id="asesor-correo" name="email"  data-name="Email:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" value="<?= $email ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<input type="text" id="asesor-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 20 letras o números" data-require="true" value="<?= $nombre_usuario ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
			<input type="text" id="asesor-telefono" name="telefono" data-name="Número de teléfono:" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" value="<?= $telefono ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <select class="sgl" id="funcAsesor" data-label="Campo requerido" data-require="true" name="func_asesor" data-name="Tipo de asesor:">
                <?= $selectTipoAsesor ?>
            </select>
			<div class="form-buttons">
				<div class="mt-button" data-check="div.mt-principal" id="btnConfigAsesor">Guardar</div>
			</div>
		</div>
		<div class="configuration-more">
			<p><span class="cambiarClave">-Cambiar mi contraseña.</span></p>
			<p><span class="cancelarCuenta">-Desactivar mi cuenta.</span></p>
		</div>
	</div>
</div>
<?php load("footer") ?>