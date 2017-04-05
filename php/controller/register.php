<?php
include_once(dirname(__DIR__).'/model/user.php');
include_once(dirname(__DIR__).'/data/userCRUD.php');

$json = $_POST['json'];
$obj = json_decode($json);
$user = new UserModel();
$user->setName($obj->name);
$user->setLastName($obj->lastName);
$user->setEmail($obj->email);
$user->setPassword(md5($obj->password));
$user->setFKidType(3);
$um = new UserMethods();
$result = $um->setUser($user);
if ($result == 1) {
  echo "success";
}
 ?>
