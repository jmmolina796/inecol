<div class="form-modificar-juez cntFormPrincl cntRdImg">
	<h2>Modificar un juez</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="juez-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" value="<?= $nombre_juez ?>"/>
		<input type="text" id="juez-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" value="<?= $ape_paterno ?>" />
		<input type="text" id="juez-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" value="<?= $ape_materno ?>" />
		<input type="text" id="juez-correo" name="email"  data-name="Email:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?= $email ?>" />
		<input type="text" id="juez-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?= $nombre_usuario ?>" />
		<input type="text" id="juez-password" name="password" data-name="Contraseña:" maxlength="35" data-validate="/^[\s\S]{8,35}$/" data-label="Se requiere entre 8 y 35 caracteres" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?= $password ?>" />
		<input type="text" id="juez-telefono" name="telefono" data-name="Número de teléfono:" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" value="<?= $telefono ?>" />
        <div class="mt-form">
            <select class="mlt" id="slct-proyectos" data-label="Campo requerido" data-require="false" data-name="Desafíos a calificar:" data-optionsSelected='<?= $proyectos_calificar ?>'>
			    <?= $selectProyectos ?>
		    </select>
		</div>
		<div class="mt-form">
            <input data-name="Imagen de perfil:" data-button="Imagen" type="file" id="juez-imagen" data-name="Imagen" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" data-color="<?= $color ?>">
        </div>
		<div class="form-buttons">
            <div class="mt-button btnCancelJuez">Cancelar</div>
            <div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateJuez" data-juez="<?= $id_juez ?>">Modificar</div>
        </div>



</div>