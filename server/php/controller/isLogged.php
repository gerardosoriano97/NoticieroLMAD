<?php
include_once(dirname(__DIR__).'/data/session.php');

$data = Session::getInstance();
if (isset($data->idUser)) {
  print_r('yes');
}else {
  print_r('no');
}
 ?>
