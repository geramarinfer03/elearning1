function irarriba() {
    $('html, body').animate({
        scrollTop: 0
    }, 100);
    $('#capa_para_edicion').scrollTop(0);
}

/*function buscarusuario(){

  var pais=$("#select_filtro_pais").val();
  var dato=$("#dato_buscado").val();
    if(dato == ""){  
      var url="buscar_usuarios/"+pais+"";
    }
    else
    {
      var url="buscar_usuarios/"+pais+"/"+dato+"";
    }
  
  $("#contenido_principal").html($("#cargador_empresa").html());
 $.get(url,function(resul){
    $("#contenido_principal").html(resul);  
  })
}*/

function mostrarMatricula(id_usuario) {
    //funcion para mostrar y etditar la informacion del usuario

    // $("#usuario_seleccionado").val(id_usuario);
    $("#capa_modal").show();
    $("#capa_para_edicion").show();



    var url = "/matricularUsuario/" + id_usuario + "";

    /*$("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10*/
    irarriba();
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul); //leccion 10
    })

}


$(document).on("click", ".div_modal", function (e) {
    //funcion para ocultar las capas modales
    $("#capa_modal").hide();
    $("#capa_para_edicion").hide();
    $("#contenido_capa_edicion").html(""); //leccion 10

})


$(document).on("click", ".pagination li a", function (e) {
    //para que la pagina se cargen los elementos
    e.preventDefault();
    var url = $(this).attr("href");

    $("#contenido_capa_edicion").html($("#cargador_empresa").html());
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })

})


function cambio_rol(id_matricula) {
    $('#btnMatriculaUsuarios_' + id_matricula).attr('class', 'btn_img');
}

function seleccionCursoMat(id) {
    $('#curso_mat').val(id);
}



function tabular(html, semana, recPadre) {


    $("#sem" + semana + "_row" + recPadre).append(html);
}



function activarEdicion() {
    if ($('.inputS').prop('disabled')) {
        $('.hiddenclass').prop('class', 'visibleclass');
        $('.inputS').prop('disabled', false);
        $(".main_table_seccion").sortable("enable");


    } else {

        $('.inputS').prop('disabled', true);
        $('.visibleclass').prop('class', 'hiddenclass');
        $(".main_table_seccion").sortable("disable");

    }

}

function edicion(id_recurso) {
    //funcion para mostrar y etditar la informacion del usuario

    // $("#usuario_seleccionado").val(id_usuario);

    $("#capa_modal").show();
    $("#capa_para_edicion").show();

    var url = "/editarRecurso/" + id_recurso + "";

    irarriba();
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })

}

function edicionArchivo(id_recurso) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();

    var url = "/editarRecursoArchivo/" + id_recurso + "";

    irarriba();
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })

}

function crearRecurso(id_padre, curso) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();

    var url = "/crearRecurso/" + id_padre + "/" + curso;

    irarriba();

    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })

}




function crearRecursoSemana(semana, curso) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();


    var url = "/crearRecursoSemana/" + semana + "/" + curso + "";

    irarriba();

    /*$("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10*/
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul); //leccion 10
    })

}


function cambiarNombreSemana(idS) {
    $('#btnCnameSemana_' + idS).attr('class', 'btn_semanaNombre');
}


$(function () {

    /* var array = [];*/

    $('.main_table_seccion').sortable({
        stop: function () {
            $.map($(this).find('tr'), function (el) {
                var intemID = el.id;
                var index = $(el).index();

                console.log(intemID);
                console.log(index);



                $.ajax({
                    url: '/updateDrag',
                    type: 'POST',
                    dataType: 'json',
                    data: {

                        id: intemID,
                        sec: index
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (er) {
                        console.log('error');
                    }
                })



            })




        }
    });

    $(".main_table_seccion").sortable("disable");
});


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});





