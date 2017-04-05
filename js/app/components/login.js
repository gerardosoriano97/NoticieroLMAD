$('form.loginForm').validate({
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
    email: "Por favor ingresa un correo valido",
    password: "Tu contraseña debe de tener una mayucula, una minuscula y por lo menos un número"
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
      url:      "./../php/controller/login.php",
      data:     {"json": json}
    }).done(function(msg){
      if (msg == "success") {
        alert('jalo we');
      }
    });
  }
});
