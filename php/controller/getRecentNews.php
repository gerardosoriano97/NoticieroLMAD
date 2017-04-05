<?php
  include_once(dirname(__DIR__).'/data/newsCRUD.php');

  $nm = new NewsMethods();
  $json = $nm->getRecentNews();
  print_r($json);
 ?>
