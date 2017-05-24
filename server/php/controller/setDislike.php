<?php
include_once(dirname(__DIR__).'/data/likeCRUD.php');
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
    $idNews = $_GET['idNews'];

    $like = new Like();
    $like->setFKidUser($token->idUser);
    $like->setFKidNews($idNews);

    $result = LikeCRUD::setDislike($like);
    if($result == 1){
      print_r('success');
    }
  }
}
 ?>
