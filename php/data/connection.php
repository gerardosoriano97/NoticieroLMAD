<?php

class Connection
{
  private $conn;

  function __construct(){
    //variables para la conexion
    $DB_HOST = 'localhost';
    $DB_NAME = 'noticiero_lmad';
    $DB_USER = 'root';
    $DB_PASS = '';
    $DB_CHARSET = 'utf8';

    //Creamos la conexion a la BD
    $DSN = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
    $OPT = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    //Manejo de errores
    try {
      //creamos la conexion
      $this->conn = new PDO($DSN, $DB_USER, $DB_PASS, $OPT);
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  //funcion para retornar la conexion
  function getConnection(){ return $this->conn; }
  //funcion para cerrar la conexion
  function closeConnection(){
    try {
      $this->conn = null;
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }
}

 ?>
