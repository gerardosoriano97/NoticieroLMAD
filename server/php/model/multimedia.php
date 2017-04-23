<?php

class MultimediaModel
{
  private $id;
  private $path;
  private $description;
  private $type;
  private $fk_idNews;

  function __construct(){}
  function __construct($id,$path,$description,$type,$fk_idNews){
    $this->id = $id;
    $this->path = $path;
    $this->description = $description;
    $this->type = $type;
    $this->fk_idNews = $fk_idNews;
  }

  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getPath(){ return $this->path; }
  function setPath($path){ $this->path = $path; }

  function getDescription(){ return $this->description; }
  function seteDescription($description){ $this->description = $description; }

  function getType(){ return $this->type; }
  function setType($type){ $this->type = $type; }

  function getFKidNews(){ return $this->fk_idNews; }
  function setFKidNews($fk_idNews){ $this->fk_idNews = $fk_idNews; }
}

 ?>
