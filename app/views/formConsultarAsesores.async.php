<div class="form-consultar-asesor cntFormPrincl cntRdImg">
	<h2>Consultar un asesor</h2>
	<div class="mt-form mt-principal">
		<input type="text" id="asesor-nombre" name="nombre" data-name="Nombre:"  disabled="disabled" data-validate="none" data-require="false" value="<?= $nombre_asesor ?>">
		<input type="text" id="asesor-apellidoP" name="ape_paterno" data-name="Apellido paterno:" data-validate="none"  disabled="disabled"  data-require="false" value="<?= $ape_paterno ?>">
		<input type="text" id="asesor-apellidoM" name="ape_materno" data-name="Apellido materno:"  data-validate="none" disabled="disabled"  data-require="false" value="<?= $ape_materno ?>">
		<input type="text" id="asesor-correo" name="email" data-name="Correo:"  disabled="disabled"  data-validate="none" data-require="false" value="<?= $email ?>">
		<input type="text" id="asesor-usuario" name="nombre_usuario" data-name="Nombre de usuario:"  data-validate="none" disabled="disabled" value="<?= $nombre_usuario ?>" data-require="false">
		<input type="text" id="asesor-password" name="password" data-name="Contraseña:" data-validate="none"  disabled="disabled"  value="<?= $password ?>" data-require="false">
		<input type="text" id="asesor-telefono" name="telefono" data-name="Número de teléfono:"  disabled="disabled"  data-validate="none" value="<?= $telefono ?>" data-require="false">
		<input type='text' id='asesor-tipo'  data-name='Tipo de asesor'  data-validate='none' data-label='none' data-require='false'  disabled='disabled' value="<?= $nombre_funcion ?>" >
        <div class="fotoPerfilConsultar">
            <p>Foto de perfil:</p>
			<img src='<?= URL_SERVER.URL_ASE_IMG.$imagen ?>'>
        </div>
		<div class="mt-button btnCancelAsesor">Regresar</div>
</div>