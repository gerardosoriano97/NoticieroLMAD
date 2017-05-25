$(document).ready(function(){
  $('input[name="search"]').on('change',function(){
    $.ajax({
      method:   "POST",
      dataType: "json",
      url:      "../../server/php/controller/search.php",
      data:     {"search": $(this).val()}
    }).done(function(data){
      $('.newsSection > .newsContainer').empty();
      $.each(data,function(key,val){
        $('.newsSection > .newsContainer').append(''+
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
    });
  })
});
