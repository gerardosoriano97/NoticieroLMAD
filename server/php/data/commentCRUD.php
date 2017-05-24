<?php
include_once('connection.php');
include_once(dirname(__DIR__).'/model/comment.php');

class CommentCRUD
{

  function __construct(){}

  function setComment($comment){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_setComment(?,?,?,?)');
      $stm->bindParam(1,$comment->getComment());
      $stm->bindParam(2,$comment->getFKidUser());
      $stm->bindParam(3,$comment->getFKidNews());
      $stm->bindParam(4,$comment->getFKidComment());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function getCommentInNews($comment){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getCommentInNews(?)');
      $stm->bindParam(1,$comment->getFKidNews());
      $stm->execute();
      $result = $stm->fetchAll();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
}

 ?>
