<div class="form-modificar-asesor cntFormPrincl">
    <h2>Modificar un asesor</h2>
    <div class="mt-form mt-principal">
        <input type="text" id="asesor-nombre" name="nombre" data-name="Nombre:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_asesor ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="asesor-apellidoP" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_paterno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="asesor-apellidoM" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_materno ?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="asesor-correo" name="email" data-name="Correo:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" value="<?= $email ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="asesor-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" value="<?= $nombre_usuario ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="asesor-password" name="password" data-name="Contraseña:" maxlength="35" data-validate="/^[\s\S]{8,35}$/" data-label="Se requiere entre 8 y 35 caracteres" data-require="true" value="<?= $password ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="asesor-telefono" name="telefono" data-name="Número de teléfono:" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" value="<?= $telefono ?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <select class="sgl" id="funcAsesor" data-label="Campo requerido" data-require="true" name="func_asesor" data-name="Tipo de asesor:">
            <?= $selectTipoAsesor ?>
        </select>
        <div class="mt-form">
            <input type="file" id="asesor-imagen" data-button="Imagen" data-name="Foto de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" data-color="<?= $color ?>" />
        </div>
        <div class="form-buttons">
            <div class="mt-button btnCancelAsesor">Cancelar</div>
            <div class="mt-button mt-button-blue" data-check="div.mt-principal" id="btnUpdateAsesor" data-asesor="<?= $id_asesor ?>">Modificar</div>
        </div>
    </div>
</div>