<?php
include_once(dirname(__DIR__).'/data/userCRUD.php');
include_once(dirname(__DIR__).'/data/commentCRUD.php');

$obj = $_POST['json'];
$obj = json_decode($obj);

$idNews = $_GET['idNews'];

$user = new User();
$user->setName('guest');
$user->setEmail($obj->email);
$user->setType('anónimo');

$user = UserCRUD::setUserForComment($user);

$comment = new Comment();
$comment->setComment($obj->comment);
$comment->setFKidUser($user[0]['idUser']);
$comment->setFKidNews($idNews);
$result = CommentCRUD::setComment($comment);
if($result == 1){
  $comment = CommentCRUD::getCommentInNews($comment);
  foreach ($comment as $key => $value) {
    $comment[$key]['avatarPattern'] = base64_encode($comment[$key]['avatarPattern']);
  }
  print_r(json_encode($comment));
}
 ?>
