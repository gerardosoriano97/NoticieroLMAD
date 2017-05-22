<?php
include_once('connection.php');
include_once(dirname(__DIR__).'/model/news.php');

//aqui crearemos todos los metodos de las noticias
class NewsCRUD
{

  function __construct(){}

  function getRecentNews($news,$start){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getRecentNews(?,?)');
      $stm->bindParam(1,$news->getStyle());
      $stm->bindParam(2,$start);
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
  function getRecentNewsBySection($news,$start){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getRecentNewsBySection(?,?,?)');
      $stm->bindParam(1,$news->getFKidSection());
      $stm->bindParam(2,$news->getStyle());
      $stm->bindParam(3,$start);
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
  function getAllNews(){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getAllNews()');
      $stm->execute();
      $result = $stm->fetchAll();
      return json_encode($result);
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function getNews($news){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getNews(?)');
      $stm->bindParam(1,$news->getId());
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
  function getMultimediaByNews($news){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getMultimediaByNews(?)');
      $stm->bindParam(1,$news->getId());
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
