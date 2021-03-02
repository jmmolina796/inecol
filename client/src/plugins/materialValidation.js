import velocity from 'velocity-animate';
import autosize from 'autosize';

(function ($) {
    var verify = {
        error: false,
        element: undefined,
        start: function () {
            this.error = false;
            this.element = undefined;
        },
        change: function (element) {
            this.error = true;
            if (this.element == undefined) {
                this.element = element;
            }
        },
        show: function () {
            return this.error;
        },
        showElement: function () {
            return this.element;
        }
    }


    $.mtSearch = function () {
        $(".fixed-table-container div.filter-control").each(function (index) {
            if (!$(this).hasClass("mt-check")) {
                $(this).find(">input[type='text']").attr("id", "search-" + index);
                $(this).append("<label for='search-" + index + "'>Buscar: </label>");

                if ($(this).find("input").val().trim() != "") {
                    const $el = $(this).find("label");
                    velocity($el, "slideUp", 250);
                }


                $(this).find(">input[type='text']").on("focus", function () {
                    if ($(this).prop('readonly')) {
                        return false;
                    }
                    const $el = $(this).parent().find("label");
                    velocity($el, "slideUp", 150);
                    $(this).css("border-bottom", "#3490E7 2px solid");
                })


                $(this).find(">input[type='text']").on("blur", function () {
                    if ($(this).prop('readonly')) {
                        return false;
                    }
                    if ($(this).val() == "") {
                        const $el = $(this).parent().find("label");
                        velocity($el, "slideDown", 250);
                    }
                    const $el = $(this).parent().find("label");
                    velocity($el, {
                        "color": "#9e9e9e"
                    }, 100);
                    $(this).css("border-bottom", "#9e9e9e 2px solid");
                });
                $(this).addClass("mt-check");
            }
        });
    }


    $.mtStart = function () {
        function validateTrue(element) {
            var label = element.parent().find("label");
            label.data("error", true);
            element.css({
                "border-bottom": "#F44336 solid 2px"
            });
            element.parent().find(">span").show();
            label.css({
                "color": "#F44336"
            });
            verify.change(element);
        }

        function validateFalse(element, nam) {
            var label = element.parent().find("label");
            label.data("error", false);
            element.parent().find(">span").hide();
            element.css({
                "border-bottom": "#3490E7 solid 2px"
            });
            label.css({
                "color": "#3490E7"
            });
            label.text(nam);
        }

        $(".mt-form").each(function () {
            if (!$(this).hasClass("mt-check")) {
                $(this).find(">input[type='text'],>input[type='password']").wrap("<div class='txt'></div>");
                $(this).find(">input[type='radio']").wrap("<div class='rd'></div>");
                $(this).find(">div.rd").parent().prepend("<div class='rd-label'><span></span></div>");
                $(this).find(">input[type='checkbox']").wrap("<div class='ck'></div>");
                $(this).find(">div.ck").parent().prepend("<div class='ck-label'><span></span></div>");
                $(this).find(">input[type='file']").wrap("<div class='fl'><div class='content-file'></div></div>");
                $(this).find(">textarea").wrap("<div class='commt'></div>");
                $(this).find(">select.sgl").wrap("<div class='slct'><div class='cont-sgl'></div></div>");
                $(this).find(">select.mlt").wrap("<div class='slct'><div class='cont-mlt'></div></div>");
                $(this).find(".mt-button, .mt-button-blue, .mt-button-white, .mt-button-red, .mt-button-green, .mt-button-magenta, .mt-button-orange").each(function () {
                    $(this).data("check", $(this).attr("data-check"));
                    $(this).removeAttr("data-check");
                });

                $(this).find(">div.rd").parent().each(function () {
                    $(this).find("div.rd-label>span").text($(this).find("input[type='radio']").attr("data-label"));
                });
                $(this).find(">div.ck").parent().each(function () {
                    $(this).find("div.ck-label>span").text($(this).find("input[type='checkbox']").attr("data-label"));
                });

                $(this).find(">div.txt").each(function () {
                    var nam = $(this).find("input").attr("data-name");
                    var patt = $(this).find("input").attr("data-validate");
                    var lbl = $(this).find("input").attr("data-label");
                    $(this).append(" <span>" + lbl + "</span>");
                    $(this).find("input").data({
                        "label": $(this).find("input").attr("data-label"),
                        "require": $(this).find("input").attr("data-require")
                    });
                    $(this).prepend("<label for='" + $(this).find("input").attr("id") + "'>" + nam + "</label>")
                    $(this).find("input").removeAttr("data-name");
                    $(this).find("input").removeAttr("data-validate");
                    $(this).find("input").removeAttr("data-label");
                    $(this).find("input").removeAttr("data-require");
                    if ($(this).find("input").val().trim() != "") {
                        const $el = $(this).find("label");
                        velocity($el, {
                            "margin-top": "-18px",
                            "font-size": "14px"
                        }, 100);
                        if (patt != "none") {
                            if (patt.substring(0, 5) == "empty") {
                                if ($(this).find("input").val().length < patt.split("-")[1]) {
                                    validateTrue($(this).find("input"));
                                }
                            } else {
                                var pattern = eval(patt);
                                if (!pattern.test($(this).find("input").val().trim())) {
                                    validateTrue($(this).find("input"));
                                }
                            }
                        }
                    }
                    if (patt != "none") {
                        if (patt.substring(0, 5) == "empty") {
                            $(this).find("input").on("keyup", function () {
                                if ($(this).val().length < patt.split("-")[1]) {
                                    validateTrue($(this));
                                } else {
                                    validateFalse($(this), nam);
                                }
                            });
                        } else {
                            var pattern = eval(patt);
                            $(this).find("input").on("keyup", function () {
                                if (!pattern.test($(this).val().trim())) {
                                    validateTrue($(this));
                                } else {
                                    validateFalse($(this), nam);
                                }
                            });
                        }
                    }
                    if ($(this).find("input[type='text']").attr("data-date") != undefined && $(this).find("input[type='text']").attr("data-date") == "true") {
                        var idDate = $(this).find("input[type='text']").attr("id");
                        $(this).children().css("cursor", "pointer")
                        var options = {};
                        $('#' + idDate).datepicker(options);
                        $(this).find("input[type='text']").prop("readonly", true);
                    }
                    if ($(this).find("input[type='text']").attr("data-time") != undefined && $(this).find("input[type='text']").attr("data-time") == "true") {
                        var idDate = $(this).find("input[type='text']").attr("id");
                        $('#' + idDate).timePicker();
                    }
                });

                $(this).find(">div.commt").each(function () {
                    $(this).prepend("<label for='" + $(this).find("textarea").attr("id") + "'>" + $(this).find("textarea").attr("data-name") + "</label>");
                    $(this).prepend("<span>" + $(this).find("textarea").attr("data-label") + "</span>");
                    $(this).find("textarea").data({
                        "label": $(this).find("textarea").attr("data-label"),
                        "require": $(this).find("textarea").attr("data-require")
                    });
                    $(this).find("textarea").removeAttr("data-name");
                    $(this).find("textarea").removeAttr("data-label");
                    $(this).find("textarea").removeAttr("data-require");
                    if ($(this).find("textarea").text() == "") {
                        const $el = $(this).find("label");
                        velocity($el, {
                            "color": "#9e9e9e",
                            "margin-top": "0px",
                            "font-size": "16px"
                        }, 100)
                    } else {
                        const $el = $(this).find("label");
                        velocity($el, {
                            "margin-top": "-13px",
                            "font-size": "14px"
                        }, 100);
                    }
                    autosize($(this).find("textarea"));
                });

                $(this).find(">div.fl>div").each(function () {
                    var html = "<div class='loader-file'>\
										<div class='spinner'>\
										<div class='bounce1'></div>\
										<div class='bounce2'></div>\
										<div class='bounce3'></div>\
									</div>";
                    $(this).append("<span>" + $(this).find("input[type='file']").attr("data-button") + "</span>");
                    $(this).append("<p class='name'>" + $(this).find("input[type='file']").attr("data-name") + "</p>");
                    $(this).prepend("<label>" + $(this).find("input[type='file']").attr("data-label") + "</label>");
                    $(this).find("input[type='file']").data({
                        "label": $(this).find("input[type='file']").attr("data-label"),
                        "require": $(this).find("input[type='file']").attr("data-require")
                    });
                    $(this).find("input[type='file']").removeAttr("data-button");
                    $(this).find("input[type='file']").removeAttr("data-label");
                    $(this).find("input[type='file']").removeAttr("data-require");
                    $(this).append("<input type='text' value='No seleccionado' readonly class='flLabelMtrVal'>");
                    $(this).on("click", ".flLabelMtrVal", function () {
                        $(this).parent().find("input[type='file']").trigger("click");
                    })
                    $(this).parent().append(html);
                    $(this).append("<div class='img-file'><img src='#'></img><span>X</span></div>");
                    if ($(this).find("input[type='file']").attr("data-type") != undefined) {
                        $(this).find("input[type='file']").data().type = $(this).find("input[type='file']").attr("data-type");
                        $(this).find("input[type='file']").removeAttr("data-type");
                    }
                    $(this).on("change", function () {
                        var txt = $(this).find("input[type='file']").val();
                        var formt = $(this).find("input[type='file']").data().type.split(",");
                        var str, type, error = true;
                        if (txt == "") {
                            str = "No seleccionado";
                            type = "none";
                        } else {
                            str = txt.split("\\")[(txt.split("\\").length - 1)];
                            type = str.substring((str.lastIndexOf(".") + 1), (str.length));
                        }
                        $(this).find("input[type='text']").val(str);
                        if (type == "none" && eval($(this).find("input[type='file']").data().require) == false) {
                            $(this).find("input[type='text']").css({
                                "border-bottom": "#9e9e9e solid 2px",
                                "color": "#9e9e9e"
                            });
                            $(this).find("label").css("display", "none");
                            $(this).find("p.name").css("color", "#9e9e9e");
                        } else if (type != "none") {
                            for (var x = 0; x < formt.length; x++) {
                                if (type.trim().toLowerCase() == formt[x].trim().toLowerCase()) {
                                    error = false;
                                    break;
                                }
                            }
                            if (error == true) {
                                $(this).find("input[type='text']").css({
                                    "border-bottom": "#F44336 solid 2px",
                                    "color": "#F00"
                                });
                                $(this).find("label").css("display", "inline-block");
                                $(this).find("label").text($(this).find("input[type='file']").data().label);
                                $(this).find("p.name").css("color", "#F44336");
                                verify.change($(this));
                            } else {
                                $(this).find("input[type='text']").css({
                                    "border-bottom": "#9e9e9e solid 2px",
                                    "color": "#9e9e9e"
                                });
                                $(this).find("label").css("display", "none");
                                $(this).find("p.name").css("color", "#9e9e9e");
                            }
                        }
                    });
                });

                $(this).find(">div.rd").each(function () {
                    $(this).append("<label for='" + $(this).find("input").attr("id") + "'>" + $(this).find("input").attr("data-name") + "</label>")
                    $(this).find("input").data({
                        "label": $(this).find("input").attr("data-label"),
                        "require": $(this).find("input").attr("data-require")
                    });
                    $(this).find("input").removeAttr("data-name");
                    $(this).find("input").removeAttr("data-require");
                    $(this).find("input").removeAttr("data-label");
                });

                $(this).find(">div.ck").each(function () {
                    $(this).append("<label for='" + $(this).find("input").attr("id") + "'>" + $(this).find("input").attr("data-name") + "</label>")
                    $(this).find("input").data({
                        "label": $(this).find("input").attr("data-label"),
                        "require": $(this).find("input").attr("data-require")
                    });
                    $(this).find("input").removeAttr("data-name");
                    $(this).find("input").removeAttr("data-require");
                    $(this).find("input").removeAttr("data-label");
                });

                $(this).find(">div.slct>div").each(function () {
                    var lbl = $(this).find("select.sgl, select.mlt").attr("data-label");
                    var nme = $(this).find("select.sgl, select.mlt").attr("data-name");
                    $(this).find("select.sgl, select.mlt").data({
                        "label": $(this).find("select.sgl").attr("data-label"),
                        "require": $(this).find("select.sgl, select.mlt").attr("data-require")
                    });
                    $(this).append("<label for='" + $(this).find("select.sgl, select.mlt").attr("id") + "'></label>");
                    $(this).prepend("<span>" + lbl + "</span>");
                    $(this).prepend("<p class='name'>" + nme + "</p>");
                    if ($(this).find("select").hasClass("sgl")) {
                        $(this).append("<input type='text' readonly value='" + $(this).find("select.sgl>option:selected").text() + "'>");
                    } else {
                        $(this).find("select.mlt").data("validate", $(this).find("select.mlt").attr("data-validate"));
                        $(this).find("select.mlt").removeAttr("data-validate");
                        $(this).append("<div class='mt-select-input'>" + $(this).find("select.mlt>option:selected").text() + "</div>");
                        $(this).find("select.mlt").data().values = [];
                    }
                    $(this).find("select.sgl, select.mlt").removeAttr("data-require");
                    $(this).find("select.sgl, select.mlt").removeAttr("data-label");
                    $(this).find("select.sgl, select.mlt").removeAttr("data-name");
                    $(this).on("change", function () {
                        if ($(this).find("select").hasClass("sgl")) {
                            $(this).find("input").val($(this).find("select.sgl>option:selected").text());
                        } else {
                            var numbers = parseInt($(this).find("select.mlt").data().validate);
                            if ((numbers - 1) <= $(this).find(".mt-select-input>p").length) {
                                $(this).removeClass("error");
                            }
                            if ($(this).find("div.mt-select-input > p").length == 0) {
                                $(this).find("div.mt-select-input").css("padding-bottom", "8px");
                                $(this).find("div.mt-select-input").text("Selecciona otra opción:");
                                $(this).find("select.mlt>option:first").text("Selecciona otra opción:");
                                $(this).find("div.mt-select-input").prepend("<p class='mt-select-option'><span class='mt-select-text-opt'>" + $(this).find("select.mlt>option:selected").text() + "<span class='mt-select-eliminate-opt' data-val='" + $(this).find("select.mlt>option:selected").val() + "'>x</span></span></p>");
                            } else {
                                $(this).find("div.mt-select-input p:last").after("<p class='mt-select-option'><span class='mt-select-text-opt'>" + $(this).find("select.mlt>option:selected").text() + "<span class='mt-select-eliminate-opt' data-val='" + $(this).find("select.mlt>option:selected").val() + "'>x</span></span></p>");
                            }
                            $(this).find("select.mlt").data().values.push($(this).find("select.mlt>option:selected").val());
                            $(this).find("select.mlt>option:selected").prop("disabled", true);
                            $(this).find("select.mlt>option:first").prop("selected", true)
                        }
                    });
                    if ($(this).find("select").hasClass("mlt")) {
                        if ($(this).find("select.mlt").attr("data-optionsSelected") !== undefined) {
                            var aux = $(this).find("select.mlt").attr("data-optionsSelected").trim();
                            if (aux != "") {
                                aux = aux.split(",");
                                $(this).find("select.mlt").data().values = aux;
                                $(this).find("select.mlt").removeAttr("data-optionsSelected");
                                for (var w = 0; w < aux.length; w++) {
                                    if ($(this).find("div.mt-select-input > p").length == 0) {
                                        $(this).find("div.mt-select-input").css("padding-bottom", "8px");
                                        $(this).find("div.mt-select-input").text("Selecciona otra opción:");
                                        $(this).find("select.mlt>option:first").text("Selecciona otra opción:");
                                        $(this).find("div.mt-select-input").prepend("<p class='mt-select-option'><span class='mt-select-text-opt'>" + $(this).find("select.mlt>option[value='" + aux[w] + "']").text() + "<span class='mt-select-eliminate-opt' data-val='" + aux[w] + "'>x</span></span></p>");
                                    } else {
                                        $(this).find("div.mt-select-input p:last").after("<p class='mt-select-option'><span class='mt-select-text-opt'>" + $(this).find("select.mlt>option[value='" + aux[w] + "']").text() + "<span class='mt-select-eliminate-opt' data-val='" + aux[w] + "'>x</span></span></p>");
                                    }
                                    $(this).find("select.mlt>option[value='" + aux[w] + "']").prop("disabled", true);
                                }
                            }
                        }
                    }

                });


                $(this).find(">div.txt>input").on("focus", function () {
                    if ($(this).prop('readonly')) {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#3490E7",
                            "margin-top": "-18px",
                            "font-size": "14px"
                        }, 100);
                        $(this).css("border-bottom", "#3490E7 2px solid");
                        return false;
                    }
                    if ($(this).data().date === true) {
                        $(this).parent().find("label").data("error", false);
                        $(this).parent().find(">span").hide();
                    }
                    if ($(this).parent().find("label").data("error") == true) {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#F44336",
                            "margin-top": "-18px",
                            "font-size": "14px"
                        }, 100);
                    } else {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#3490E7",
                            "margin-top": "-18px",
                            "font-size": "14px"
                        }, 100);
                        $(this).css("border-bottom", "#3490E7 2px solid");
                    }
                })
                $(this).find(">div.txt>input").on("blur", function () {
                    if ($(this).prop('readonly')) {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#9e9e9e"
                        }, 100);
                        $(this).css("border-bottom", "#9e9e9e 2px solid");
                        return false;
                    }
                    if ($(this).val() == "") {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "margin-top": "0px",
                            "font-size": "16px"
                        }, 100);
                        if (eval($(this).data().require) == false) {
                            const $el = $(this).parent().find("label")
                            velocity($el, {
                                "color": "#9e9e9e"
                            }, 100);
                            $(this).parent().find("span").css("display", "none");
                            $(this).css("border-bottom", "#9e9e9e 2px solid");
                            $(this).parent().find("label").data("error", "false");
                        }
                    }
                    if ($(this).parent().find("label").data("error") == true) {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#F44336"
                        }, 100);
                    } else {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#9e9e9e"
                        }, 100);
                        $(this).css("border-bottom", "#9e9e9e 2px solid");
                    }
                });
                $(this).find(">div.rd>input[type='radio']").on("change", function () {
                    if ($(this).parent().find("label").hasClass("error")) {
                        $(this).parent().parent().find("label").removeClass("error");
                        $(this).parent().parent().find(".rd-label>span").css({
                            "visibility": "hidden"
                        });
                    }
                });
                $(this).find(">div.ck>input[type='checkbox']").on("change", function () {
                    if ($(this).parent().find("label").hasClass("error")) {
                        $(this).parent().parent().find("label").removeClass("error");
                        $(this).parent().parent().find(".ck-label>span").css({
                            "visibility": "hidden"
                        });
                    }
                });
                $(this).find(">div.slct>div>select.sgl").on("change", function () {
                    if ($(this).parent().hasClass("error")) {
                        $(this).parent().removeClass("error");
                    }
                });
                $(this).find(">div.commt>textarea").on("keyup", function () {
                    if ($(this).parent().hasClass("error")) {
                        $(this).parent().removeClass("error");
                        $(this).parent().find("label").css({
                            "color": "#3490E7"
                        });
                    }
                });
                $(this).find(">div.commt>textarea").on("focus", function () {
                    if ($(this).prop('readonly')) {
                        return false;
                    }

                    if (!$(this).parent().hasClass("error")) {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "color": "#3490E7",
                            "margin-top": "-13px",
                            "font-size": "14px"
                        }, 100);
                    } else {
                        const $el = $(this).parent().find("label");
                        velocity($el, {
                            "margin-top": "-13px",
                            "font-size": "14px"
                        }, 100);
                    }
                })
                $(this).find(">div.commt>textarea").on("blur", function () {
                    if ($(this).prop('readonly')) {
                        return false;
                    }
                    if ($(this).parent().hasClass("error")) {
                        if ($(this).val().trim() == "") {
                            const $el = $(this).parent().find("label");
                            velocity($el, {
                                "margin-top": "0px",
                                "font-size": "16px"
                            }, 100)
                        }
                    } else {
                        if ($(this).val().trim() == "") {
                            const $el = $(this).parent().find("label");
                            velocity($el, {
                                "color": "#9e9e9e",
                                "margin-top": "0px",
                                "font-size": "16px"
                            }, 100)
                        } else {
                            const $el = $(this).parent().find("label")
                            velocity($el, {
                                "color": "#9e9e9e"
                            }, 100)
                        }
                    }
                });
                $(this).addClass("mt-check");
            }
        });
    }

    $("body").on("click", " .mt-form .slct>div>.mt-select-input>.mt-select-option>span>.mt-select-eliminate-opt", function () {
        var valueOpt = $(this).data().val;
        $(this).closest("div.slct").find("select.mlt>option[value='" + valueOpt + "']").prop("disabled", false);
        if ($(this).closest(".mt-select-input").find(">p").length == 1) {
            $(this).closest("div.slct").find("select.mlt").data().values = [];
            $(this).closest(".mt-select-input").css("padding-bottom", "0");
            $(this).closest("div.slct").find("select.mlt>option:first").text("Selecciona una opción:");
            $(this).closest(".mt-select-input").text("Selecciona una opción:");
        } else {
            var aux = $(this).closest("div.slct").find("select.mlt").data().values;
            $(this).closest("div.slct").find("select.mlt").data().values = [];
            for (var w = 0; w < aux.length; w++) {
                if (aux[w] == valueOpt) {
                    delete aux[w];
                    break;
                }
            }
            for (var w = 0; w < aux.length; w++) {
                if (aux[w] != undefined) {
                    $(this).closest("div.slct").find("select.mlt").data().values.push(aux[w]);
                }
            }
        }
        $(this).closest(".mt-select-option").remove();
    })

    $.fn.mtValidate = function () {
        verify.start();
        $($(this).data().check + " input[type='text']," + $(this).data().check + " input[type='password']").each(function () {
            if (eval($(this).data().require) == true || (eval($(this).data().require) == false && $(this).val() != "")) {
                $(this).trigger("keyup");
                $(this).trigger("blur");
                if ($(this).val().trim() == "") {
                    $(this).parent().find("label>span").text("Campo requerido");
                }
            }
        });
        $($(this).data().check + " input[type='radio']").parent().parent().each(function () {
            if (eval($(this).find(".rd input[type='radio']").data().require)) {
                var checked = false;
                $(this).find(".rd input[type='radio']").each(function () {
                    if ($(this).prop("checked")) {
                        checked = true;
                    }
                });
                if (!checked) {
                    $(this).find(".rd label").addClass("error");
                    $(this).find(".rd-label>span").css({
                        "visibility": "visible"
                    });
                    verify.change($(this));
                }
            }
        });
        $($(this).data().check + " input[type='checkbox']").parent().parent().each(function () {
            if (eval($(this).find(".ck input[type='checkbox']").data().require)) {
                var checked = false;
                $(this).find(".ck input[type='checkbox']").each(function () {
                    if ($(this).prop("checked")) {
                        checked = true;
                    }
                });
                if (!checked) {
                    $(this).find(".ck label").addClass("error");
                    $(this).find(".ck-label>span").css({
                        "visibility": "visible"
                    });
                    verify.change($(this));
                }
            }
        });
        $($(this).data().check + " select.sgl").parent().parent().each(function () {
            if (eval($(this).find("select.sgl").data().require)) {
                if ($(this).find("select.sgl>option:selected").val() == "none") {
                    $(this).find(">div").addClass("error");
                    verify.change($(this));
                }
            }
        });
        $($(this).data().check + " select.mlt").parent().parent().each(function () {
            if (eval($(this).find("select.mlt").data().require)) {
                var numbers = parseInt($(this).find("select.mlt").data().validate);
                if (numbers > $(this).find(".mt-select-input>p").length) {
                    $(this).find(">div").addClass("error");
                    verify.change($(this));
                }
            }
        });
        $($(this).data().check + " textarea").parent().each(function () {
            if (eval($(this).find("textarea").data().require)) {
                if ($(this).find("textarea").val().trim() == "") {
                    $(this).addClass("error");
                    verify.change($(this));
                }
            }
        });
        $($(this).data().check + " input[type='file']").parent().each(function () {
            if (eval($(this).find("input[type='file']").data().require) == true || eval($(this).find("input[type='file']").data().require) == false && $(this).find("input[type='file']").val() != "") {
                $(this).find("input[type='file']").trigger("change");
                if ($(this).find("input[type='file']").val().trim() == "") {
                    $(this).find("input[type='text']").css({
                        "border-bottom": "#F44336 solid 2px",
                        "color": "#F00"
                    });
                    $(this).find("p.name").css("color", "#F44336");
                    $(this).find("label").css("display", "inline-block");
                    $(this).parent().find("div>label").text("Campo requerido");
                    verify.change($(this));
                }
            }
        });
        var elementShow = verify.showElement();
        if (elementShow != undefined) {
            const $el = $(elementShow);
            velocity($el, "scroll", {
                offset: "-20px"
            });
        }
        return verify.show();
    };

    $.fn.mtError = function () {
        var element = $(this).parent().find("label");
        const $el = $(this);
        velocity($el, "scroll", {
            offset: "-20px"
        });
        var elementObject = {
            parent: $(this),
            html: element,
            modificarCss: function () {
                this.parent.css({
                    "border-bottom": "#F44336 solid 2px"
                });
                this.html.css({
                    "color": "#F44336"
                });
            }
        };
        setTimeout($.proxy(elementObject, "modificarCss"), 200);
    };
})(jQuery);