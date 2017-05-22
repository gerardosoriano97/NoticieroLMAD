$(document).ready(function(){
  $.ajax({
    method:   "GET",
    dataType: "json",
    async:    false,
    url:      "../../server/php/controller/getNews.php" + $(location).attr('search')
  }).done(function(msg){
    //insertamos la nota
    $('.note').append(''+
    '<h1>'+ msg.news.title +'</h1>' +
    '<h2>'+ msg.news.description +'</h2>' +
    '<div class="newsImage">' +
      '<img src="../resources/images/duarte.jpg" alt="Imagen del cerdito cashondo">' +
    '</div>' +
    '<div class="newsInfo">' +
      '<div class="writter">' +
        '<div class="userImage">' +
          '<img src="../resources/images/profile.jpg" alt="">' +
        '</div>' +
        '<label>'+ msg.news.fullname +'</label>' +
      '</div>' +
      '<span class="date">'+ msg.news.releaseDate +'</span>' +
    '</div>' +
    '<p>'+ msg.news.content +'</p>'
    );
  }).fail(function(jqXHR, textStatus){
    console.log("Request failed: " + textStatus);
  });
});
