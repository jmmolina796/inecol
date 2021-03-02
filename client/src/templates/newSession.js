export default (key) => (`
    <div class="mt-form tr-session-inf">
        <h3>Sesión ${key + 1}</h3>
        <span class="glyphicon glyphicon-remove-sign icon-mt-form remove-tr-session" aria-hidden="true"></span>
        <span class="glyphicon glyphicon-plus-sign icon-mt-form add-tr-session" aria-hidden="true"></span>
        <input type="text" id="cap-session-nombre-${key}" name="cap-session-nombre-${key}" data-name="Nombre:" maxlength="70" data-validate="${/^[0-9a-zA-ZáéíóúÁÉÍÓÚàèìòùÀÈÌÒÙñÑ\.\,\-\_\s]{3,70}$/}" data-label="Se requiere como mínimo 3 letras" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="on" spellcheck="false" />
        <div class="mt-form">
            <textarea name="cap-session-descripcion-${key}" id="cap-session-descripcion-${key}" data-name="Descripción:" maxlength="700" data-label="Campo requerido" data-require="true" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"></textarea>
        </div>
    </div>
`);