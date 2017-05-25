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
  function order($type,$news){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_order(?,?)');
      $stm->bindParam(1,$type);
      $stm->bindParam(2,$news->getFKidSection());
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
      return $result;
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
  function setNews($news){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_setNews(?,?,?,?,?,?,?,?)');
      $stm->bindParam(1,$news->getId());
      $stm->bindParam(2,$news->getTitle());
      $stm->bindParam(3,$news->getDescription());
      $stm->bindParam(4,$news->getContent());
      $stm->bindParam(5,$news->getState());
      $stm->bindParam(6,$news->getStyle());
      $stm->bindParam(7,$news->getFKidUser());
      $stm->bindParam(8,$news->getFKidSection());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function search($search){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_search(?)');
      $stm->bindParam(1,$search);
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
