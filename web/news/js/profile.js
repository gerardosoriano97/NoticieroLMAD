$(document).ready(function(){
  $('input#avatar').change(function(){
    var avatar = $('#avatar')[0].files[0];
    var mime = /image.*/;

    var form = new FormData();
    form.append('avatar',avatar);
    form.append('token', localStorage.getItem('token'))

    $.ajax({
      method:       "POST",
      url:          "../../server/php/controller/test.php",
      data:         form,
      processData:  false,
      contentType:  false,
    }).done(function(msg){
      console.log(msg);
    }).fail(function(jqXHR, textStatus){
      console.log("Request failed: " + textStatus);
    });
  });
});
