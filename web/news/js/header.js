$('body#commercial>div.header').ready(function(){
  //nos traemos las secciones
  $.ajax({
    method:   "POST",
    dataType: "json",
    url:      "../server/php/controller/getAllSections.php"
  }).done(function(msg){
    $.each(msg,function(key,val){
      $("ul.sections").append(''+
        '<li><a href="index.html?idSection='+val.idSection+'">'+
          val.sectionName+
        '</a></li>'
      );
    });
  }).fail(function(jqXHR, textStatus){
    alert("Request failed: " + textStatus);
  });
});
