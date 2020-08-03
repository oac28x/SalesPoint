$(document).ready(function(){

    //Change baseURL if needed
    function getUrl(urlExtra)
    {
        let baseURL = 'http://localhost/tiendita/index.php/';
        return baseURL + urlExtra;
    }
    
    //Login >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //Login preventDefault
    $("#formusr").submit(function(event){
        event.preventDefault();
        return false;
    });

    //Login checkUsers
    $("#alaversh").click(function() {  
        var datos = $("#formusr").serialize();
        $.ajax({
            url: getUrl('Store/checa'),
            asyn:true,
            type:"POST",
            dataType: 'html',
            data: datos,
            success:function(html){  
                if(html != "1") location.reload(); // $("#loging_box").html(html);
                else alert("Datos incorrectos, intenta nuevamente.")          
            },
            error:function(xhr, status, error){
                //console.log(xhr.responseText);
                //console.log(error);
                //console.log(status);
                alert("Hay error revisa tu configuración...");
            }
        });
    }); 

    //Usuario Ventas >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //Ventas proceder a pagar
    $("#pagarBtn").click(function() {
        console.log("Pagando");
		var data = Array();
		var nombre = $("#nombreTrabajador").text();

		$("table tr").each(function(i, v){
		    data[i] = Array();
		    $(this).children('td').each(function(ii, vv){
		        data[i][ii] = $(this).text();
		    }); 
		});	
        
		if(data.length > 1 && data[0] !== null) {
			var villulla = $.trim($("#pago").val());
			var total = $("#totalPagar").attr('value');
			var cambio = $("#cambio").attr('value');
            if(!villulla) 
                alert("¿Con cuánto paga?");
            else if(cambio < 0){
                alert("Pago insuficiente.");
            }
    		else{
				$.ajax({
		            url: getUrl('Store/regVentas'),
		            asyn:true,
		            type:"POST",
		            dataType: 'html',
		            data: {'infoTabla':data,'nombre':nombre,'pago':villulla, 'cambio':cambio, 'total':total},
		            success:function(html){  
                        console.log('Succes venta');
                        console.log(html);          	
		            	if(html == 'ok'){
                            console.log(html);
		            		$("#tablax").html('');
		            		$("#pago").val('');
			                $("#totalPagar").text('Total: $0').attr('value',0);
			                $("#cambio").text('Total: $0').attr('value',0);
		            	}
		            },
		            error:function(xhr, status, error){
                        //console.log(xhr.responseText);
                        //console.log(error);
                        //console.log(status);
		                alert("ERROR: No se guardó la compra, revisa configuración.");
		            }
		        });
			}
		}else{
			alert("No hay articulos agregados.");
		}
		data = null;
	}); 

    //Ventas buscar producto
	$('#Nbuscar').on('input',function(e){
		e.preventDefault();
    	var datos = $("#buscapor, #Nbuscar").serialize();
    	var busca = $.trim($("#Nbuscar").val());
    	if(busca){
    		$.ajax({
	            url: getUrl('Store/sugiere'),
	            asyn:true,
	            type:"POST",
	            dataType: 'html',
	            data: datos,
	            success:function(html){              	
	                if(html != "") {
	                	$("#drops").html(html);
	               		$(".dropdown-menu").show().animate({scrollTop:0}, 200);
	               	}     
	            },
	            error:function(){
                    alert("ERROR: No se pudo encontrar sugerencias...");
	            }
	        });
    	}
    });
    
    //Ventas agregar producto
    $("#addProductBtn").click(function() {  
    	var cantidad = $.trim($("#cuantos").val());
    	var buscar = $.trim($("#Nbuscar").val());
        if(!cantidad) 
            alert("¿Cuántos?");
    	else{
    		if(!buscar) alert("No hay artículo para agregar.");
    		else{
    			var datos = $("#cuantos").serialize();

    			datos+= "&id=";
    			datos+= id;
    			$.ajax({
		            url: getUrl('Store/agregar'),
		            asyn:true,
		            type:"POST",
		            dataType: 'html',
		            data: datos,
		            success:function(html){              	
		                if(html != "") {
		                	var json = JSON.parse(html);
                			$("#tablax").append(json["info"]);

                			var total = $("#totalPagar").attr('value');
                			total = parseFloat(total) + parseFloat(json['total']);

                            $("#totalPagar").text('Total: $' + total.toFixed(2)).attr('value',total);
                            getCambio();
		               	}     
		            },
		            error:function(){
		                alert("Hay error, revisa configuración...");
		            }
		        });
    			$("#Nbuscar, #cuantos").val('');
    		}
    	}
    });

    //Ventas DropDown control
    var id = "identificador";
    $("#drops").on('click','li',function() {
  		$("#Nbuscar").val($(this).text());
  		$(".dropdown-menu").hide();
  		id = $(this).attr('value');
	});

    $('#pago').on('input',function(event){
    	event.preventDefault();
    	getCambio();
    });

    //Usuario Admin >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
    //DatePicker Configuracion español
    $( "#datepicker, #datepicker2" ).datepicker({
        dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
        monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
        dateFormat: "dd-mm-yy",
        changeYear: true
    });
  
    $('#Nbuscar').on('input',function(e){
        var datos = $("#buscapor, #Nbuscar").serialize();
        var busca = $.trim($("#Nbuscar").val());
        if(busca){
            $.ajax({
                url: getUrl('Store/sugiere'),
                asyn:true,
                type:"POST",
                dataType: 'html',
                data: datos,
                success:function(html){   
                    $("#drops").html(html);
                        $(".dropdown-menu").show().animate({scrollTop:0}, 200);
                },
                error:function(){
                
                }
            });
        }else{
            $(".dropdown-menu").hide();
        }
    });
  
      $('#usrBuscar').on('input',function(e){
          var datos = $("#usrBuscar").serialize();
          var busca = $.trim($("#usrBuscar").val());
          if(busca){
              $.ajax({
                  url: getUrl('Store/buscaUsr'),
                  asyn:true,
                  type:"POST",
                  dataType: 'html',
                  data: datos,
                  success:function(html){   
                      $("#usrDrops").html(html);
                         $(".dropdown-menu").show().animate({scrollTop:0}, 200);
                  },
                  error:function(){
                  
                  }
              });
          }else{
              $(".dropdown-menu").hide();
          }
      });
  
      $("#usrDrops").on('click','li',function() {
  
          var nombre = $(this).text();
          var usr = $(this).attr('value');
  
            $("#usrBuscar").val(nombre);
            $(".dropdown-menu").hide();  		
  
            $.ajax({
              url: getUrl('Store/editarUsr'),
              asyn:true,
              type:"POST",
              dataType: 'html',
              data: {'usr':usr,'nombre':nombre},
              success:function(html){   
                  var json = JSON.parse(html);
                     $("#usrNombre1").val(json["NCompleto"]);
                     $("#usr1").val(json["usuario"]);
                     $("#usrContra1").val(json["contra"]);
                     $("#permiso1").val(json["permiso"]);
              },
              error:function(){
              
              }
          });
      });
  
      var id = "identificador";
      $("#drops").on('click','li',function() {
            $("#Nbuscar").val($(this).text());
            $(".dropdown-menu").hide();
            id = $(this).attr('value');
  
            $.ajax({
              url: getUrl('Store/editarArt'),
              asyn:true,
              type:"POST",
              dataType: 'html',
              data: {'id':id},
              success:function(html){   
                  var json = JSON.parse(html);
                     $("#nombre").val(json["nombre"]);
                     $("#sustancia").val(json["sustancia"]);
                     $("#present").val(json["presentacion"]);
                     $("#clave").val(json["clave"]);
                     $("#canti").val(json["cantidad"]);
                     $("#precio").val(json["precio"]);
              },
              error:function(){
              
              }
          });
      });
  
      $("#Nbuscar[type='text']").click(function () {
         $(this).select();
      });
  
  
      $( "#edit" ).click(function() {
          if( $("#nombre").val()=="" || $("#sustancia").val()=="" || $("#present").val()=="" || $("#clave").val()=="" || $("#canti").val()=="" ||	$("#precio").val()==""){
              alert("Necesario llenar todos los campos.")
          }else{
              var datos = $("#nombre, #sustancia, #present, #clave, #canti, #precio").serialize();
              datos+= "&idr=";
              datos+= id;
  
                $.ajax({
                  url: getUrl('Store/updateArt'),
                  asyn:true,
                  type:"POST",
                  dataType: 'html',
                  data: datos,
                  success:function(html){
                       if(html == "ok"){
                           $('input').val("");
                           alert("Actualizado!")
                       }
                  },
                  error:function(){
                  
                  }
              });
          }
      });
  
      $( "#editUsr" ).click(function() {
          if( $("#usrNombre1").val()=="" || $("#usrContra1").val()=="" || $("#usr1").val()==""){
              alert("Necesario llenar todos los campos.")
          }else{
              var datos = $("#usrBuscar, #usrNombre1, #usr1, #usrContra1, #permiso1").serialize();
                $.ajax({
                  url: getUrl('Store/updateUsr'),
                  asyn:true,
                  type:"POST",
                  dataType: 'html',
                  data: datos,
                  success:function(html){
                       if(html == "ok"){
                           $('input').val("");
                           alert("Actualizado!")
                       }
                  },
                  error:function(){
                  
                  }
              });
          }
      });
  
      $("#eliminarUsr").click(function(){
          var datos = $("#usrBuscar, #usr1").serialize();
          $.ajax({
              url: getUrl('Store/eliminarUsr'),
              asyn:true,
              type:"POST",
              dataType: 'html',
              data: datos,
              success:function(html){
                  if(html == "ok"){
                      $('#myModal3').modal('hide');
                      $('input').val("");
                  }   
              },
              error:function(){
              
              }
          });
      });
  
      $("#eliminar").click(function(){
          $.ajax({
              url: getUrl('Store/eliminarArt'),
              asyn:true,
              type:"POST",
              dataType: 'html',
              data: {'id':id},
              success:function(html){
                  if(html == "ok"){
                      $('#myModal2').modal('hide');
                      $('input').val("");
                  }   
              },
              error:function(){
              
              }
          });
      });
  
      $("#addArt").click(function(){
          if( $("#nombre1").val()=="" || $("#sustancia1").val()=="" || $("#present1").val()=="" || $("#clave1").val()=="" || $("#canti1").val()=="" ||	$("#precio1").val()==""){
              alert("Necesario llenar todos los campos.")
          }else{
              var datos = $("#nombre1, #sustancia1, #present1, #clave1, #canti1, #precio1").serialize();
              $.ajax({
                  url: getUrl('Store/addNewArt'),
                  asyn:true,
                  type:"POST",
                  dataType: 'html',
                  data: datos,
                  success:function(html){
                      if(html == "ok"){
                          $('input').val("");
                          alert("Agregado correctamente")
                      }else{
                          alert(html);
                      }
                  },
                  error:function(){
                  
                  }
              });
          }    
      });
  
      $("#addUsr").click(function(){
          if( $("#usrNombre").val()=="" || $("#usrContra").val()=="" || $("#usr").val()==""){
              alert("Necesario llenar todos los campos.")
          }else{
              var datos = $("#permiso, #usr, #usrNombre, #usrContra").serialize();
              $.ajax({
                  url: getUrl('Store/addNewUsr'),
                  asyn:true,
                  type:"POST",
                  dataType: 'html',
                  data: datos,
                  success:function(html){
                      $('input').val("");
                      alert("Agregado correctamente")
                  },
                  error:function(){
                  
                  }
              });
          }    
      });
}); 

