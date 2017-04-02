function buscarusuario(){

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
}

function mostrarficha(id_usuario) {
  //funcion para mostrar y etditar la informacion del usuario
 
  $("#usuario_seleccionado").val(id_usuario); // leccion10
  //$("#capa_modal").show();
  $("#capa_para_edicion").show();
  //if(tipo==1){var url = "form_editar_usuario/"+id_usuario+""; }else{ var url = "info_datos_usuario/"+id_usuario+""; }
  $("#contenido_capa_edicion").html($("#cargador_empresa").html());  //leccion 10
  $.get(url,function(resul){
  $("#contenido_capa_edicion").html(resul);  //leccion 10
  })
irarriba();
}