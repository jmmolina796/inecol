import {
    requestView
} from "../api";

const entidadesMunicipios = (contentEntidad, contentMunicipio) => $(contentEntidad).on("change", function() {
    var idEntidad = $(this).val();
    $(contentMunicipio).val("none");
    $(contentMunicipio).parent().find("input[type='text']").val($(contentMunicipio).parent().find("select>option").first().text());
    $(contentMunicipio).children().remove();
    var link = "conseguirEntidadesMunicipios";
    var data = {
        comm: "dbs",
        opt: "municipios",
        id_entidad: idEntidad
    };
    var callback = (data) => $(contentMunicipio).append(data).removeAttr("disabled");

    requestView(link, data, callback);
});

export default entidadesMunicipios;