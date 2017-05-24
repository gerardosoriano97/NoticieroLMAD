$(document).ready(function(){
  $.ajax({
    method:   "POST",
    dataType: "json",
    url:      "../../server/php/controller/getAllSections.php"
  }).done(function(msg){
    $.each(msg,function(key,val){
      $("table#tableSections>tbody").append(''+
        '<tr id='+val.idSection+'>'+
        '<td>'+val.idSection+'</td>'+
        '<td>'+val.sectionName+'</td>'+
        '<td>'+val.sectionDescription+'</td>'+
        '</tr>'
      );
    });
  }).fail(function(jqXHR, textStatus){
    alert("Request failed: " + textStatus);
  });

  $("table#tableSections > tbody").on("click","tr", function(e){
    $('body#admin>div[class^="modal"]').toggleClass("modal-hide modal-show");
    let id = $(e.currentTarget).attr("id");
    $.ajax({
      method:   "POST",
      dataType: "json",
      url:      "../../server/php/controller/getSection.php?idSection="+id
    }).done(function(obj){
      $('[name="id"]').val(id);
      $('[name="sectionName"]').val(obj.sectionName);
      $('[name="sectionDescription"]').val(obj.sectionDescription);
    }).fail(function(jqXHR, textStatus){
      alert("Request failed: " + textStatus);
    });
  });

  $('form.sectionForm').on('submit',function(e){
    e.preventDefault();
    let jsonObj = {};
    $(this).find(".toJson").each(function(key, value){
      jsonObj[$(value).attr("name")] = $(value).val();
    });
    let json = JSON.stringify(jsonObj);

    $.ajax({
      method:   "POST",
      url:      "../../server/php/controller/setSection.php",
      data:     {"json":json}
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
    $('[name="sectionName"]').val('');
    $('[name="sectionDescription"]').val('');
  })
});
