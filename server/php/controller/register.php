<?php
include_once(dirname(__DIR__).'/data/userCRUD.php');
include_once(dirname(__DIR__).'/data/JWT.php');
include_once(dirname(__DIR__).'/data/session.php');

//obtenemos la info
$json = $_POST['json'];
$obj = json_decode($json);
//creamos una variable con su info
$user = new User();
$user->setName($obj->name);
$user->setLastName($obj->lastName);
$user->setEmail($obj->email);
$user->setPassword(md5($obj->password));
$user->setType(3);
//lo registramos
$result = UserCRUD::setUser($user);
if ($result == 1) {
  //si funciono, obtenemos su información.
  $user = UserCRUD::loginUser($user);
  //encodeamos nuestras imagenes
  $user[0]['avatar'] = base64_encode($user[0]['avatar']);
  $user[0]['cover'] = base64_encode($user[0]['cover']);
  //creamos la variable que vamos a retornar
  $return = array(
    'userInfo' => $user[0]
  );
  //después le generamos un token
  $key = '9286'.rand();
  $token = array(
    'idUser' => $user[0]['idUser'],
    'fullname' => $user[0]['fullname'],
    'email' => $user[0]['email'],
    'type' => $user[0]['type']
  );
  $token = JWT::encode($token,$key);
  $return['token'] = $token;
  //le iniciamos sesión
  try {
    $data = Session::getInstance();
    $data->key = $key;
    $return['sesion'] = 'success';
  } catch (Exception $e) {
    $return['sesion'] = 'fail';
  }
  //regresamos los datos
  print_r(json_encode($return));
}else {
  print_r('fail');
}
 ?>
