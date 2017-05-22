$(document).ready(function(){
  $('input#avatar').change(function(){
    var avatar = $('#avatar')[0].files[0];
    var mime = /image.*/;

    var form = new FormData();
    form.append('avatar',avatar);
    form.append('token', localStorage.getItem('token'))

    $.ajax({
      method:       "POST",
      dataType:     "json",
      url:          "../../server/php/controller/updateAvatar.php",
      data:         form,
      processData:  false,
      contentType:  false
    }).done(function(msg){
      $('img#imageAvatar').attr('src','data:'+msg.mimeAvatar+';base64,'+msg.avatar);
    }).fail(function(jqXHR, textStatus){
      console.log("Request failed: " + textStatus);
    });
  });
});
