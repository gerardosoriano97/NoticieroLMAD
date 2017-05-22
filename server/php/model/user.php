<?php

class User
{
  private $id;
  private $name;
  private $lastName;
  private $email;
  private $password;
  private $phoneNumber;
  private $birthDate;
  private $avatar;
  private $mimeAvatar;
  private $cover;
  private $mimeCover;
  private $type;

  function __construct(){}

  function getId(){ return $this->id; }
  function setId($id){ $this->id = $id; }

  function getName(){ return $this->name; }
  function setName($name){ $this->name = $name; }

  function getLastName(){ return $this->lastName; }
  function setLastName($lastName){ $this->lastName = $lastName; }

  function getEmail(){ return $this->email; }
  function setEmail($email){ $this->email = $email; }

  function getPassword(){ return $this->password; }
  function setPassword($password){ $this->password = $password; }

  function getPhoneNumber(){ return $this->phoneNumber; }
  function setPhoneNumber($phoneNumber){ $this->phoneNumber = $phoneNumber; }

  function getBithDate(){ return $this->birthDate; }
  function setBirthDate($birthDate){ $this->birthDate = $birthDate; }

  function getCover(){ return $this->cover; }
  function setCover($cover){ $this->cover = $cover; }

  function getMimeCover(){ return $this->mimeCover; }
  function setMimeCover($mimeCover){ $this->mimeCover = $mimeCover; }

  function getAvatar(){ return $this->avatar; }
  function setAvatar($avatar){ $this->avatar = $avatar; }

  function getMimeAvatar(){ return $this->mimeAvatar; }
  function setMimeAvatar($mimeAvatar){ $this->mimeAvatar = $mimeAvatar; }

  function getType(){ return $this->type; }
  function setType($type){ $this->type = $type; }
}

 ?>
