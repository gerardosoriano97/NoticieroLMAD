require('../bower_components/slick-carousel/slick/slick');
require('../bower_components/jquery-validation/dist/jquery.validate');
$.validator.addMethod("regx", function(value, element, regexpr) {
    return regexpr.test(value);
});

$(document).ready(function(){
  var pathname = $(location).attr('pathname');
  require('./components/header.js')
  switch (pathname) {
    case '/proyectos/PF_BDM/web/html/login.html':
    require('./components/login.js');
      break;
    case '/proyectos/PF_BDM/web/html/register.html':
    require('./components/register.js');
      break;
    case '/proyectos/PF_BDM/web/html/homepage.html':
    require('./components/homepage.js');
      break;
    case '/proyectos/PF_BDM/web/html/admin/news.html':
    require('./components/admin_news.js');
      break;
  }
}).keydown(function(e){
  switch (e.which) {
    case 27:
    if ($('body#admin>div[class^="modal"]').attr('class') == 'modal-show') {
      $('body#admin>div[class^="modal"]').toggleClass('modal-show modal-hide');
    }
      break;
    default: return;
  }
});
