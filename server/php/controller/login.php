<?php
include_once(dirname(__DIR__).'/model/user.php');
include_once(dirname(__DIR__).'/data/userCRUD.php');
include_once(dirname(__DIR__).'/data/session.php');

$json = $_POST['json'];
$obj = json_decode($json);
$user = new UserModel();
$user->setEmail($obj->email);
$user->setPassword(md5($obj->password));
$um = new UserMethods();
$result = $um->loginUser($user);
if ($result != '[]') {
  try {
    $data = Session::getInstance();
    $data->idUser       = $result[0]['idUser'];
    $data->name         = $result[0]['name'];
    $data->lastName     = $result[0]['lastName'];
    $data->phoneNumber  = $result[0]['phoneNumber'];
    $data->birthDate    = $result[0]['birthDate'];
    $data->avatar       = $result[0]['avatar'];
    $data->cover        = $result[0]['cover'];
    $data->fk_idType    = $result[0]['fk_idType'];
    print_r('success');
  } catch (Exception $e) {
    print_r('Algo fallo al iniciar sesión');
  }
}
 ?>
