try 
{
	var socket = io.connect("http://pasevic.local:3000");	
}
catch(err)
{
	console.log("Connection socket failed");
}


(function()
{
	function getTypeMuro()
	{
		var type = $(".ptdDcMuro").prop("tftx");
		return type;
	}

	function getURLAfter(number)
	{
		var url = window.location.href;
		var url = url.split("/");
		number = number+1;
		var tama = url.length;
		var urlAfter = "";

		for(var x=number;x<tama;x++)
		{
			if(x+1 == tama)
			{
				urlAfter += url[x];
			}
			else
			{
				urlAfter += url[x]+"/";
			}
		}
		return urlAfter;
	}

	function isHeaderUser()
	{
		var header = $("header").hasClass("usr-ssn");
		var img = $("#content-sesion figure").hasClass("userSessImg");

		return header && img;
	}

	function closeMessage()
	{
		$(".message-alert").hide();
		$(".message-alert .bodyMessage").velocity("transition.expandOut",1);
	}

	function isJson(data)
	{
		var res = [];
		try 
    	{
			var info = JSON.parse(data);
			res[0] = true;
			res[1] = info;
    	}
    	catch(err) 
    	{ 
			res[0] = false;
			res[1] = "";
    	}
    	return res;
	}

	function ajaxView(link,data,callback)
	{
		closeMessage();
		if(isHeaderUser())
		{
			if(localStorage.USR_SESS === undefined)
			{
				data.USR_SESS = "@UNDEFINED";
			}
			else
			{
				data.USR_SESS = $(".usr-ssn").data().USR_SESS;
			}
		}
		$.ajax({
			type: "POST",
			url: link,
			data: data,
			success: function(data){

				var info = isJson(data);
				if(info[0] == false)
				{
					callback(data);
				}
				else
				{
					if(info[1].rdirUsrSessUrl == "@accessRequired")
					{
						$(".btn-sesion").trigger("click");
					}
					else
					{
						var functionAceptar = recargar;
						openAlert(info[1].titlRdir,info[1].messRdir,"message","Aceptar","none",functionAceptar);
						function recargar()
						{
							setTimeout(function(){
								window.location = URL_GLOBAL+info[1].rdirUsrSessUrl;
							}, 100); 
						}
					}
				}
			}
		});
	}

	socket.on("getLikeWall",function(data){
		if(getURLAfter(2) == data.url)
		{
			$(".likes").text(data.can);
		}

	});

	socket.on("getLikeComment",function(data){
		if(getURLAfter(2) == data.url)
		{
			var pub = $(".publicacion-proyecto[data-idp='"+data.idP+"']");
			if(pub.length > 0)
			{
				pub.find(".likesPublicaciones").text(data.can);
			}
		}
	});

	socket.on("getComment",function(data){
		if(getURLAfter(2) == data.url)
		{
			var pub = $(".publicacion-proyecto[data-idp='"+data.idP+"']");
			if(pub.length > 0)
			{
				pub.find(".infoPublicacion .comentariosPublicaciones").text(data.can);
				if(pub.find(".contenedorComentariosPublicaciones").css("display") == "block")
				{
					var mod = getTypeMuro();
			    	var link = "buscarComentario";
			    	var data = {comm:"req",idC:data.idC,idP:data.idP,usr:data.usr,url:getURLAfter(3),type:mod};
					var callback = function(data)
					{
			        	if(pub.find(".contenedorPublicarComentario").length == 0)
			        	{
			        		pub.find(".contenedorComentariosPublicaciones").prepend(data);
			        	}
			        	else
			        	{
			        		pub.find(".contenedorPublicarComentario").after(data);
			        	}
			        	pub.find(".contenedorComentariosPublicaciones .comentarioPublicado").first().velocity("transition.slideDownBigIn",1000);
					};
					ajaxView(link,data,callback);
				}
			}
		}
	});

	socket.on("getPublication",function(data){
		if(getURLAfter(2) == data.url)
		{
			var pub = $(".cntPubMuro");
	    	var link = "buscarPublicacion";
	    	var data = {comm:"req",url:getURLAfter(3),idP:data.idP,tp:data.tp};
			var callback = function(data)
			{
	        	if(pub.children().length == 0)
				{
					$(".cntDcMuro").removeClass("cntDcMuroVc");
				}
				pub.prepend(data);
				pub.children(":first").velocity("transition.slideDownBigIn",1000);
			};
			ajaxView(link,data,callback);
		}
	});

})();