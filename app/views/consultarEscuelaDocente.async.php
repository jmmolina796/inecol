<h5>Si la escuela que aparece en la tabla de abajo es la que está buscando, selecciónela y pulse el botón agregar, de lo contrario pulse el botón cancelar para buscar otra.</h5>
<table id='tblEscuelaDocente' >
    <thead>
        <tr>
            <th data-field='Clave'>Clave de escuela</th>
            <th data-field='Nombre'>Escuela</th>
            <th data-field='Nivel'>Nivel educativo</th>
            <th data-field='Entidad'>Entidad</th>
            <th data-field='Municipio'>Municipio</th>
        </tr>
    </thead>
    <tr>
        <td><?= $clave_escuela ?></td>
        <td><?= $escuela ?></td>
        <td><?= $nivel_educativo ?></td>
        <td><?= $entidad ?></td>
        <td><?= $municipio ?></td>
    </tr>
</table>

<div class="escuelaDocente-buttons">
    <div class="mt-button-pink btnCancelar-agregarEscuela" data-check="none">Cancelar</div>
    <div class="mt-button-pink" data-check="none" data-idNivel='<?= $id_nivel_educativo ?>' id='btnAgregarEscuela'>Agregar</div>
</div>