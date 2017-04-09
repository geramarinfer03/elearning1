function irarriba() {
    $('html, body').animate({
        scrollTop: 0
    }, 300);
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
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul); //leccion 10
    })
    irarriba();
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



function activarEdicion(){
    if($('.inputS').prop('disabled')){
        $('.hiddenclass').prop('class', 'visibleclass');
        $('.inputS').prop('disabled', false);
        $(".main_table_seccion").sortable("enable");
        
     
   }else{
      
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


    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul);
    })
    irarriba();
}

function crearRecurso(id_padre) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();

    var url = "/crearRecurso/" + id_padre + "";


    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul); 
    })
    irarriba();
}




function crearRecursoSemana(semana) {
    $("#capa_modal").show();
    $("#capa_para_edicion").show();


    var url = "/crearRecursoSemana/" + semana + "";

    /*$("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10*/
    $.get(url, function (resul) {
        $("#contenido_capa_edicion").html(resul); //leccion 10
    })
    irarriba();
}


function cambiarNombreSemana(idS){
     $('#btnCnameSemana_' + idS).attr('class', 'btn_semanaNombre');   
}


$(function () {
   // var contador = 1;
    $('.main_table_seccion').sortable({
        stop: function() {
             var arrayPosition = Array();
         
            var datoSelect;
            $.map($(this).find('tr'),function(el){
             
              var intemID = el.id;

             // arrayR.push(intemID);
            arrayPosition.push(intemID);


             
              //console.log(intemID);
             //console.log(contador);

              


               //contador++;
                /*$.ajax({
                    url:'/updateDrag',
                    type: 'POST',
                    dataType: 'json',
                    data: {intemID:intemID, itemIndex:itemIndex}
                })*/
               
            })
             
           /* var myJsonString = JSON.stringify(arrayPosition);
            console.log(myJsonString);
    
             $.ajax({
                type: "post",
                url: "/updateDrag",
                dataType: 'json',
                data:  myJsonString
              });
*/

alert(arrayPosition);

$.ajax(
   {
        url: "/updateDrag/"+arrayPosition,
        type: "get",
        data: arrayPosition,
        dataType: 'json',
        success: function(msg) {
            alert(msg);
        }
    }
);

           
           //var url = "/updateDrag/"+arrayPosition;

//
           // $.post(url, function (resul) {
          //    $(this).html(resul); 
          //  })

           // contador = 1;

        }
    });
    $(".main_table_seccion").sortable("disable");
});