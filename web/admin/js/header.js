$(document).ready(function(){
  //checamos si inicio sesión
  let user = JSON.parse(localStorage.getItem('userInfo'));
  //preguntamos si es resportero o administrador
  if (user.type != 'registrado' && user.type != 'administrador') {
    window.location.href = "../news/index.html";
  }else {
    $('h1.fullname').empty().append(user.fullname);
    $('span.fullname').empty().append(user.fullname+'<br>('+user.type+')');
    if (user.avatar != '') {
      $('div.profilePicture > img').attr('src','data:'+user.mimeAvatar+';base64,'+user.avatar);
    }
  }
});
