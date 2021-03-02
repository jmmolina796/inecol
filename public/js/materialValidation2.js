(function($){
	$(function(){
		var verify = {
			error: false,
			start: function()
			{
				this.error = false;
			},
			change: function()
			{
				this.error = true;
			},
			show: function(){
				return this.error;
			}
		}


		$.mtSearch = function(){
			$(".fixed-table-container div.filterControl").each(function(index){
				if(!$(this).hasClass("mt-check"))
				{
					$(this).find(">input[type='text']").attr("id","search-"+index);
					$(this).append("<label for='search-"+index+"'>Buscar: </label>");
					
					if($(this).find("input").val().trim() != "")
					{
						$(this).find("label").velocity("slideUp",250);
					}
					

					$(this).find(">input[type='text']").on("focus",function(){
						$(this).parent().find("label").velocity("slideUp",250);
						$(this).css("border-bottom","#22bce0 2px solid");
					})
					

					$(this).find(">input[type='text']").on("blur",function(){
						if( $(this).val() == ""  )
						{
							$(this).parent().find("label").velocity("slideDown",250)
						}
						$(this).parent().find("label").velocity({"color":"#9e9e9e"},100);
						$(this).css("border-bottom","#9e9e9e 2px solid");
					});
					$(this).addClass("mt-check");
				}
			});
		}


		$.mtStart = function(){
			function validateTrue(element)
			{
				var label = element.parent().find("label");
				label.data("error",true);
				element.css({"border-bottom":"#F44336 solid 2px"});
				element.parent().find(">span").show();
				label.css({"color":"#F44336"});
				verify.change();
			}
			function validateFalse(element, nam)
			{
				var label = element.parent().find("label");
				label.data("error",false);
				element.parent().find(">span").hide();
				element.css({"border-bottom":"#22bce0 solid 2px"});
				label.css({"color":"#22bce0"});
				label.text(nam);
			}

			$(".mt-form").each(function(){
				if(!$(this).hasClass("mt-check"))
				{
					$(this).find(">input[type='text'],>input[type='password']").wrap("<div class='txt'></div>");
					$(this).find(">input[type='radio']").wrap("<div class='rd'></div>");
					$(this).find(">div.rd").parent().prepend("<div class='rd-label'><span></span></div>");
					$(this).find(">input[type='checkbox']").wrap("<div class='ck'></div>");
					$(this).find(">div.ck").parent().prepend("<div class='ck-label'><span></span></div>");
					$(this).find(">input[type='file']").wrap("<div class='fl'><div class='content-file'></div></div>");
					$(this).find(">textarea").wrap("<div class='commt'></div>");
					$(this).find(">select").wrap("<div class='slct'><div style='position:relative'></div></div>");
					$(this).find(".mt-button").each(function(){
						$(this).data("check", $(this).attr("data-check") );
						$(this).removeAttr("data-check");
					});

					$(this).find(">div.rd").parent().each(function(){
						$(this).find("div.rd-label>span").text($(this).find("input[type='radio']").attr("data-label"));
					});
					$(this).find(">div.ck").parent().each(function(){
						$(this).find("div.ck-label>span").text($(this).find("input[type='checkbox']").attr("data-label"));
					});

					$(this).find(">div.txt").each(function(){
						var nam = $(this).find("input").attr("data-name");
						var patt = $(this).find("input").attr("data-validate");
						var lbl = $(this).find("input").attr("data-label");
						$(this).append(" <span>"+lbl+"</span>");
						$(this).find("input").data({"label":$(this).find("input").attr("data-label"),"require":$(this).find("input").attr("data-require")});
						$(this).prepend("<label for='"+$(this).find("input").attr("id")+"'>"+nam+"</label>")
						$(this).find("input").removeAttr("data-name");
						$(this).find("input").removeAttr("data-validate");
						$(this).find("input").removeAttr("data-label");
						$(this).find("input").removeAttr("data-require");
						if($(this).find("input").val().trim() != "")
						{
							$(this).find("label").velocity({"margin-top":"-18px","font-size":"14px"},100);
							if( patt != "none" )
							{
								if(patt.substring(0,5) == "empty")
								{
									if($(this).find("input").val().length < patt.split("-")[1])	
									{
										validateTrue($(this).find("input"));
									}
								}
								else
								{
									var pattern = eval(patt);
									if( !pattern.test( $(this).find("input").val().trim() ) )
									{
										validateTrue($(this).find("input"));
									}
								}
							}
						}
						if( patt != "none" )
						{
							if(patt.substring(0,5) == "empty")
							{
								$(this).find("input").on("keyup",function(){
									if($(this).val().length < patt.split("-")[1])	
									{
										validateTrue($(this));
									}
									else
									{
										validateFalse($(this),nam);
									}
								});
							}
							else
							{
								var pattern = eval(patt);
								$(this).find("input").on("keyup",function(){
									if( !pattern.test( $(this).val().trim() ) )
									{
										validateTrue($(this));
									}
									else
									{
										validateFalse($(this),nam);
									}
								});
							}
						}
						if($(this).find("input[type='text']").attr("data-date") != undefined && $(this).find("input[type='text']").attr("data-date") == "true" )
						{
							var idDate = $(this).find("input[type='text']").attr("id");
							$(this).children().css("cursor","pointer")
							var options = {};
							$('#'+idDate).datepicker(options);
							$(this).find("input[type='text']").removeAttr("data-date");
							$(this).find("input[type='text']").on("click",function(){
								$(this).attr("readonly","readonly");
							})
						}
					});

					$(this).find(">div.commt").each(function(){
						$(this).prepend("<label for='"+$(this).find("textarea").attr("id")+"'>"+$(this).find("textarea").attr("data-name")+"</label>");
						$(this).prepend("<span>"+$(this).find("textarea").attr("data-label")+"</span>");
						$(this).find("textarea").data({"label":$(this).find("textarea").attr("data-label"),"require":$(this).find("textarea").attr("data-require")});
						$(this).find("textarea").removeAttr("data-name");
						$(this).find("textarea").removeAttr("data-label");
						$(this).find("textarea").removeAttr("data-require");
						if( $(this).find("textarea").text() == ""  )
						{
							$(this).find("label").velocity({"color":"#9e9e9e","margin-top":"0","font-size":"16px"},100)
						}
						else
						{
							$(this).find("label").velocity({"margin-top":"-13px","font-size":"14px"},100);
						}	
						autosize($(this).find("textarea"));
					});

					$(this).find(">div.fl>div").each(function(){
						var html = "<div class='loader-file'>\
										<div class='spinner'>\
										<div class='bounce1'></div>\
										<div class='bounce2'></div>\
										<div class='bounce3'></div>\
									</div>";
						$(this).append("<span>"+$(this).find("input[type='file']").attr("data-button")+"</span>");
						$(this).append("<p class='name'>"+$(this).find("input[type='file']").attr("data-name")+"</p>");
						$(this).prepend("<label>"+$(this).find("input[type='file']").attr("data-label")+"</label>");
						$(this).find("input[type='file']").data({"label":$(this).find("input[type='file']").attr("data-label"),"require":$(this).find("input[type='file']").attr("data-require")});
						$(this).find("input[type='file']").removeAttr("data-button");
						$(this).find("input[type='file']").removeAttr("data-label");
						$(this).find("input[type='file']").removeAttr("data-require");
						$(this).append("<input type='text' value='No seleccionado' disabled='disabled'></input>");
						$(this).parent().append(html);
						$(this).append("<div class='img-file'><img src='#'></img><span>X</span></div>");
						if( $(this).find("input[type='file']").attr("data-type") != undefined )
						{
							$(this).find("input[type='file']").data().type = $(this).find("input[type='file']").attr("data-type");
							$(this).find("input[type='file']").removeAttr("data-type");
						}
						$(this).on("change",function(){
							var txt = $(this).find("input[type='file']").val();
							var formt = $(this).find("input[type='file']").data().type.split(",");
							var str, type, error = true;
							if( txt == "" )
							{
								str = "No seleccionado";
								type = "none";
							}
							else
							{
								str = txt.split("\\")[(txt.split("\\").length-1)];
								type = str.substring((str.lastIndexOf(".")+1),(str.length));
							}
							$(this).find("input[type='text']").val( str );
							if(type == "none" && eval($(this).find("input[type='file']").data().require) == false)
							{
								$(this).find("input[type='text']").css({"border-bottom":"#9e9e9e solid 2px","color":"#9e9e9e"});
								$(this).find("label").css("display","none");
								$(this).find("p.name").css("color","#9e9e9e");
							}
							else if(type != "none")
							{
								for(var x=0;x<formt.length;x++)
								{
									if(type == formt[x].trim())
									{
										error = false;
										break;
									}
								}
								if(error == true)
								{
									$(this).find("input[type='text']").css({"border-bottom":"#F44336 solid 2px","color":"#F00"});
									$(this).find("label").css("display","inline-block");
									$(this).find("label").text($(this).find("input[type='file']").data().label);
									$(this).find("p.name").css("color","#F44336");
									verify.change();
								}
								else
								{
									$(this).find("input[type='text']").css({"border-bottom":"#9e9e9e solid 2px","color":"#9e9e9e"});
									$(this).find("label").css("display","none");
									$(this).find("p.name").css("color","#9e9e9e");
								}
							}
						});
					});
					
					$(this).find(">div.rd").each(function(){
						$(this).append("<label for='"+$(this).find("input").attr("id")+"'>"+$(this).find("input").attr("data-name")+"</label>")
						$(this).find("input").data({"label":$(this).find("input").attr("data-label"),"require":$(this).find("input").attr("data-require")});
						$(this).find("input").removeAttr("data-name");
						$(this).find("input").removeAttr("data-require");
						$(this).find("input").removeAttr("data-label");
					});
					
					$(this).find(">div.ck").each(function(){
						$(this).append("<label for='"+$(this).find("input").attr("id")+"'>"+$(this).find("input").attr("data-name")+"</label>")
						$(this).find("input").data({"label":$(this).find("input").attr("data-label"),"require":$(this).find("input").attr("data-require")});
						$(this).find("input").removeAttr("data-name");
						$(this).find("input").removeAttr("data-require");
						$(this).find("input").removeAttr("data-label");
					});

					$(this).find(">div.slct>div").each(function(){
						var lbl = $(this).find("select").attr("data-label");
						var nme = $(this).find("select").attr("data-name");
						$(this).find("select").data({"label":$(this).find("select").attr("data-label"),"require":$(this).find("select").attr("data-require")});
						$(this).append("<label for='"+$(this).find("select").attr("id")+"'></label>");
						$(this).prepend("<span>"+lbl+"</span>");
						$(this).prepend("<p class='name'>"+nme+"</p>");
						$(this).append("<input type='text' value='"+$(this).find("select>option:selected").text()+"'></input>");
						$(this).find("select").removeAttr("data-require");
						$(this).find("select").removeAttr("data-label");
						$(this).find("select").removeAttr("data-name");
						$(this).on("change",function(){
							$(this).find("input").val( $(this).find("select>option:selected").text() );
						});
					});

					$(this).find(">div.txt>input").on("focus",function(){
						if($(this).parent().find("label").data("error") == true)
						{
							$(this).parent().find("label").velocity({"color":"#F44336","margin-top":"-18px","font-size":"14px"},100);
						}
						else
						{
							$(this).parent().find("label").velocity({"color":"#22bce0","margin-top":"-18px","font-size":"14px"},100);
							$(this).css("border-bottom","#22bce0 2px solid");
						}
					})
					$(this).find(">div.txt>input").on("blur",function(){
						if( $(this).val() == ""  )
						{
							$(this).parent().find("label").velocity({"margin-top":"0","font-size":"16px"},100);
							if( eval($(this).data().require) == false )
							{
								$(this).parent().find("label").velocity({"color":"#9e9e9e"},100);
								$(this).parent().find("span").css("display","none");
								$(this).css("border-bottom","#9e9e9e 2px solid");
								$(this).parent().find("label").data("error","false");
							}
						}
						if($(this).parent().find("label").data("error") == true)
						{
							$(this).parent().find("label").velocity({"color":"#F44336"},100);
						}
						else
						{
							$(this).parent().find("label").velocity({"color":"#9e9e9e"},100);
							$(this).css("border-bottom","#9e9e9e 2px solid");
						}
					});
					$(this).find(">div.rd>input[type='radio']").on("change",function(){
						if( $(this).parent().find("label").hasClass("error") )
						{
							$(this).parent().parent().find("label").removeClass("error");
							$(this).parent().parent().find(".rd-label>span").css({"visibility":"hidden"});
						}
					});
					$(this).find(">div.ck>input[type='checkbox']").on("change",function(){
						if( $(this).parent().find("label").hasClass("error") )
						{
							$(this).parent().parent().find("label").removeClass("error");
							$(this).parent().parent().find(".ck-label>span").css({"visibility":"hidden"});
						}
					});
					$(this).find(">div.slct>div>select").on("change",function(){
						if( $(this).parent().hasClass("error") )
						{
							$(this).parent().removeClass("error");
						}
					});
					$(this).find(">div.commt>textarea").on("keyup",function(){
						if( $(this).parent().hasClass("error") )
						{
							$(this).parent().removeClass("error");
							$(this).parent().find("label").css({"color":"#22bce0"});
						}
					});
					$(this).find(">div.commt>textarea").on("focus",function(){

						if(!$(this).parent().hasClass("error"))
						{
							$(this).parent().find("label").velocity({"color":"#22bce0","margin-top":"-13px","font-size":"14px"},100);
						}
						else
						{
							$(this).parent().find("label").velocity({"margin-top":"-13px","font-size":"14px"},100);
						}
					})
					$(this).find(">div.commt>textarea").on("blur",function(){
						if($(this).parent().hasClass("error"))
						{
							if( $(this).val().trim() == ""  )
							{
								$(this).parent().find("label").velocity({"margin-top":"0","font-size":"16px"},100)
							}
						}
						else
						{
							if( $(this).val().trim() == ""  )
							{
								$(this).parent().find("label").velocity({"color":"#9e9e9e","margin-top":"0","font-size":"16px"},100)
							}
							else
							{
								$(this).parent().find("label").velocity({"color":"#9e9e9e"},100)
							}	
						}
					});
					$(this).addClass("mt-check");
				}
			});
		}
		$.fn.mtValidate = function(){
			verify.start();
			$( $(this).data().check + " input[type='text'],"+$(this).data().check + " input[type='password']" ).each(function(){
				if( eval($(this).data().require) == true || (eval($(this).data().require) == false && $(this).val() != ""))
				{
					$(this).trigger("keyup");
					$(this).trigger("blur");
					if( $(this).val().trim() == "" )
					{
						$(this).parent().find("label>span").text("Campo requerido");
					}
				}
			});
			$($(this).data().check + " input[type='radio']" ).parent().parent().each(function(){
				if(eval($(this).find(".rd input[type='radio']").data().require))
				{
					var checked = false;
					$(this).find(".rd input[type='radio']").each(function(){
						if($(this).prop("checked"))
						{
							checked = true;
						}
					});
					if(!checked)
					{
						$(this).find(".rd label").addClass("error");
						$(this).find(".rd-label>span").css({"visibility":"visible"});
						verify.change();
					}
				}
			});
			$($(this).data().check + " input[type='checkbox']" ).parent().parent().each(function(){
				if(eval($(this).find(".ck input[type='checkbox']").data().require))
				{
					var checked = false;
					$(this).find(".ck input[type='checkbox']").each(function(){
						if($(this).prop("checked"))
						{
							checked = true;
						}
					});
					if(!checked)
					{
						$(this).find(".ck label").addClass("error");
						$(this).find(".ck-label>span").css({"visibility":"visible"});
						verify.change();
					}
				}
			});
			$($(this).data().check + " select" ).parent().parent().each(function(){
				if(eval($(this).find("select").data().require))
				{
					if($(this).find("select>option:selected").val() == "none")
					{
						$(this).find(">div").addClass("error");
						verify.change();
					}
				}
			});
			$($(this).data().check + " textarea" ).parent().each(function(){
				if(eval($(this).find("textarea").data().require))
				{
					if($(this).find("textarea").val().trim() == "")
					{
						$(this).addClass("error");
						verify.change();
					}
				}
			});
			$($(this).data().check + " input[type='file']" ).parent().each(function(){
				if(eval($(this).find("input[type='file']").data().require) == true || eval($(this).find("input[type='file']").data().require) == false && $(this).find("input[type='file']").val() != "")
				{
					$(this).find("input[type='file']").trigger("change");
					if($(this).find("input[type='file']").val().trim() == "")
					{
						$(this).find("input[type='text']").css({"border-bottom":"#F44336 solid 2px","color":"#F00"});
						$(this).find("p.name").css("color","#F44336");
						$(this).find("label").css("display","inline-block");
						$(this).parent().find("div>label").text("Campo requerido");
						verify.change();
					}
				}
			});
			return verify.show();
		};
	});
})(jQuery);