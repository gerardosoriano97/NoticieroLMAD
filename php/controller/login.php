<?php
include_once(dirname(__DIR__).'/model/user.php');
include_once(dirname(__DIR__).'/data/userCRUD.php');

$json = $_POST['json'];
$obj = json_decode($json);
$user = new UserModel();
$user->setEmail($obj->email);
$user->setPassword(md5($obj->password));
$um = new UserMethods();
$result = $um->loginUser($user);
print_r($result);
 ?>
