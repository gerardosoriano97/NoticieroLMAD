<?php
include_once(dirname(__DIR__).'/data/userCRUD.php');
include_once(dirname(__DIR__).'/data/JWT.php');
include_once(dirname(__DIR__).'/data/session.php');

if (isset($_POST['token'])) {
  //obtenemos el token
  $token = $_POST['token'];
  //obtenemos la session
  $data = Session::getInstance();
  //decodeamos el token
  $token = JWT::decode($token,$data->key);
  //nos aseguramos de la validez del token
  if(array_key_exists("idUser",$token)){
    $obj = $_POST['json'];
    $obj = json_decode($obj);

    $user = new User();
    $user->setId($token->idUser);
    $user->setName($obj->name);
    $user->setLastName($obj->lastName);
    $user->setEmail($obj->email);
    $user->setPhoneNumber($obj->phoneNumber);
    $user->setBirthDate($obj->birthDate);
    $user->setType($obj->type);

    $result = UserCRUD::setUser($user);
    if($result == 1){
      $user = UserCRUD::getUser($user);
      $user[0]['avatar'] = base64_encode($user[0]['avatar']);
      $user[0]['cover'] = base64_encode($user[0]['cover']);
      $return = array(
        'userInfo' => $user[0],
        'msg' => 'success'
      );
      print_r(json_encode($return));
    }
  }
}
 ?>
