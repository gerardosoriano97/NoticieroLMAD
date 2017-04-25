$(".news").ready(function(){
  $.ajax({
    method:   "POST",
    url:      "./../../../server/php/controller/getAllNews.php"
  }).done(function(msg){
    $.each(JSON.parse(msg),function(key,val){
      $("table#tableNews>tbody").append(''+
        '<tr id='+val.idNews+'>'+
          '<td>'+val.idNews+'</td>'+
          '<td>'+val.title+'</td>'+
          '<td>'+val.description+'</td>'+
          '<td>'+val.sectionName+'</td>'+
          '<td>'+val.styleName+'</td>'+
        '</tr>'
      );
    });
  }).fail(function(jqXHR, textStatus){
    alert("Request failed: " + textStatus);
  });

  $("table#tableNews > tbody").on("click","tr", function(e){
    $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
    let id = $(e.currentTarget).attr("id");
    $.ajax({
      method:   "POST",
      url:      "./../../../server/php/controller/getNews.php",
      data:     {"id": id}
    }).done(function(msg){
      let obj = JSON.parse(msg);
      $('[name="id"]').val(id);
      $('[name="title"]').val(obj[0].title);
      $('[name="description"]').val(obj[0].description);
      $('[name="content"]').val(obj[0].content);
      $('[name="section"]').val(obj[0].idSection);
    }).fail(function(jqXHR, textStatus){
      alert("Request failed: " + textStatus);
    });
  });

  /*$("form.newsForm").validate({
    debug: true,
    rules{
      id:{},
      title:{},
      description{},
      content:{},
    }
  })*/
});