function estadoInactivo(id) {



    /*$('#'+id).attr('class','estadoInactivo');*/
    /* $('#'+id).children().attr('disabled',true);*/


    $('#' + id).attr('class', 'opacity')
    $('#' + id).find('a').attr('disabled', true);
    /*$('#'+id).find('a').removeAttr("href");*/

    $('#' + id).find('a').bind('click', false);

}

function visibleInactivo(id) {


    $('#' + id).attr('class', 'visibleInactivo');
}



function cambiarTipoRecurso() {

    $('.urlCR').css("display", "none");
    $('.notasCR').css("display", "none");
    $('#notasCR').val("");
    $('#urlCR').val("");


    var seleccion = $('#tipoRecursoA').val();
    switch (seleccion) {
        case "7":
            $('#tab1').attr('class', 'tab-pane');
            $('#tab3').attr('class', 'tab-pane active');

            $('#litab3').attr('class', 'active');
            $('#litab1').attr('class', '');

            $("#atab3").attr("aria-expanded", "true");
            $("#atab1").attr("aria-expanded", "false");
            $('#tipoRecursoA').val("");

            break;
        case "6":
            $('#tab1').attr('class', 'tab-pane');
            $('#tab2').attr('class', 'tab-pane active');

            $('#litab2').attr('class', 'active');
            $('#litab1').attr('class', '');

            $("#atab2").attr("aria-expanded", "true");
            $("#atab1").attr("aria-expanded", "false");


            $('#tipoRecursoA').val("");
            break;

        case "1":
            $('.urlCR').css("display", "block");
            $('.notasCR').css("display", "block");

            break;

        case "2":
            $('.notasCR').css("display", "block");
            break;

        case "5":
            $('.urlCR').css("display", "block");
            $('.notasCR').css("display", "block");
            break;

    }

}

function descargarImagen(id, serverpath) {

    var url = "/dwlImg/" + id;

    $.get(url, function (resul) {

        //$("#imagen").attr('src', '/storage/'+ id +'/tmp'+id);

    })


}



function Descargar(element, id) {


    $.ajax({
        url: element.src,
        success: function () {

            console.log('1');
            $(element).attr('poster', 'http://localhost:8000/img/play.png');
        },
        error: function () {


            console.log('0');
            $(element).attr('poster', 'http://localhost:8000/img/cargando.gif');
            var urle = $('#urlFiles_' + id).val();
            var semana = $('#semanaFile_' + id).val();


            setTimeout(function () {
                $.ajax({
                    type: "POST",
                    url: '/downloadVideo/',
                    data: { urlFiles: urle, semanaFile: semana },
                    success: function (msg) {

                        $(element).attr('poster', 'http://localhost:8000/img/play.png');
                        element.load();
                    }
                });

            }, 1000);

        }
    });

}

function CargarIcono(element) {
    $.ajax({
        url: element.src,
        success: function () {

            console.log('1');
            $(element).attr('poster', 'http://localhost:8000/img/play.png');
        },
        error: function () {
            console.log('1');

        }

    });

}



function borrarUltimaFila(){
   var nFilas = $("#tabla_criterios tr").length;
   var actual = nFilas -1;
   if(actual > 0){
    $("#criterio"+actual).remove();
    }


}

