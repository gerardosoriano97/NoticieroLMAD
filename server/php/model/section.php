<?php

class SectionModel
{
  private $id;
  private $name;
  private $description;

  function __construct(){}

  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getName(){ return $this->name; }
  function setName($name){ $this->name = $name; }

  function getDescription(){ return $this->description; }
  function seteDescription($description){ $this->description = $description; }
}

 ?>
