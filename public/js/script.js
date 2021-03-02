$(function($){

	//$("body>div").hide().show("drop");
	//iniciarSecionEfecto("pasevic");



	/*
	function aparecerLog(tipo)
	{
		$(".sec-ini").hide("puff",function(){
			$(".sec-log>h2").text("Iniciar sesión como "+tipo+":");
			$(".sec-log").show("scale");
			$(".menu-explorer").hide();
		});
	}
	function detalleProyecto()
	{
		$(".expl-proyectos").hide("drop",function(){
			$(".detalle-proyecto").show("drop");
			$(".menu-explorer").hide();
		});
	}
	function iniciarSecionEfecto(tipo)
	{
		$("body>div").hide("drop",function(){
			$("header>section").hide();
			$(".sec-ini").hide();
			$(".sec-log").hide();
			$(".sec-"+tipo).show();
			$(".expl-proyectos").show();
			$(this).show("drop");
			$(".menu-explorer").hide();
			$(".boton-explorar").show();
			$(".boton-explorar").css("top","0.5em");
		});
	}
	$(".QrCodigo").on("click",function(){
		$(this).remove();
		$(".detalle-proyecto").append("<div id=\"qrcode\"></div>");
		var codigo = window.location.href.split("/");
		$('#qrcode').qrcode("192.168.0.100/pasevic/"+codigo[codigo.length-1]);
		return false;
	});
	$(".sec-ini>p:nth-child(3)").on("click",function(){
		$("#iniciar").attr("id","iniciar-docente");
		aparecerLog("docente");

	});
	$("body").on("click","#iniciar-pasevic",function(){
		iniciarSecionEfecto("pasevic");
		$("#iniciar-pasevic").attr("id","iniciar");
	});
	$("body").on("click","#iniciar-docente",function(){
		iniciarSecionEfecto("docente");
		$("#iniciar-docente").attr("id","iniciar");
	});
	$("#invitado").on("click",function(){
		iniciarSecionEfecto("invitado");
	});
	$("body").on("click",".revisar-button",function(){
		detalleProyecto();
	})
	$("h1").on("click",function(){
		$("body>div").hide("drop",function(){
			$("header>section").show();
			$("body>div>section").hide();
			$(".sec-ini").show();
			$(this).show("drop");
		});
	});
	$("li").on("click",function(){
		$(this).find(".submenu").show("blind","fast");
		$(this).on("mouseleave",function(){
			$(this).find(".submenu").hide("blind","fast");
		})
	});
	$("#secForo").on("click",function(){
		$(".expl-proyectos").hide("drop",function(){
			$(".sec-preguntas").hide("drop",function(){
				$(".sec-foro").show("drop");
			});
		});
	});
	$("#secAyuda").on("click",function(){
		$(".expl-proyectos").hide("drop",function(){
			$(".sec-foro").hide("drop",function(){
				$(".sec-preguntas").show("drop");
			});
		});
	});
	$("#secDocente").on("click",function(){
		$(".sec-foro").hide("drop",function(){
			$(".sec-preguntas").hide("drop",function(){
				$(".expl-proyectos").show("drop");
			});
		});
	});
	$(".boton-explorar").on("click",function(){
		$(".menu-explorer").show();
		$(".boton-explorar").hide();
	});
	$("body").on("click","#iniciar",function(){
		var user = $("#inp-usuario").val();
		var password = $("#inp-password").val();

		var link = "pasevic_secion";
		var data = {usuario: user, clave: password};
		var callback = function(data)
		{
	    	window.location.href = "logueo";
		};
		requestView(link,data,callback);
	});*/



/* ARCHIVOS MENU */


/* ARCHIVOS MENU*/



/*   MODULOS   */

/*   MODULOS   */


/* GO URL */

/* GO URL */




/* CONFIGURACION */


/* CONFIGURACION */





/*  FORM ADMINISTRADORES */

	


/*  FORM ADMINISTRADORES */




/*   FORM ALIANZAS   */


	




/*   FORM ALIANZAS   */






/*  FORM DOCENTES */

	


/*  FORM DOCENTES */





/*  FORM REGISTRO-DOCENTES */



/*  FORM REGISTRO-DOCENTES */


/*  FORM ESCUELAS */

	


/*  FORM ESCUELAS */






/*  FORM PROYECTOS */


	



	



/*  FORM PROYECTOS */







/*  FORM MODULOS */

/*  FORM MODULOS */









/* FORM CICLOSESCOLARES */


	

/* FORM CICLOSESCOLARES */




/*  FORM CARPETAS  */

	/*$("#webContent").on("click",".btnCancelCarpetasProyectos",function()
	  {
	    $("#menu-pc-sesion li[data-file*='formCarpetasProyectos']").trigger("click");

	  });

	$("#webContent").on("click","#btnNuevaCarpetaProyecto",function()
	{
		loadingContent();
		var link = "formRegistrarCarpetasProyectos";
		var data = {comm: "req"};
		var callback = function(data)
		{
			$("#webContent").html(data);
			$.mtStart();
        	$('#tblProyectosCarpetas').bootstrapTable();
        	$(".fixed-table-header").remove();
        	$('#tblProyectosCarpetas').bootstrapTable('hideColumn', 'Id');
			$.mtSearch();
			loadedContent();
		};
		requestView(link,data,callback);
	});

	$("#webContent").on("click","#btnCreateCarpetasProyecto",function()
	{
		var error = $(this).mtValidate();

		var nombre_carpeta = $("#nombre-carpeta-proyecto").val();

		var seleccionado = false;

	    $($('#tblProyectosCarpetas').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });

	    var arrayDatos = eval(JSON.stringify($("#tblProyectosCarpetas").bootstrapTable('getSelections')));

	    var array_ids_proyectos = [];

		for(var x=0 ; x < arrayDatos.length; x++)
		{
			var nuevo = {"id_proyecto" : arrayDatos[x].Id};
			array_ids_proyectos.push(nuevo);
		}

		var joinProyects ="";

	    if (seleccionado)
	    {
	    	joinProyects = "1";

	    	if(error == false)
	    	{
	    		loadingPage();
				var link = "registrarCarpetasProyectos";
				var data = {comm: "req", array_ids_proyectos:array_ids_proyectos, nombre_carpeta:nombre_carpeta, joinProyects:joinProyects};
				var callback = function(info)
				{
					loadedPage();
					if(info.mensaje == true)
					{
						openMessage("#5cb85c","#FFF",info.resultado);
						$("#menu-pc-sesion li[data-file*='formCarpetasProyectos']").trigger("click");
					}
					else
					{
						openMessage("#F00","#FFF",info.resultado);
					}
				};
				requestJson(link,data,callback);
	    	}
	    }
	    else
	    {
	    	if(error == false)
	    	{
	    		if(confirm("¿Esta seguro que desea crear la carpeta sin asignarle un proyecto ?"))
		    	{
		    		joinProyects = "";
		    		var array_ids_proyectos = [];
		    		loadingPage();
					var link = "registrarCarpetasProyectos";
					var data = {comm: "req", array_ids_proyectos:array_ids_proyectos, nombre_carpeta:nombre_carpeta, joinProyects:joinProyects};
					var callback = function(info)
					{
						loadedPage();
						if(info.mensaje == true)
						{
							openMessage("#5cb85c","#FFF",info.resultado);
							$("#menu-pc-sesion li[data-file*='formCarpetasProyectos']").trigger("click");
						}
						else
						{
							openMessage("#F00","#FFF",info.resultado);
						}
					};
					requestJson(link,data,callback);
		    	}
	    	}
	    }
	});

	$("#webContent").on("click","#btnConsultarCarpetaProyecto",function()
	{
		var seleccionado = false;

	    $($('#tblCarpetasProyectos').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });

	    if(seleccionado)
	    {
	    	var datos = eval(JSON.stringify($("#tblCarpetasProyectos").bootstrapTable('getSelections')));
			var id_carpeta = datos[0].Id;
			loadingContent();
			var link = "consultarCarpetasProyectos";
			var data = {comm:"req",id_carpeta:id_carpeta};
			var callback = function(data)
			{
				$("#webContent").html(data);
				$.mtStart();
            	$('#tblProyectosCarpetas').bootstrapTable();
            	$(".fixed-table-header").remove();
            	$('#tblProyectosCarpetas').bootstrapTable('hideColumn', 'Id');
            	$.mtSearch();
				loadedContent();
			};
			requestView(link,data,callback);
		}
		else
	    {
	    	openAlert("Seleccione un registro","Debe seleccionar un registro.","message");
	    }
	});

	$("#webContent").on("click","#btnModificarCarpetaProyecto",function()
	{
		var seleccionado = false;

	    $($('#tblCarpetasProyectos').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });

	    if(seleccionado)
	    {
	    	var datos = eval(JSON.stringify($("#tblCarpetasProyectos").bootstrapTable('getSelections')));
			var id_carpeta = datos[0].Id;

			loadingContent();
			var link = "formModificarCarpetasProyectos";
			var data = {comm:"async",id_carpeta:id_carpeta};
			var callback = function(data)
			{
				$("#webContent").html(data);
				$.mtStart();
	        	$('#tblProyectosCarpetas').bootstrapTable();
	        	$(".form-registrar-carpeta-proyecto .fixed-table-header").remove();
	        	$('#tblProyectosCarpetas').bootstrapTable('hideColumn', 'Id');
	        	$('#tblProyectosSinCarpetas').bootstrapTable();
	        	$(".form-registrar-carpeta-proyecto .fixed-table-header").remove();
	        	$('#tblProyectosSinCarpetas').bootstrapTable('hideColumn', 'Id');
	        	$.mtSearch();
				loadedContent();
			};
			requestView(link,data,callback);
		}
		else
	    {
	    	openAlert("Seleccione un registro","Debe seleccionar un registro.","message");
	    }
	});

	$("#webContent").on("click",".btnUnirCarpetasProyectos",function()
	{
		var seleccionado = false;

		$($('#tblProyectosSinCarpetas').bootstrapTable('getSelections')).each(function (index, value)
	    {
			seleccionado = true;
	    });

	 	if(seleccionado== true)
	 	{
	 		var array_ids_proyectos = [];
			var arrayDatos = eval(JSON.stringify($("#tblProyectosSinCarpetas").bootstrapTable('getSelections')));
	 		for(var x=0 ; x < arrayDatos.length; x++)
	 		{
	 			var nuevo = {"id_proyecto" : arrayDatos[x].Id};
	 			array_ids_proyectos.push(nuevo);
	 		}
	 	}

	    var nombre_carpeta = $("#nombre-carpeta-proyecto").val().trim();

	    var id_carpeta = $("#nombre-carpeta-proyecto").attr("data-id_carp");

	    var joinProyects ="";

		if(seleccionado)
		{
			joinProyects = "1";
		}

		var link = "modificarUnionProyectosCarpeta";
		var data = {comm:"req", id_carpeta:id_carpeta, array_ids_proyectos:array_ids_proyectos, nombre_carpeta:nombre_carpeta, joinProyects:joinProyects};
		loadingModal();
		var callback = function(info)
		{
			loadedModal();
			if(info.mensaje == true)
			{
				closeModal();

				openMessage("#5cb85c","#FFF",info.resultado);

				$("#menu-pc-sesion li[data-file*='formCarpetasProyectos']").trigger("click");
			}
			else
			{
				openMessage("#F00","#FFF",info.resultado);
			}

		};
		requestJson(link,data,callback);
	});

	$("#webContent").on("click","#btnQuitarProyectoDeCarpeta",function()
	{
		var seleccionado = false;

		$($('#tblProyectosCarpetas').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });

		if(seleccionado)
	    {

	    	function bajaProyectoDeCarpeta(){

                var link = "formBajaProyectoCarpeta";
                var datos = eval(JSON.stringify($("#tblProyectosCarpetas").bootstrapTable('getSelections')));
                var id_proyecto = datos[0].Id;
				var nombre_proyecto = datos[0].Nombre;
				var nombre_carpeta = $(".form-registrar-carpeta-proyecto h4 span").text();
				var id_carpeta = $("#nombre-carpeta-proyecto").attr("data-id_carp");

                $(this).load(link,{comm:"async",nombre_proyecto:nombre_proyecto,nombre_carpeta:nombre_carpeta},function(){
                 	loadedModal();
                	$("#btnBajaProyectoCarpeta").on("click",function()
                	{
                		var link = "bajaProyectoCarpeta";
                		var data = {comm:"req",id_proyecto:id_proyecto,"id_carpeta":id_carpeta,nombre_carpeta:nombre_carpeta};
                		loadingModal();
                		var callback = function(info)
                		{
                			loadedModal();
	                        if(info.mensaje == true)
	                        {
	                            closeModal();
	                            var datos = eval(JSON.stringify($("#tblProyectosCarpetas").bootstrapTable('getSelections')));
	                            datos[0].state = false;

	                           $('#tblProyectosSinCarpetas').bootstrapTable('prepend',datos);
	                            $('#tblProyectosCarpetas').bootstrapTable('remove',{field:'Id', values: [id_proyecto]});

	                            openMessage("green","#FFF",info.resultado);

	                        }
	                        else
	                        {
	                            openMessage("#F00","#FFF",info.resultado);
	                        }

                		};
                		requestJson(link,data,callback);
                	});
                });
            }
            openModal(bajaProyectoDeCarpeta);
	    }
	    else
	    {
	    	openAlert("Seleccione un registro","Debe seleccionar un registro.","message");
	    }
	});

	$("#webContent").on("click","#btnEliminarCarpetaProyecto",function()
	{
		var seleccionado = false;

	    $($('#tblCarpetasProyectos').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });
	    if(seleccionado)
	    {
			function bajaCarpeta(){
                var link = "formBajaCarpetas";
                var datos = eval(JSON.stringify($("#tblCarpetasProyectos").bootstrapTable('getSelections')));
				var id_carpeta = datos[0].Id;
				var nombre_carpeta = datos[0].Nombre;
				loadingModal();
				var data = {comm:"async",id_carpeta:id_carpeta,nombre_carpeta:nombre_carpeta};
				var callback = function(data)
				{
					$(".window-modal").html(data);
					loadedModal();
                	$("#btnBajaCarpeta").on("click",function(){
                		loadingModal();
						var link = "eliminarCarpetasProyectos";
						var data = {comm:"req","id_carpeta":id_carpeta};
						var callback = function(info)
						{
							loadedModal();
                            if(info.mensaje == true)
                            {
                                closeModal();
                                var datos = JSON.parse((JSON.stringify($("#tblCarpetasProyectos").bootstrapTable('getSelections'))));
                                var id_proyecto = datos[0].Id;
                                datos[0].state = false;

                            	$('#tblCarpetasProyectosBaja').bootstrapTable('prepend',datos);
                            	$('#tblCarpetasProyectos').bootstrapTable('remove',{field:'Id', values: [id_proyecto]});
                                openMessage("#5cb85c","#FFF",info.resultado);
                                addClassAdministration($("#tblCarpetasProyectos"), "0");  //elementTable, type
                            }
                            else
                            {
                                openMessage("#F00","#FFF",info.resultado);
                            }
						};
						requestJson(link,data,callback);
					});
				};
				requestView(link,data,callback);
            }
            openModal(bajaCarpeta);
		}
		else
	    {
	    	openAlert("Seleccione un registro","Debe seleccionar un registro.","message");
	    }
	});

	$("#webContent").on("click","#btnAltaCarpetas",function()
	{
		var seleccionado = false;
	    $($('#tblCarpetasProyectosBaja').bootstrapTable('getSelections')).each(function (index, value)
	    {
	         seleccionado = true;
	    });

		if(seleccionado)
		{
			var datos = eval(JSON.stringify($("#tblCarpetasProyectosBaja").bootstrapTable('getSelections')));
            var id_carpeta = datos[0].Id;

			var link = "altaCarpetasProyectos";
			var data = {comm:"req","id_carpeta":id_carpeta};
			loadingPage();
			var callback = function(info)
			{
				loadedPage();
	            if(info.mensaje == true)
	            {
	                closeModal();
	                var datos = eval(JSON.stringify($("#tblCarpetasProyectosBaja").bootstrapTable('getSelections')));
	                var id_carpeta = datos[0].Id;
	                datos[0].state = false;

	            	$('#tblCarpetasProyectos').bootstrapTable('prepend',datos);
	            	$('#tblCarpetasProyectosBaja').bootstrapTable('remove',{field:'Id', values: [id_carpeta]});
	                openMessage("#5cb85c","#FFF",info.resultado);
	                addClassAdministration($("#tblCarpetasProyectosBaja"), "1");  //elementTable, type
	            }
	            else
	            {
	                openMessage("#F00","#FFF",info.resultado);
	            }
			};
			requestJson(link,data,callback);
		}
		else
	    {
	    	openAlert("Seleccione un registro","Debe seleccionar un registro.","message");
	    }
	});
*/

/*  FORM CARPETAS  */



/*  CHAT  */





/*  CHAT  */



/*   BÚSQUEDA   */

	


/*   BÚSQUEDA   */



	//$(window).load(function(){
    	//setTimeout(function(){$('#loader-principal').hide();$('body').css("overflow","auto");}, 300);


	//});


/*	$(window).bind('beforeunload', function () {
		return 'Los cambios que no hayan sido guardados se perderán';
	});*/

	

	/*function loadedImagesPage()
	{
		$("body").velocity("stop"); //Detener el bucle

		if(routing(1,"proyectos-participantes"))
		{
			var element = $(".fondoProyecto .backImg");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
			}
		}
		else if(routing(1,"modulos-participantes"))
		{
			var element = $(".fondoModulo .backImg");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
			}
		}
		else if(routing(1,"modulos"))
		{

			var element = $(".imgModulo .backImg");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
			}
		}
		else if(routing(1,"proyectos"))
		{

			var element = $(".imgProyecto .backImg");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
			}
		}
		else if(routing(1,"configuracion"))
		{
			var element = $("#imagen-configuracion img");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
			}
		}
		else if( (routing(1,"docentes") || (routing(1,"administradores")) || (routing(1,"asesores")) ) &&  !(routing(3,"proyectos") || routing(3,"modulos")) )
		{
			var element = $(".portada-usuario img");
			var arr = getDominantColor(element);
			if(arr.length != 0)
			{
				changeColorPrincipalNodes(arr[0], arr[1], arr[2]);
				setTimeout(function(){
					$(".tipo-usuario .contenido").css({
						"border-color":"rgba("+arr+",0.5)"
					});
					$(".mensaje").css({
						"border-color":"rgba("+arr+",0.5)"
					});
					$(".portada-usuario img").css({
						"border-color":"rgba("+arr+",0.5)"
					});
					$(".perfil-informacion .infoUsuario-header").css({
						"border-color":"rgba("+arr+",0.5)"
					});
				},400);
			}
		}
		else if(routing(3,"proyectos"))
		{
			$("#slEstadosProyecto option:eq(1)").prop("selected",true);
			$("#slCicloEscolar option:eq(1)").prop("selected",true);

			defaultColorPrincipalNodes();
		}
		else
		{
			defaultColorPrincipalNodes();
		}
	}*/

	


	

	
});
//jQuery.noConflict();
