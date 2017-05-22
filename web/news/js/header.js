$('body#commercial>div.header').ready(function(){
  //nos traemos las secciones
  $.ajax({
    method:   "POST",
    dataType: "json",
    url:      "../../server/php/controller/getAllSections.php"
  }).done(function(msg){
    $.each(msg,function(key,val){
      $("ul.sections").append(''+
        '<li><a href="index.html?idSection='+val.idSection+'">'+
          val.sectionName+
        '</a></li>'
      );
    });
  }).fail(function(jqXHR, textStatus){
    console.log("Request failed: " + textStatus);
  });

  //checamos si inicio sesión
  let token = localStorage.getItem("token");
  if (token != 'undefined' && token != null) {
    //habilitamos perfil y singout; deshabilitamos singin
    $('.header > .userInfo').removeClass('hidden');
    $('.header > button[name="singOut"]').removeClass('hidden');
    $('.header > button[name="singIn"]').addClass('hidden');
    //obtenemos la información del usuario
    let user = localStorage.getItem("userInfo");
    user = JSON.parse(user);
    //apendizamos al userInfo nuestro nombre completo con referencia a nuestro perfil
    $('.header > .userInfo').append(''+
      '<a href="profile.html">' +
        '<h1>'+ user.fullname +'</h1>' +
      '</a>'
    );
  }else {
    //deshabilitamos perfil y singout; habilitamos singin
    $('.header > .userInfo').addClass('hidden');
    $('.header > button[name="singOut"]').addClass('hidden');
    $('.header > button[name="singIn"]').removeClass('hidden');
  }
  //si da clic en iniciar sesión
  $('.header > button[name="singIn"]').on('click',function(){
    window.location.href = 'login.html';
  });
  //si da clic en cerrar sesión
  $('.header > button[name="singOut"]').on('click',function(){
    $.ajax({
      method:   "POST",
      url:      "../../server/php/controller/logout.php",
      data:     {"token": token}
    }).done(function(msg){
      if (msg == 'success') {
        localStorage.removeItem('token');
        localStorage.removeItem('userInfo');
        location.reload();
      }else {
        console.log('algo fallo al destruir tu sesión');
      }
    });
  });
});
