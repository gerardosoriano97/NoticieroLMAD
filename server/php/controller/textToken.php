<?php
include_once(dirname(__DIR__).'/data/JWT.php');

$key = '9286';
$token = array(
  'idUsuario' => 1,
  'username' => 'Soriano'
);
print_r($token);
$token = JWT::encode($token,$key);
print_r($token);
$token = JWT::decode($token,$key);
print_r($token);
 ?>
