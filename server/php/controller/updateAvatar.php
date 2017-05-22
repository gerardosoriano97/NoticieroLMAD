<?php
include_once(dirname(__DIR__).'/data/userCRUD.php');
include_once(dirname(__DIR__).'/data/JWT.php');
include_once(dirname(__DIR__).'/data/session.php');

if (isset($_POST['token'])) {
  //obtenemos el token
  $token = $_POST['token'];
  //obtenemos la session
  $data = Session::getInstance();
  //decodeamos el token
  $token = JWT::decode($token,$data->key);
  //nos aseguramos de la validez del token
  if(array_key_exists("idUser",$token)){
    //si recibimos imagen alguna, proseguimos
    if(isset($_FILES['avatar'])){
      $errors= array();
      $file_name = $_FILES['avatar']['name'];
      $file_size =$_FILES['avatar']['size'];
      $file_tmp =$_FILES['avatar']['tmp_name'];
      $file_type=$_FILES['avatar']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['avatar']['name'])));

      $expensions= array("jpeg","jpg","png");

      if(in_array($file_ext,$expensions)=== false){
        $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }

      if($file_size > 2097152){
        $errors[]='File size must be excately 2 MB';
      }
      //si no ocurrio ningin erro
      if(empty($errors)==true){
        //obtenemos la imagen
        $avatar = file_get_contents($file_tmp);
        //Creamos la variable de usuario
        $user = new User();
        //introducimos los parametros que nos interesa
        $user->setId($token->idUser);
        $user->setAvatar($avatar);
        $user->setMimeAvatar($file_type);
        //lamamos el procedure
        $result = UserCRUD::updateAvatar($user);
        if ($result == 1) {
          //si todo sale bien, seleccionamos el reciente usuario afecado
          $user = UserCRUD::getUser($user);
          $user[0]['avatar'] = base64_encode($user[0]['avatar']);
          print_r(json_encode($user[0]));
          //encodeamos las imagenes recuperada
        }
      }else{
         print_r($errors);
      }
    }
  }else {
    print_r('fail');
  }
}

 ?>
