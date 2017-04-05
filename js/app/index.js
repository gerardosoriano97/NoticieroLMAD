require('../bower_components/slick-carousel/slick/slick');
require('../bower_components/jquery-validation/dist/jquery.validate');
$.validator.addMethod("regx", function(value, element, regexpr) {
    return regexpr.test(value);
});

$(document).ready(function(){
  require('./components/login.js');
  require('./components/register.js');
  require('./components/admin_news.js');
});
