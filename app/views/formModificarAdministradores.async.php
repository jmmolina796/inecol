<div class="form-modificar-administrador cntFormPrincl">
    <h2>Modificar un administrador</h2>
    <div class="mt-form mt-principal">
        <input type="text" id="admin-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_administrador ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="admin-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_paterno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="admin-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_materno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="admin-correo" name="email" data-name="Correo:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" value="<?= $email ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="admin-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" value="<?= $nombre_usuario ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="admin-password" name="password" data-name="Contraseña:" maxlength="35" data-validate="/^[\s\S]{8,35}$/" data-label="Se requiere entre 8 y 35 caracteres" data-require="true" value="<?= $password ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="admin-telefono" name="telefono" data-name="Número de teléfono:" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" value="<?= $telefono ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <div class="mt-form">
            <input type="file" id="admin-imagen" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" data-color="<?= $color ?>" />
        </div>
        <div class="form-buttons">
            <div class="mt-button btnCancelAdmin">Cancelar</div>
            <div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateAdmin" data-administrador="<?= $id_administrador ?>">Modificar</div>
        </div>
    </div>
</div>