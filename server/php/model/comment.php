<?php

class Comment
{
  private $id;
  private $comment;
  private $publication;
  private $fk_idUser;
  private $fk_idNews;
  private $fk_idComment;

  function __construct(){}

  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getComment(){ return $this->comment; }
  function setComment($comment){ $this->comment = $comment; }

  function getPublication(){ return $this->publication; }
  function setPublication($publication){ $this->publication = $publication; }

  function getFKidUser(){ return $this->fk_idUser; }
  function setFKidUser($fk_idUser){ $this->fk_idUser = $fk_idUser; }

  function getFKidNews(){ return $this->fk_idNews; }
  function setFKidNews($fk_idNews){ $this->fk_idNews = $fk_idNews; }

  function getFKidComment(){ return $this->fk_idComment; }
  function setFKidComment($fk_idComment){ $this->fk_idComment = $fk_idComment; }
}

 ?>
