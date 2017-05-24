<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');

$json = NewsCRUD::getAllNews();
print_r(json_encode($json));
 ?>
