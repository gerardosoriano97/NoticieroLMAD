<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');
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
    $json = $_POST['json'];
    $json = json_decode($json);

    $news = new News();
    if ($json->id != '') {
      $news->setId($json->id);
    }else {
      $news->setId(null);
    }
    $news->setTitle($json->title);
    $news->setDescription($json->description);
    $news->setContent($json->content);
    if ($json->state) {
      $news->setState(1);
    }else {
      $news->setState(0);
    }
    $news->setStyle($json->style);
    $news->setFKidUser($json->idUser);
    $news->setFKidSection($json->section);

    $result = NewsCRUD::setNews($news);
    if($result == 1){
      print_r('success');
    }
  }
}
 ?>
