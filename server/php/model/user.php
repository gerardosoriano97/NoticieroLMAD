<?php

class UserModel
{
  private $id;
  private $name;
  private $lastName;
  private $email;
  private $password;
  private $phoneNumber;
  private $birthDate;
  private $cover;
  private $avatar;
  private $fk_idType;

  function __construct(){
    $this->id = null;
    $this->name = null;
    $this->lastName = null;
    $this->email = null;
    $this->password = null;
    $this->phoneNumber = null;
    $this->birthDate = null;
    $this->cover = null;
    $this->avatar = null;
    $this->fk_idType = null;
  }
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

  function getAvatar(){ return $this->avatar; }
  function setAvatar($avatar){ $this->avatar = $avatar; }

  function getFKidType(){ return $this->fk_idType; }
  function setFKidType($fk_idType){ $this->fk_idType = $fk_idType; }
}

 ?>
