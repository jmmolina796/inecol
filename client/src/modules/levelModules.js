import requestView from '../api/requestView';

$("#webContent").on("change", "#modulo-niveles", ({ target }) => {
    $("#loader-docModules").addClass("show");
    var link = "modulosFiltro";
    var modulo = $(target).val();
    var data = {
        comm: "async",
        mod: modulo
    };
    var callback = (data) => {
        $("#nivelesModulos").html(data);
        $("#loader-docModules").removeClass("show");
    };
    requestView(link, data, callback);
});

$("#webContent").on("click", "#nivelesModulos .download", (e) => {
    e.preventDefault();
    var ur = $(this).attr("href");
    var na = $(this).find("span").text();
    window.location = "descargarModulo?u=" + ur + "&n=" + na;
});