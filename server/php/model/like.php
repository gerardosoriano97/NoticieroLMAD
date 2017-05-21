<?php

class Like
{
  private $id;
  private $fk_idUser;
  private $fk_idNews;

  function __construct(){}
  function __construct(){}

  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getFKidUser(){ return $this->fk_idUser; }
  function setFKidUser($fk_idUser){ $this->fk_idUser = $fk_idUser; }

  function getFKidNews(){ return $this->fk_idNews; }
  function setFKidNews($fk_idNews){ $this->fk_idNews = $fk_idNews; }
}

 ?>
