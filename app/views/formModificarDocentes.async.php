<div class="form-modificar-docente cntFormPrincl cntTblEsc cntGrd">
    <h2>Modificar Docentes</h2>
    <div class="mt-form mt-principal form-docentes">
        <input  type="hidden" id="id_docente" name="id_docente" value="<?= $id_docente?>" />
        <input type="text"  id="docente-nombre" name="nombre" data-name="Nombre:"  maxlength="50" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" value="<?= $nombre_docente?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="docente-ape_paterno" name="ape_paterno" data-name="Apellido Paterno:"  maxlength="40" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_paterno?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="docente-pae_materno" name="ape_materno" data-name="Apellido Materno:"  maxlength="40" data-validate="/^[a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" value="<?= $ape_materno?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <input type="text" id="docente-correo" name="mail" data-name="Email:"  maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" value="<?= $email?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="docente-password" name="password" data-name="Password:"  maxlength="30" data-validate="/^[\s\S]{8,30}$/" data-label="Se requiere entre 8 y 30 caracteres" data-require="true" value="<?= $password?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="docente-usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" value="<?= $nombre_usuario?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <input type="text" id="docente-telefono"  name="telefono" data-name="Teléfono:" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" value="<?= $telefono?>" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
        <select class="sgl" id="slEntidad" data-label="Campo requerido" data-require="true" name="id_entidad" data-name="Entidad:">
            <?= $selectEntidad ?>
        </select>
        <select class="sgl" id="slMunicipio" data-label="Campo requerido" data-require="true" name="id_municipio" data-name="Municipio:">
            <?= $selectMunicipio ?>
        </select>
        <input type="text" id="docente-localidad" name="localidad" data-name="Localidad:" maxlength="100" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ.,\s]{1,100}$/" data-label="Campo requerido" data-require="true" value="<?= $nombre_localidad?>" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />                            
        <div class="mt-form">
            <input data-name="Imagen de perfil:" data-button="Imagen" type="file" id="docente-imagen" data-name="Imagen" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-img="<?= $imagen ?>" data-color="<?= $color ?>">
        </div>
       <div class="mt-form contenedor-buscar-escuela">
            <input type="text" id="docente-escuelas" name="escuelas" data-name="Clave de la escuela:" data-validate="none" data-label="none" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <div>
                <div data-check="div.mt-principal" class="mt-button-pink btnBuscarEscuelas">Buscar</div>
            </div>
        </div>
        <div id="containerTablaEscuelaEncontrada"></div>
        <div id="containerTablaEscuelasAgregadas" style="display:block">
            <h4>Escuelas registradas</h4>
            <table id='tblEscuelasAgregadasDocente' >
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
            <div class="mt-button btnCancelDocentes">Regresar</div>
            <div class="mt-button mt-button-blue btnModificarDocentes">Modificar</div>
        </div>
    </div>
</div>