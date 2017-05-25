<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');

$search = $_POST['search'];
$json = NewsCRUD::search($search);
print_r(json_encode($json));
 ?>
