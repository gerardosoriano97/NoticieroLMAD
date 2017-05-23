$.validator.addMethod("regx", function(value, element, regexpr) {
    return regexpr.test(value);
});

$(document).ready(function(){
  //Obtenemos toda la info del usuario
  var user = JSON.parse(localStorage.getItem('userInfo'));
  //rellenamos todos los inputs que tengan que ver con la info del usuario
  if (user.cover != null && user.cover != '') {
    $('img#imageCover').attr('src','data:'+user.mimeCover+';base64,'+user.cover);
  }
  if (user.avatar != null && user.avatar != '') {
    $('img#imageAvatar').attr('src','data:'+user.mimeAvatar+';base64,'+user.avatar);
  }
  $('h1#fullname').append(user.fullname);
  if (user.years != null && user.years != '') {
    $('h1#fullname').append('('+ user.years +' años)');
  }
  $('input[name="name"]').attr('value',user.name);
  $('input[name="lastName"]').attr('value',user.lastName);
  $('input[name="email"]').attr('value',user.email);
  $('input[name="phoneNumber"]').attr('value',user.phoneNumber);
  $('input[name="birthDate"]').attr('value',user.birthDate);
  $('input[name="type"]').attr('value',user.type);

  //Si el input del cover cambia, mandamos la imagen seleccionada
  $('input#cover').change(function(){
    var cover = $('#cover')[0].files[0];
    var mime = /image.*/;

    var form = new FormData();
    form.append('cover',cover);
    form.append('token', localStorage.getItem('token'))

    $.ajax({
      method:       "POST",
      dataType:     "json",
      url:          "../../server/php/controller/updateCover.php",
      data:         form,
      processData:  false,
      contentType:  false
    }).done(function(msg){
      $('img#imageCover').attr('src','data:'+msg.mimeCover+';base64,'+msg.cover);
      localStorage.userInfo = JSON.stringify(msg);
    }).fail(function(jqXHR, textStatus){
      console.log("Request failed: " + textStatus);
    });
  });
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
      $('.header .profilePicture > img').attr('src','data:'+msg.mimeAvatar+';base64,'+msg.avatar)
      localStorage.userInfo = JSON.stringify(msg);
    }).fail(function(jqXHR, textStatus){
      console.log("Request failed: " + textStatus);
    });
  });
  //Al dar click en el boton de editar, se cambia el icono
  $('button#editSave').on('click', edit);

  function edit(){
    $('button#editSave > i').attr('class','fa fa-floppy-o');
    $('button#editSave > span').empty().text('Guardar');
    $('form.userInfo input:not([name="type"],[name="email"])').prop('readonly',false);
    $("button#editSave").off('click').on('click', save);
  }
  function save(){
    $('form.userInfo').validate({
      debug:true,
      rules:{
        name:{
          required:true,
          regx:/^[a-zA-Z\s]+$/
        },
        lastName:{
          required:true,
          regx:/^[a-zA-Z\s]+$/
        },
        email:{
          required:true,
          regx:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        },
        phoneNumber:{
          required:false,
        },
        birthDate:{
          required:false,
        },
        type:{
          required:false,
          regx:/^[a-zA-Z\s]+$/
        }
      },
      messages:{
        name:{
          required:"Necesitas tener un nombre",
          regx:"Introduce un nombre valido"
        },
        lastName:{
          required:"Necesitas tener un apellido",
          regx:"Introduce un apellido valido"
        },
        email:{
          required:"Necesitas tener un correo"
        },
        type:{
          required:"Necesitas este campo",
          regx:"Introduce un tipo valido"
        }
      }
    });
    if ($('form.userInfo').valid()) {
      let jsonObj = {};
      $('form.userInfo').find(".toJson").each(function(key, value){
        jsonObj[$(value).attr("name")] = $(value).val();
      });
      let json = JSON.stringify(jsonObj);
      $.ajax({
        method:   "POST",
        dataType: "json",
        url:      "../../server/php/controller/updateInfo.php",
        data:     {"json": json, "token": localStorage.getItem("token")}
      }).done(function(data){
        if (data.msg == 'success') {
          localStorage.userInfo = JSON.stringify(data.userInfo);
          let user = JSON.parse(localStorage.getItem('userInfo'));

          $('button#editSave > i').attr('class','fa fa-pencil-square-o');
          $('button#editSave > span').empty().text('Editar');
          $('form.userInfo input:not([name="type"],[name="email"])').prop('readonly',true);
          $("button#editSave").off('click').on('click', edit);

          $('.header .userInfo > a > h1').empty().append(user.fullname);
          $('h1#fullname').empty().append(user.fullname);
          if (user.years != null && user.years != '') {
            $('h1#fullname').append('('+ user.years +' años)');
          }
        }
      });
    }
  }
});
