<?php
include_once('connection.php');
include_once(dirname(__DIR__).'/model/like.php');

class LikeCRUD
{

  function __construct(){}

  function setLike($like){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_setLike(?,?)');
      $stm->bindParam(1,$like->getFKidUser());
      $stm->bindParam(2,$like->getFKidNews());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function setDislike($like){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_setDislike(?,?)');
      $stm->bindParam(1,$like->getFKidUser());
      $stm->bindParam(2,$like->getFKidNews());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function getLike($like){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_getLike(?,?)');
      $stm->bindParam(1,$like->getFKidUser());
      $stm->bindParam(2,$like->getFKidNews());
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