//Model Admin show
function modal1Show(){
    $('#myModal1').modal('show');
}

//Model Admin show
function modal2Show(){
    if( $("#nombre").val()=="" || $("#sustancia").val()=="" || $("#present").val()=="" || $("#clave").val()=="" || $("#canti").val()=="" ||	$("#precio").val()==""){
        alert("Necesario llenar todos los campos.")
    }else{
    $('#myModal2').modal('show');
    }
}

//Model Admin show	
function modal3Show(){
    if( $("#usrNombre1").val()=="" || $("#usrContra1").val()=="" || $("#usr1").val()==""){
        alert("Necesario llenar todos los campos.")
    }else{
    $('#myModal3').modal('show');
    }
}

//Calcular cambio, globalFunction
getCambio = function cambio(){
    var aPagar = $("#totalPagar").attr('value');
    var pago = $("#pago").val();
    
    var cambio = parseFloat(pago) - parseFloat(aPagar);

    if(pago){
        if(cambio < 0){
            $("#cambio").text('Cambio: NA').attr('value',cambio);
        }
        else{
            $("#cambio").text('Cambio: $' + cambio.toFixed(2)).attr('value',cambio);
        }
    }
    else $("#cambio").text('Cambio: NA').attr('value',0);
};

//Delete article from table
function deletiar(dato){
    var total = $("#totalPagar").attr('value');
    total = parseInt(total) - parseInt($("#"+dato).attr('value'));
    $("#totalPagar").text('Total: ' + total).attr('value',total);
    $("#"+dato).html('');
    getCambio();	
}

//Validate quantity
function validateQty(event) {
    var key = window.event ? event.keyCode : event.which;

    if (event.keyCode == 8 || event.keyCode == 46
     || event.keyCode == 37 || event.keyCode == 39) {
        return true;
    }
    else if ( key < 48 || key > 57) {
        return false;
    }
    else return true;
}

//Validate payiment just numbers
function isNumber(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57))
     return false;
  return true;
}