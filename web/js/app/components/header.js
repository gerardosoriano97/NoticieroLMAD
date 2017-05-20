$('body#commercial>div.header').ready(function(){
  $.ajax({
    method:   "POST",
    url:      "./../../server/php/controller/getAllSections.php"
  }).done(function(msg){
    $.each(JSON.parse(msg),function(key,val){
      $("ul.sections").append(''+
        '<li><a href="homepage.html?idSection='+val.idSection+'">'+
          val.sectionName+
        '</a></li>'
      );
    });
  }).fail(function(jqXHR, textStatus){
    alert("Request failed: " + textStatus);
  });
});
