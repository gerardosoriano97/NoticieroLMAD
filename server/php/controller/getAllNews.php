<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');

$nm = new NewsMethods();
$json = $nm->getAllNews();
print_r(json_encode($json));
 ?>
