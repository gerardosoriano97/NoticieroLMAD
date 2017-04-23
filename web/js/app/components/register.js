$("form.registerForm").validate({
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
    name: "Por favor, escribe tu nombre, recuerda que no se aceptan números",
    lastName: "Por favor, escribe tus apellidos, recuerda que no se aceptan números",
    email: "Por favor ingresa un correo valido",
    password: "Tu contraseña debe de tener una mayucula, una minuscula y por lo menos un número",
    rePassword: "Las contraseñas no coinciden"
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
      url:      "./../php/controller/register.php",
      data:     {"json": json}
    }).done(function(msg){
      if (msg == "success") {
        window.location.href = "login.html";
      }
    });
  }
})
