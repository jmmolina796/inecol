import 'jquery-touch-events';

import '../bootstrap.scss';
import 'bootstrap/js/src/dropdown';

import 'bootstrap-table/src/bootstrap-table.js';
import 'bootstrap-table/src/bootstrap-table.scss';

import 'bootstrap-table/src/locale/bootstrap-table-es-MX';
import 'bootstrap-table/src/extensions/filter-control/bootstrap-table-filter-control';

import {
    loadedContent
} from '../shared/contentLoaders';

const loadFilesMenu = function () {
    $.mtStart();
    loadedContent();
    if ($(".tblContent").length > 0) {
        $('.tblContent').bootstrapTable();
        $(".contenedorTabla .fixed-table-header").remove();
        
        if ($('.tblContent th[data-field="Id"]').length > 0) {
            $('.tblContent').bootstrapTable('hideColumn', 'Id');
        }

        if ($(".tableUrlRdir").length > 0) {
            $('.tblContent').bootstrapTable('hideColumn', 'UrlRdir');
            $(".tblContent.tableUrlRdir").on("doubletap", "tbody tr", function () {
                var datos = JSON.parse(JSON.stringify($(this).closest(".tableUrlRdir").bootstrapTable('getSelections')));
                window.open(datos[0].UrlRdir);
            });
        }
        if ($(".tableUrlRdirOne").length > 0) {
            $('.tblContent').bootstrapTable('hideColumn', 'UrlRdir');
            $(".tblContent.tableUrlRdirOne").on("click-row.bs.table", function (row, $element) {
                goToUrl($element.UrlRdir);
            });
        }
        $.mtSearch();
    }

    if ($('#tblHistorialCiclosEscolares').length > 0) {
        $('#tblHistorialCiclosEscolares').bootstrapTable();
        $(".contenedorTabla .fixed-table-header").remove();
        // $('#tblHistorialCiclosEscolares').bootstrapTable('hideColumn', 'id_ciclo');
        $.mtSearch();
    }
};

export default loadFilesMenu;