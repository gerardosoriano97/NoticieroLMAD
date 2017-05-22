$.validator.addMethod("regx", function(value, element, regexpr) {
    return regexpr.test(value);
});

$(document).ready(function(){
  $('form#loginForm').validate({
    debug: true,
    rules:{
      email:{
        required: true,
        regx: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
      },
      password:{
        required: true,
        regx: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/
      }
    },
    messages:{
      email: {
        required: "Este campo necesita ser rellenado",
        regx: "Por favor ingresa un correo valido"
      },
      password: {
        required: "Necesitas introducir una contraseña",
        regx: "Tu contraseña debe de tener una mayucula, una minuscula y por lo menos un número"
      }
    },
    invalidHandler: function(event, validator) {
      var errors = validator.numberOfInvalids();
      if (errors) {
        var message = errors == 1
          ? 'Tienes un campo que no cumple con lo requerido'
          : 'Tienes ' + errors + ' campos que no cumplen con lo requerido';
        alert(message);
      }
    },
    submitHandler: function(form) {
      let jsonObj = {};
      $(form).find(".toJson").each(function(key, value){
        jsonObj[$(value).attr("name")] = $(value).val();
      });
      let json = JSON.stringify(jsonObj);
      $.ajax({
        method:   "POST",
        dataType: "json",
        url:      "../../server/php/controller/login.php",
        data:     {"json": json}
      }).done(function(msg){
        if (msg.sesion == 'success') {
          localStorage.token = msg.token;
          window.location.href = "index.html";
        }
      });
    }
  });
  $("form#registerForm").validate({
    debug: true,
    rules: {
      name: {
        required: true,
        regx: /^[a-zA-Z\s]+$/
      },
      lastName: {
        required: true,
        regx: /^[a-zA-Z\s]+$/
      },
      email: {
        required: true,
        regx: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
      },
      password: {
        required: true,
        regx: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z])/
      },
      rePassword: {
        required: true,
        equalTo: "#password"
      }
    },
    messages: {
      name:{
        required: "Por favor, introduce tu nombre",
        regx: "Recuerda que no se aceptan números"
      },
      lastName:{
        required: "Por favor, introduce tu apellido",
        regx: "Por favor, escribe tus apellidos, recuerda que no se aceptan números"
      },
      email:{
        required: "Necesitas introducir un correo",
        regx: "Por favor ingresa un correo valido"
      },
      password:{
        required: "Debes de tener una contraseña",
        regx: "Tu contraseña debe de tener una mayucula, una minuscula y por lo menos un número"
      },
      rePassword:{
        required: "Necesitas rellenar este campo",
        regx: "Las contraseñas no coinciden"
      }
    },
    invalidHandler: function(event, validator){
      var errors = validator.numberOfInvalids();
      if (errors) {
        var message = errors == 1
          ? 'Tienes un campo que no cumple con lo requerido'
          : 'Tienes ' + errors + ' campos que no cumplen con lo requerido';
        alert(message);
      }
    },
    submitHandler: function(form){
      let jsonObj = {};
      $(form).find(".toJson").each(function(key, value){
        jsonObj[$(value).attr("name")] = $(value).val();
      });
      let json = JSON.stringify(jsonObj);
      $.ajax({
        method:   "POST",
        dataType: "json",
        url:      "../../server/php/controller/register.php",
        data:     {"json": json}
      }).done(function(msg){
        if (msg.sesion == 'success') {
          localStorage.token = msg.token;
          window.location.href = "index.html";
        }
      });
    }
  })

  $('div.links>a.login').click(function () {
    $('form#loginForm').show();
    $('form#registerForm').hide();
  });
  $('div.links>a.register').click(function () {
    $('form#loginForm').hide();
    $('form#registerForm').show();
  });
});
