<?php
include_once(dirname(__DIR__).'/data/commentCRUD.php');
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
    $obj = $_POST['json'];
    $obj = json_decode($obj);

    $idNews = $_GET['idNews'];

    $comment = new Comment();
    $comment->setComment($obj->comment);
    $comment->setFKidUser($token->idUser);
    $comment->setFKidNews($idNews);

    $result = CommentCRUD::setComment($comment);
    if($result == 1){
      $comment = CommentCRUD::getCommentInNews($comment);
      foreach ($comment as $key => $value) {
        $comment[$key]['avatarPattern'] = base64_encode($comment[$key]['avatarPattern']);
      }
      print_r(json_encode($comment));
    }
  }
}
 ?>
