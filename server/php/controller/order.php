<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');

if (isset($_GET['idSection'])) {
  $idSection = $_GET['idSection'];
  $type = $_POST['order'];
  $news = new News();
  $news->setFKidSection($idSection);
  $return = NewsCRUD::order($type,$news);
  print_r(json_encode($return));
}else {
  $type = $_POST['order'];
  $news = new News();
  $return = NewsCRUD::order($type,$news);
  print_r(json_encode($return));
}
 ?>
