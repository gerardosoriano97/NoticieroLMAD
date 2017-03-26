<?php
include('connection.php');
include(dirname(__DIR__).'/model/news.php');

//aqui crearemos todos los metodos de las noticias
class NewsMethods
{

  function __construct(){}

  function getRecentNews(){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getRecentNews()');
      $stm->execute();
      foreach ($stm->fetchAll() as $r) {
        $news = new NewsModel();
          $news->setId($r['idNews']);
          $news->setTitle($r['title']);
          $news->setDescription($r['description']);
          $news->setContent($r['content']);
          $news->setState($r['state']);
          $news->setReleaseDate($r['releaseDate']);
          $news->setFKidUser($r['fk_idUser']);
          $news->setFKidSection($r['fk_idSection']);
          $news->setFKidStyle($r['fk_idUser']);

        $result[] = $news;
      }
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
