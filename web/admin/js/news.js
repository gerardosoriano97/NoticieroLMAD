$(document).ready(function(){
  //si somos administradores, agrega el campo status a la tabla
  let user = JSON.parse(localStorage.getItem('userInfo'));
  if (user.type == 'administrador') {
    $('#tableNews>thead>tr').append('<th>estado</th>')
    $('form.newsForm>label:last-of-type').removeClass('hidden');
    $('input#state').removeClass('hidden');
  }
  $.ajax({
    method:   "POST",
    dataType: "json",
    url:      "../../server/php/controller/getAllNews.php"
  }).done(function(msg){
    if (user.type == 'administrador') {
      $.each(msg,function(key,val){
        $("table#tableNews>tbody").append(''+
          '<tr id='+val.idNews+'>'+
          '<td>'+val.idNews+'</td>'+
          '<td>'+val.title+'</td>'+
          '<td>'+val.description+'</td>'+
          '<td>'+val.sectionName+'</td>'+
          '<td>'+val.style+'</td>'+
          '<td>'+val.state+'</td>'+
          '</tr>'
        );
      });
    }else {
      $.each(msg,function(key,val){
        $("table#tableNews>tbody").append(''+
          '<tr id='+val.idNews+'>'+
          '<td>'+val.idNews+'</td>'+
          '<td>'+val.title+'</td>'+
          '<td>'+val.description+'</td>'+
          '<td>'+val.sectionName+'</td>'+
          '<td>'+val.style+'</td>'+
          '</tr>'
        );
      });
    }
  }).fail(function(jqXHR, textStatus){
    alert("Request failed: " + textStatus);
  });

  $("table#tableNews > tbody").on("click","tr", function(e){
    $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
    let id = $(e.currentTarget).attr("id");
    $.ajax({
      method:   "POST",
      dataType: "json",
      url:      "../../server/php/controller/getNews.php?idNews="+id
    }).done(function(obj){
      $('[name="id"]').val(id);
      $('[name="idUser"]').val(obj['news'].idUser);
      $('[name="title"]').val(obj['news'].title);
      $('[name="description"]').val(obj['news'].description);
      $('[name="content"]').val(obj['news'].content);
      $('[name="section"]').val(obj['news'].idSection);
      if (obj['news'].style == 'destacada') {
        $('[name="style"]').val(1);
      }else {
        $('[name="style"]').val(2);
      }
      if (obj['news'].state == 1) {
        $('[name="status"]').prop('checked',true)
      }
    }).fail(function(jqXHR, textStatus){
      alert("Request failed: " + textStatus);
    });
  });

  $('form.newsForm').on('submit',function(e){
    e.preventDefault();
    let jsonObj = {};
    $(this).find(".toJson").each(function(key, value){
      jsonObj[$(value).attr("name")] = $(value).val();
    });
    jsonObj['state'] = $('#state').is(':checked');
    let json = JSON.stringify(jsonObj);

    $.ajax({
      method:   "POST",
      url:      "../../server/php/controller/setNews.php",
      data:     {"json":json, "token":localStorage.getItem('token')}
    }).done(function(data){
      if (data == 'success') {
        $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
      }
    })
  });

  $('input[name="back"]').on('click',function(){
    $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
  })

  $('button#new').on('click',function(){
    $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
    $('[name="id"]').val('');
    $('[name="idUser"]').val(user.idUser);
    $('[name="title"]').val('');
    $('[name="description"]').val('');
    $('[name="content"]').val('');
    $('[name="section"]').val('');
    $('[name="style"]').val(2);
    $('[name="status"]').prop('checked',false);
  })
});
