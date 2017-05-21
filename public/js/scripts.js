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