function filaCriterio(){
   // var nextRow = fila + 1;
    
     var nFilas = $("#tabla_criterios tr").length;
     var actual = nFilas-1;


     var area = $("#indicacionesF"+actual).val();
     var puntaje = $("#puntaje"+actual).val();

     var ppuntaje = $("#puntaje"+actual).text();

     if(area !== '' && puntaje !== ''){
         var newContent =  "<td class='puntajeColumn' style='width: 10px;' > "+
                            "<p  class='puntajeCriterio' id='puntaje"+actual+"'>"+puntaje+"</p>"+
                            "</td> "+
                             "<td class='criterioColumn'>"+
                             "<p id='puntaje"+actual+"'>"+area+"</p>"+
                             "</td>";

        $("#criterio"+actual).html(newContent);

        var nFilas = $("#tabla_criterios tr").length;

        var content =  "<tr id='criterio"+nFilas+"'>"+
                            "<td class='puntajeColumn columinput' style='width: 10px;'> "+
                                "<input  min='0' type='number' class='inputPuntaje' name='puntaje"+nFilas+"' id='puntaje"+nFilas+"' /> "+
                            "</td> "+
                             "<td class='criterioColumn columinput'>"+
                            "<textarea  name='indicacionesF"+nFilas+"' id='indicacionesF"+nFilas+"' "+
                            "rows='4' style='width: 100%;'  " +
                            "placeholder='Escriba las indicaciones generales en este apartado'></textarea>"+                
                            "</td>" +
                    "</tr>";

        $('#tabla_criterios').append(content);
     }
     else{
       if(ppuntaje !== ''){
             var nFilas = $("#tabla_criterios tr").length;

            var content =  "<tr id='criterio"+nFilas+"'>"+
                                "<td class='puntajeColumn' style='width: 10px;'> "+
                                    "<input  min='0' type='number' class='inputPuntaje' name='puntaje"+nFilas+"' id='puntaje"+nFilas+"' /> "+
                                "</td> "+
                                 "<td class='criterioColumn'>"+
                                "<textarea  name='indicacionesF"+nFilas+"' id='indicacionesF"+nFilas+"' "+
                                "rows='4' style='width: 100%;'  " +
                                "placeholder='Escriba las indicaciones generales en este apartado'></textarea>"+                
                                "</td>" +
                        "</tr>";

            $('#tabla_criterios').append(content);


        }else{
        
    }
     }


}

function filaActividad(){
    var nFilas = $("#tabla_actividades tr").length;
     var actual = nFilas-1;



     var area = $("#actividadesDesc"+actual).val();




      if(area !== ''){
         var newContent =  "<td class='criterioColumn'> "+
                            "<p  id='actividadesDesc"+actual+"'>"+area+"</p>"+
                            "</td> "+
                             "<td  class='puntajeColumn' style='width: 10px;'>"+
                             "<input disabled='disabled' min='0' type='number' class='inputPuntos' name='puntos"+actual+"' id='puntos"+actual+"' />"+
                             "</td>";

        $("#actividad"+actual).html(newContent);

        var nFilas = $("#tabla_actividades tr").length;

        var content =  "<tr id='actividad"+nFilas+"'>"+
                            "<td class='criterioColumn columinput'>"+
                                "<textarea name='actividadesDesc1'  id='actividadesDesc"+nFilas+"' rows='4' style='width: 100%;' placeholder='Describa la actividad  que se evaluara'>"+
                                "</textarea>"+  
                            "</td>"+                                        
                            "<td class='puntajeColumn columinput' style='width: 10px;''>"+
                                 "<input disabled='disabled' min='0' type='number' class='inputPuntos' name='puntos"+nFilas+"' id='puntos"+nFilas+"' />"+
                            "</td>"+
                        "</tr>";

        $('#tabla_actividades').append(content);
    }
}

