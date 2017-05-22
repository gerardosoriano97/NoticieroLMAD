<?php
include_once(dirname(__DIR__).'/data/JWT.php');
include_once(dirname(__DIR__).'/data/session.php');

if (isset($_POST['token'])) {
  //obtenemos el token
  $token = $_POST['token'];
  //obtenemos la sesión
  $data = Session::getInstance();
  //decodeamos el token
  $token = JWT::decode($token,$data->key);
  if(array_key_exists("idUser",$token)){
    $data->destroy();
    print_r('success');
  }else {
    print_r('fail');
  }
}
 ?>
