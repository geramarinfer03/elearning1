function irarriba(){
$('html, body').animate({scrollTop:0}, 300);
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

  var url = "/matricularUsuario/"+id_usuario+"";

  /*$("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10*/
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);  //leccion 10
  })
irarriba();
}


$(document).on("click",".div_modal",function(e){
 //funcion para ocultar las capas modales
 $("#capa_modal").hide();
 $("#capa_para_edicion").hide();
 $("#contenido_capa_edicion").html("");  //leccion 10

}) 


$(document).on("click",".pagination li a",function(e){
//para que la pagina se cargen los elementos
 e.preventDefault();
 var url =$( this).attr("href");

 $("#contenido_capa_edicion").html($("#cargador_empresa").html());
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);
  })

})


function cambio_rol(id_matricula){
  $('#btnMatriculaUsuarios_'+id_matricula).attr('class','btn_img');
}

function seleccionCursoMat(id){
  $('#curso_mat').val(id);
}



function tabular(html, semana ,recPadre){
  //alert(html);
  console.log(html);
  console.log(semana);
  console.log(recPadre);
  console.log("#sem"+ semana + "_row" + recPadre);
  
  $("#sem"+ semana + "_row" + recPadre).append(html);
}

$(function(){
  $('.main_table_seccion').sortable();
});