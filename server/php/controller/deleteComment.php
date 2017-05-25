<?php
include_once(dirname(__DIR__).'/data/commentCRUD.php');

$idNews = $_GET['idNews'];
$idComment = $_POST['idComment'];

$comment = new Comment();
$comment->setId($idComment);
$comment->setFKidNews($idNews);

$result = CommentCRUD::deleteComment($comment);
if ($result == 1) {  
  $comment = CommentCRUD::getCommentInNews($comment);
  foreach ($comment as $key => $value) {
    $comment[$key]['avatarPattern'] = base64_encode($comment[$key]['avatarPattern']);
  }
  print_r(json_encode($comment));
}

 ?>
