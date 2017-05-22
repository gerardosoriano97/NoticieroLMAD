$(document).ready(function(){
  $.ajax({
    method:   "GET",
    dataType: "json",
    async:    false,
    url:      "../../server/php/controller/getRecentNews.php" + $(location).attr('search')
  }).done(function(msg){
    //Parte del titulo
    $('#commercial > .content .title').append('<h1>'+ msg['section'] +'</h1>')
    //Parte del outstanding
    if (msg['outstanding'].length != 0) {
      $.each(msg['outstanding'],function(key,val){
        if (key == 3) {
          return false;
        }
        $('#commercial .outstanding').append('' +
          '<a href="inside_note.html?idNews='+ val.idNews +'">' +
            '<div class="news">' +
              '<div class="infoCard">' +
                '<img src="resources/images/duarte.jpg" alt="">' +
                '<h1>'+ val.title +'</h1>' +
              '</div>' +
            '</div>' +
          '</a>'
        );
      });
    }else {
      $('#commercial .outstanding').remove();
    }
    //Parte del las noticias normales
    if (msg['normal'].length != 0) {
      $.each(msg['normal'],function(key,val){
        $('#commercial .newsSection > .newsContainer').append(''+
          '<a href="inside_note.html?idNews='+ val.idNews +'">'+
            '<div class="news" id="'+ val.idNews +'">' +
              '<div class="newsImage">' +
                '<img src="resources/images/duarte.jpg" alt="Imagen de Duarte bebé">' +
              '</div>' +
              '<div class="text">' +
                '<h1>'+ val.title +'</h1>' +
                '<h2>'+ val.description +'</h2>' +
              '</div>' +
            '</div>' +
          '</a>'
        );
      });
    }else {
      $('#commercial .newsSection').remove();
    }
    console.log(msg);
  }).fail(function(jqXHR, textStatus){
    console.log("Request failed: " + textStatus);
  });

  //creamos el carrusel de noticias principales
  $('div.outstanding').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    autoplay: true,
    autoplaySpeed: 2000
  });

});
