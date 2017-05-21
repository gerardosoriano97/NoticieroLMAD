<?php
include_once('connection.php');
include_once(dirname(__DIR__).'/model/user.php');

class UserCRUD
{

  function __construct(){}

  function getAllUsers(){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getAllUsers()');
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
  function setUser($user){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $stm = $conn->prepare('call sp_setUser(?,?,?,?,?,?,?,?,?)');
      $stm->bindParam(1,$user->getName());
      $stm->bindParam(2,$user->getLastName());
      $stm->bindParam(3,$user->getEmail());
      $stm->bindParam(4,$user->getPassword());
      $stm->bindParam(5,$user->getPhoneNumber());
      $stm->bindParam(6,$user->getBithDate());
      $stm->bindParam(7,$user->getCover());
      $stm->bindParam(8,$user->getAvatar());
      $stm->bindParam(9,$user->getFKidType());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function getUser($user){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_getUser(?)');
      $stm->bindParam(1,$user->getId());
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
  function dropUser($user){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_dropUser(?)');
      $stm->bindParam(1,$user->getId());
      $result = $stm->execute();
      return $result;
    } catch (PDOException $e) {
      die($e->getMessage());
    } finally {
      $conn = null;
      $pdo->closeConnection();
    }
  }
  function loginUser($user){
    $pdo = new Connection();
    $conn = $pdo->getConnection();
    try {
      $result = array();
      $stm = $conn->prepare('call sp_login(?,?)');
      $stm->bindParam(1,$user->getEmail());
      $stm->bindParam(2,$user->getPassword());
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
