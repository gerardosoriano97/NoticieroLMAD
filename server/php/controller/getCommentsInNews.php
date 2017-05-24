<?php
include_once(dirname(__DIR__).'/data/commentCRUD.php');

$idNews = $_GET['idNews'];

$comment = new Comment();
$comment->setFKidNews($idNews);

$comment = CommentCRUD::getCommentInNews($comment);
foreach ($comment as $key => $value) {
  $comment[$key]['avatarPattern'] = base64_encode($comment[$key]['avatarPattern']);
}
print_r(json_encode($comment));
