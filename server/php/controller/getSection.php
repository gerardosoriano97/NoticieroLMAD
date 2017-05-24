<?php
include_once(dirname(__DIR__).'/data/sectionCRUD.php');

$id = $_GET['idSection'];

$section = new Section();
$section->setId($id);

$return = SectionCRUD::getSection($section);
print_r(json_encode($return[0]));
 ?>
