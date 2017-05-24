$.validator.addMethod("regx", function(value, element, regexpr) {
    return regexpr.test(value);
});

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
  $.ajax({
    method:   "GET",
    dataType: "json",
    url:      "../../server/php/controller/getCommentsInNews.php" + $(location).attr('search')
  }).done(function(data){
    $.each(data,function(key,val){
      let path;
      if (val.mimeAvatarPattern != null && val.mimeAvatarPattern != '') {
        path = 'data:'+val.mimeAvatarPattern+';base64,'+val.avatarPattern;
      }else {
        path = '../resources/images/user.png';
      }
      $('div.commentsContainer').append(''+
        '<div class="comment">'+
          '<div class="userImage">'+
            '<img src="'+path+'" alt="">'+
          '</div>'+
          '<div class="square"></div>'+
          '<div class="commentInfo">'+
            '<h1>'+val.fullname+'</h1>'+
            '<h2>'+val.commentPattern+'</h2>'+
            '<h3>'+val.publicationPattern+'</h3>'+
          '</div>'+
        '</div>'
      );
    });
  })
  //checamos si inicio sesión
  let token = localStorage.getItem("token");
  let isRegistered;
  if (token != 'undefined' && token != null) {
    isRegistered = true;
    //ocultamos el input del email
    $('form.commentForm > input[name="email"]').removeClass('toJson').addClass('hidden');
    //obtenemos la información del usuario
    let user = localStorage.getItem("userInfo");
    user = JSON.parse(user);
    //apendizamos al userInfo nuestra imagem y nuestro nombre completo con referencia a nuestro perfil
    $('div.writeSection > div.userImage > img').attr('src','data:'+user.mimeAvatar+';base64,'+user.avatar);
  }else {
    isRegistered = false;
  }

  $('form.commentForm > input#submit').on('click',function(e){
    e.preventDefault();
    if (isRegistered) {
      $('form.commentForm').validate({
        debug:true,
        rules:{
          comment:{
            required: true,
            maxlength: 255
          }
        },
        messages:{
          comment:{
            required:'Necesitas escribir algo para publicar',
            maxlength:'No puedes escribir mas de 255 caracteres'
          }
        }
      });

      if ($('form.commentForm').valid()) {
        let jsonObj = {};
        $('form.commentForm').find(".toJson").each(function(key, value){
          jsonObj[$(value).attr("name")] = $(value).val();
        });
        let json = JSON.stringify(jsonObj);

        $('form.commentForm>textarea[name="comment"]').val('');

        $.ajax({
          method:   "POST",
          dataType: "json",
          url:      "../../server/php/controller/commentByExistentUser.php" + $(location).attr('search'),
          data:     {"json": json, "token": localStorage.getItem("token")}
        }).done(function(data){
          $('div.commentsContainer').empty();
          $.each(data,function(key,val){
            if (val.mimeAvatarPattern != null && val.mimeAvatarPattern != '') {
              let path = 'data:'+val.mimeAvatarPattern+';base64,'+val.avatarPattern;
            }else {
              let path = '../resources/images/user.png';
            }
            $('div.commentsContainer').append(''+
              '<div class="comment">'+
                '<div class="userImage">'+
                  '<img src="'+path+'" alt="">'+
                '</div>'+
                '<div class="square"></div>'+
                '<div class="commentInfo">'+
                  '<h1>'+val.fullname+'</h1>'+
                  '<h2>'+val.commentPattern+'</h2>'+
                  '<h3>'+val.publicationPattern+'</h3>'+
                '</div>'+
              '</div>'
            );
          });
        });
      }
    }else {
      $('form.commentForm').validate({
        debug:true,
        rules:{
          email:{
            required: true,
            regx: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
          },
          comment:{
            required: true,
            maxlength: 255
          }
        },
        messages:{
          email:{
            required: 'Necesitas ingresar tu correo para poder comentar',
            regx: 'Necesitas introducir un correo validlo'
          },
          comment:{
            required:'Necesitas escribir algo para publicar',
            maxlength:'No puedes escribir mas de 255 caracteres'
          }
        }
      });

      if ($('form.commentForm').valid()) {
        let jsonObj = {};
        $('form.commentForm').find(".toJson").each(function(key, value){
          jsonObj[$(value).attr("name")] = $(value).val();
        });
        let json = JSON.stringify(jsonObj);

        $('form.commentForm>textarea[name="comment"]').val('');

        $.ajax({
          method:   "POST",
          dataType: "json",
          url:      "../../server/php/controller/commentByNewUser.php" + $(location).attr('search'),
          data:     {"json": json}
        }).done(function(data){
          $('div.commentsContainer').empty();
          $.each(data,function(key,val){
            if (val.mimeAvatarPattern != null && val.mimeAvatarPattern != '') {
              let path = 'data:'+val.mimeAvatarPattern+';base64,'+val.avatarPattern;
            }else {
              let path = '../resources/images/user.png';
            }
            $('div.commentsContainer').append(''+
              '<div class="comment">'+
                '<div class="userImage">'+
                  '<img src="'+path+'" alt="">'+
                '</div>'+
                '<div class="square"></div>'+
                '<div class="commentInfo">'+
                  '<h1>'+val.fullname+'</h1>'+
                  '<h2>'+val.commentPattern+'</h2>'+
                  '<h3>'+val.publicationPattern+'</h3>'+
                '</div>'+
              '</div>'
            );
          });
        });
      }
    }
  });
});