function generarFormulario(){

    var maxPuntos = 0;
    var cant_actividades = 0;
    var indicaciones = $("#indicacionesF").val();

    $("#indicacionesF").remove();

    $("#indicacionesText").text(indicaciones);

   // $("#tabla_criterios input, #tabla_criterios textarea").remove();
   $(".columinput").remove();
    $(".botonForm").remove();


    $(".noMostar").attr('class', 'mostrar');
    $("#summitForm").attr('class', 'btn btn-success btn-lg');
    $(".inputPuntos").attr('disabled', false);

    var tarea = $("#tareaAsig").val();

    var curso = $("#cursoIDForm").val();




    $("#tabla_actividades p").each(function(){
         cant_actividades += 1;
    });


    var mayor = 0;
     $("#tabla_criterios tr td .puntajeCriterio").each(function(){
        maxPuntos = parseInt($(this).text()||0,10);
        
        if(maxPuntos > mayor){
            mayor = maxPuntos;
        }
         
    });



    var suma = mayor * cant_actividades;


   var formulario = $("#formularioEvaluacion").html();


    $("#cuerpoForm").html(formulario);

    formulario = formulario.split("\n").join(""); 

    //$( "#formCrearForm" ).submit();

/*var element = document.getElementById('formularioEvaluacion');
    var html = element.outerHTML;

    var datos = html.split("\n").join(""); 
    var data = { html: $.trim(datos) }; 

 


    var json = JSON.stringify(formulario);  



*/

    /*$( "#formCrearForm" ).submit(function( event ) {
      alert( "Handler for .submit() called." );
      event.preventDefault();
    });
      */
  // $("#capa_modal").show();
   // $("#capa_para_edicion").show();

    //$("#contenido_capa_edicion").html(formulario);



 
    //irarriba();

    /*$("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10*/
  //  $.get(url, function (resul) {
   //     $("#contenido_capa_edicion").html(resul); //leccion 10
 //   })

   $.ajax({
            type: "POST",
            url: "/tareas.formulario",
            data: {
                formulario:formulario,
                suma:suma,
                tarea: tarea,
                curso: curso
            },
            success: function(data) {
                //alert(data);
               // $('form').remove();
                $("#contenido_capa_edicion").html(data);
                //$('#contenido_capa_edicion').append('<p>Tu texto se ha guardado correctamente!</p><a href="data.txt" target="_blank">Ver</a>');
            }
        });

}


function buscarTareaForm(){
    var url = "/tareas.buscarTarea";
    var tareas = $("#tareaAsig").val();
    $.ajax({
        type: "POST",
        url: url,
        data: {
            tareaAsig:tareas
        },
        success: function(data) {

 
          if(data === "0"){

           // alert("No tiene HAGO UNO");
           $("#formularioEvaluacion").attr('class', "");
           $("#formularioGenerar").attr('class', 'btn btn-success btn-lg');

           $("#codigoVerificar").attr('hidden', 'hidden');

          }else{
            if(data === '1'){
               swal(
                  'Esta tarea ya tiene un formulario!',
                  ':/',
                  'error'
                )
            }
          }
      

           //$("#contenido_capa_edicion").html(data);
                //$('#contenido_capa_edicion').append('<p>Tu texto se ha guardado correctamente!</p><a href="data.txt" target="_blank">Ver</a>');
        }
    });


}

function crearTarea(){

    //$( "#crearTareaForm" ).submit(function() {
  // Enviamos el formulario usando AJAX
  /*alert("xD");
        $.ajax({
            type: 'POST',
            url: "/tareas.crearTarea",
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#contenido_capa_edicion').html(data);
            }
        })        
        return false;*/
   // }); 

    var url = "/tareas.crearTarea"; // El script a dónde se realizará la petición.
    var tarea = (-1);
    $.ajax({
           type: "POST",
           url: url,
           data: $("#crearTareaForm").serialize(), // Adjuntar los campos del formulario enviado.
           success: function(data)
           {    

            $('#tabT1').attr('class', 'tab-pane');
            $('#tabT2').attr('class', 'tab-pane active');

            $('#litabT2').attr('class', 'active');
            $('#litabT1').attr('class', '');

            $("#atabT2").attr("aria-expanded", "true");
            $("#atabT1").attr("aria-expanded", "false");

            $("#confirmarTarea").attr('class', 'btn btn-info btn-flat');


            $("#tareaAsig").val(data);
               
                swal({
                  title: '!Tarea Creada! # '+data,
                  text: 'El código de la tarea es: ' + data + '\n' + 'Construya el formulario de evaluacion',
                  type: 'success',
                  timer: 4000
                })

                               
           }
         });


}

