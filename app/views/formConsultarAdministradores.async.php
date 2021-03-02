<div class="form-consultar-administrador cntFormPrincl cntRdImg">
	<h2>Consultar un administrador</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="admin-nombre" name="nombre" data-name="Nombre:"  disabled="disabled" data-validate="none" data-require="false" value="<?= $nombre_administrador ?>">
		<input type="text" id="admin-apellidoP" name="ape_paterno" data-name="Apellido paterno:" data-validate="none"  disabled="disabled"  data-require="false" value="<?= $ape_paterno ?>">
		<input type="text" id="admin-apellidoM" name="ape_materno" data-name="Apellido materno:"  data-validate="none" disabled="disabled"  data-require="false" value="<?= $ape_materno ?>">
		<input type="text" id="admin-correo" name="email" data-name="Correo:"  disabled="disabled"  data-validate="none" data-require="false" value="<?= $email ?>">
		<input type="text" id="admin-usuario" name="nombre_usuario" data-name="Nombre de usuario:"  data-validate="none" disabled="disabled" value="<?= $nombre_usuario ?>" data-require="false">
		<input type="text" id="admin-password" name="password" data-name="Contraseña:" data-validate="none"  disabled="disabled"  value="<?= $password ?>" data-require="false">
		<input type="text" id="admin-telefono" name="telefono" data-name="Número de teléfono:"  disabled="disabled"  data-validate="none" value="<?= $telefono ?>" data-require="false">
        <div class="fotoPerfilConsultar">
            <p>Foto de perfil:</p>
			<img src='<?= URL_SERVER.URL_ADM_IMG.$imagen ?>'>
        </div>
		<div class="mt-button btnCancelAdmin">Regresar</div>
</div>