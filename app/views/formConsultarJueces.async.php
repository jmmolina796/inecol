<div class="form-consultar-juez cntFormPrincl cntRdImg">
	<h2>Consultar un juez</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="juez-nombre" name="nombre" data-name="Nombre:"  disabled="disabled" data-validate="none" data-require="false" value="<?= $nombre_juez ?>">
		<input type="text" id="juez-apellidoP" name="ape_paterno" data-name="Apellido paterno:" data-validate="none"  disabled="disabled"  data-require="false" value="<?= $ape_paterno ?>">
		<input type="text" id="juez-apellidoM" name="ape_materno" data-name="Apellido materno:"  data-validate="none" disabled="disabled"  data-require="false" value="<?= $ape_materno ?>">
		<input type="text" id="juez-correo" name="email" data-name="Correo:"  disabled="disabled"  data-validate="none" data-require="false" value="<?= $email ?>">
		<input type="text" id="juez-usuario" name="nombre_usuario" data-name="Nombre de usuario:"  data-validate="none" disabled="disabled" value="<?= $nombre_usuario ?>" data-require="false">
		<input type="text" id="juez-password" name="password" data-name="Contraseña:" data-validate="none"  disabled="disabled"  value="<?= $password ?>" data-require="false">
		<input type="text" id="juez-telefono" name="telefono" data-name="Número de teléfono:"  disabled="disabled"  data-validate="none" value="<?= $telefono ?>" data-require="false">
        <div class="mt-form">
            <select class="mlt" id="slct-proyectos" data-label="Campo requerido" data-require="false" data-name="Desafíos a calificar:" disabled="disabled" data-optionsSelected='<?= $proyectos_calificar ?>'>
			    <?= $selectProyectos ?>
		    </select>
		</div>
        <div class="fotoPerfilConsultar">
            <p>Foto de perfil:</p>
			<img src='<?= URL_SERVER.URL_JUE_IMG.$imagen ?>'>
        </div>
		<div class="mt-button btnCancelJuez">Regresar</div>
</div>