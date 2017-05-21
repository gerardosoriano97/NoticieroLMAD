<?php

class News
{
  private $id;
  private $title;
  private $description;
  private $content;
  private $state;
  private $releaseDate;
  private $style;
  private $fk_idUser;
  private $fk_idSection;

  function __construct(){

  }


  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getTitle(){ return $this->title; }
  function setTitle($title){ $this->title = $title; }

  function getDescription(){ return $this->description; }
  function setDescription($description){ $this->description = $description; }

  function getContent(){ return $this->content; }
  function setContent($content){ $this->content = $content; }

  function getState(){ return $this->state; }
  function setState($state){ $this->state = $state; }

  function getReleaseDate(){ return $this->releaseDate; }
  function setReleaseDate($releaseDate){ $this->releaseDate = $releaseDate; }

  function getStyle(){ return $this->style; }
  function setStyle($style){ $this->style = $style; }

  function getFKidUser(){ return $this->fk_idUser; }
  function setFKidUser($fk_idUser){ $this->fk_idUser = $fk_idUser; }

  function getFKidSection(){ return $this->fk_idSection; }
  function setFKidSection($fk_idSection){ $this->fk_idSection = $fk_idSection; }
}

 ?>
