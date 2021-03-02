<?php load("header") ?>
<?php load("menu") ?>
<?php load("busquedaPrincipal") ?>
<div id="webContent">
	<div class="form-registrar-docente cntFormPrincl cntTblEsc cntGrd">
		<h2>Regístrese a Fairchild Challenge</h2>
		<div class="mt-form mt-principal form-docentes">
	        <input type="text" id="docente-nombre" name="nombre"  data-name="Nombre:"  maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{3,50}$/" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
    		<input type="text" id="docente-ape_paterno" name="ape_paterno" data-name="Apellido paterno:" maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
    		<input type="text" id="docente-pae_materno" name="ape_materno" data-name="Apellido materno:" maxlength="50" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\s]{4,50}$/" data-label="Se requiere como mínimo 4 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
            <input type="text" id="docente-mail" name="mail" data-name="Email:" maxlength="70" data-validate="/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/" data-label="Email inválido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <input type="password" id="docente-password" name="password" data-name="Contraseña:"  maxlength="30" data-validate="/^[\s\S]{8,30}$/" data-label="Se requiere entre 8 y 30 caracteres" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <input type="text" id="docente-nombre_usuario" name="nombre_usuario" data-name="Nombre de usuario:" maxlength="40" data-validate="/^[a-zA-Z0-9\_\.\-]{4,40}$/" data-label="Se requiere entre 4 y 40 letras o números" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
            <input type="text" id="docente-telefono" name="telefono" data-name="Teléfono" maxlength="11" data-validate="/^[0-9]{7,11}$/" data-label="Solo números entre 7 y 11 dígitos" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
	       <select class="sgl" id="slEntidad" data-label="Campo requerido" data-require="true" name="id_entidad" data-name="Entidad federativa:">
               <?= $selectEntidad ?>
           </select>
           <select class="sgl" id="slMunicipio" data-label="Campo requerido" data-require="true" name="id_municipio" data-name="Municipio:" disabled="disabled">
               <option value="none" disabled="disabled" selected="selected">Selecciona el municipio:</option>
           </select>
           <input type="text" id="docente-localidad" name="localidad" data-name="Localidad" maxlength="100" data-validate="/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ.,\s]{1,100}$/" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
	        <div class="mt-form">
                <input type="file" id="docente-imagen" data-name="Imagen de perfil:" data-type="png, jpg, jpeg" data-label="Formato incorrecto" data-require="false" data-button="Imagen" />
            </div>
            <div class="mt-form contenedor-buscar-escuela">
                <input type="text" id="docente-escuelas" name="escuelas" data-name="Clave de la escuela:" data-validate="none" data-label="none" data-require="false" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" />
                <div>
                    <div data-check="div.mt-principal" class="mt-button-pink btnBuscarEscuelas">Buscar</div>
                </div>
            </div>
	        <div id="containerTablaEscuelaEncontrada"></div>
	        <div id="containerTablaEscuelasAgregadas">
	            <h5>Seleccione su grado y grupo de la escuela con la que se va a registrar</h5>
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
	                <tbody></tbody>
	            </table>
            	<div data-check="div.mt-principal" class="mt-button-pink btnOtraEscuela">Otra escuela</div>
	        </div>
        	<div class="form-buttons">
				<div  class="mt-button btnRegresarHome">Cancelar</div>
		        <div data-check="div.mt-principal"  class="mt-button mt-button-blue btnAceptarDocentes">Registrarme</div>
	        </div>
		</div>
	</div>
</div>
<?php load("footer") ?>