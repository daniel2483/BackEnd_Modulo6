/*
  Creación de una función personalizada para jQuery que detecta cuando se detiene el scroll en la página
*/
$.fn.scrollEnd = function(callback, timeout) {
  $(this).scroll(function(){
    var $this = $(this);
    if ($this.data('scrollTimeout')) {
      clearTimeout($this.data('scrollTimeout'));
    }
    $this.data('scrollTimeout', setTimeout(callback,timeout));
  });
};
/*
  Función que inicializa el elemento Slider
*/

function inicializarSlider(){
  $("#rangoPrecio").ionRangeSlider({
    type: "double",
    grid: false,
    min: 0,
    max: 100000,
    from: 200,
    to: 80000,
    prefix: "$"
  });
}
/*
  Función que reproduce el video de fondo al hacer scroll, y deteiene la reproducción al detener el scroll
*/
function playVideoOnScroll(){
  var ultimoScroll = 0,
      intervalRewind;
  var video = document.getElementById('vidFondo');
  $(window)
    .scroll((event)=>{
      var scrollActual = $(window).scrollTop();
      if (scrollActual > ultimoScroll){
       //video.play();
     } else {
        //this.rewind(1.0, video, intervalRewind);
        //video.play();
     }
     ultimoScroll = scrollActual;
    })
    .scrollEnd(()=>{
      //video.pause();
    }, 10)
}

inicializarSlider();
playVideoOnScroll();

onClickMostrarTodos();
// AJAX to give functionality
function onClickMostrarTodos(){
  $('#mostrarTodos').on('click', function(){
    // AJAX to check if session already start
    $.ajax(
      {
        url:'./mostrarTodos.php',
        type:'post',
        success: function(data) {
          // For Debugging
          console.log(data.length);

          // Build the content for mostrarTodos
          $.each(data,function(i, val){
            //console.log(i +" " + val['Ciudad'])
            //$(".colContenido").append(i +" " + val['Ciudad'])
            $(".colContenido").append("<div class='tituloContenido card' style='justify-content:left'>" +
                                      "<img src='img/home.jpg' style='height:180px'>" +
                                      "<p style='margin-left:20px'>" +
                                      "<b>Dirección:</b> " + val['Direccion'] + "<br>" +
                                      "<b>Ciudad:</b> " + val['Ciudad'] + "<br>" +
                                      "<b>Teléfono:</b> " + val['Telefono'] +  "<br>" +
                                      "<b>Código Postal:</b> " + val['Codigo_Postal'] + "<br>" +
                                      "<b>Precio: <color style='color:orange;'>" + val['Precio'] + "</color></b><br>" +
                                      "<b>Tipo:</b> " + val['Tipo'] + "<br>" +
                                      "<hr>"+
                                      "</p>" +
                                      "<p 'justify-content:right'>" +
                                        "<a>VER MÁS</a>" +
                                      "</p>" +
                                      "</div>")
          })

        }
      }).done(function (data){
        //alert("All good " + data)
      })
  })
}



  $('#submitButton').on('click',function(event){
    var valuesRange = $('input[name=precio]').val();
    var ciudad = $("select[name=ciudad]").children("option:selected").text();
    var ciudadId = $("select[name=ciudad]").children("option:selected").val();
    var tipo = $("select[name=tipo]").children("option:selected").text();
    var tipoId = $("select[name=tipo]").children("option:selected").val();
    event.preventDefault();

    //console.log("Testing");

    $.ajax({
      url:'./buscador.php',
      type:'post',
      data: {range:valuesRange,ciudad:ciudad,ciudadId:ciudadId,tipo:tipo,tipoId:tipoId},
      success: function(data) {
        // For debugging
        console.log(data.length);

        // Erase everything in Busqueda
        $(".colContenido").html("")

        // Build Title and mostrarTodos Buttons
        $(".colContenido").append('<div class="tituloContenido card">'+
                                  '<h5>Resultados de la búsqueda:</h5>'+
                                  '<div class="divider"></div>'+
                                  '<button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar Todos</button>'+
                                  '</div>')

        // Give onClick functionality for mostrarTodos
        onClickMostrarTodos();

        // Build the content depending on filters
        $.each(data,function(i, val){
          //console.log(i +" " + val['Ciudad'])
          //$(".colContenido").append(i +" " + val['Ciudad'])
          $(".colContenido").append("<div class='tituloContenido card' style='justify-content:left'>" +
                                    "<img src='img/home.jpg' style='height:180px'>" +
                                    "<p style='margin-left:20px'>" +
                                    "<b>Dirección:</b> " + val['Direccion'] + "<br>" +
                                    "<b>Ciudad:</b> " + val['Ciudad'] + "<br>" +
                                    "<b>Teléfono:</b> " + val['Telefono'] +  "<br>" +
                                    "<b>Código Postal:</b> " + val['Codigo_Postal'] + "<br>" +
                                    "<b>Precio: <color style='color:orange;'>" + val['Precio'] + "</color></b><br>" +
                                    "<b>Tipo:</b> " + val['Tipo'] + "<br>" +
                                    "<hr>"+
                                    "</p>" +
                                    "<p 'justify-content:right'>" +
                                      "<a>VER MÁS</a>" +
                                    "</p>" +
                                    "</div>")
        })


      }
    }).done(function(data){
      //alert(data);
    })

  })
