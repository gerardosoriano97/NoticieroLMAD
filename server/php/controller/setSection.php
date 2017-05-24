<?php
include_once(dirname(__DIR__).'/data/sectionCRUD.php');

$json = $_POST['json'];
$json = json_decode($json);

$section = new Section();
$section->setId($json->id);
$section->setName($json->sectionName);
$section->setDescription($json->sectionDescription);

if ($json->id != '') {
  $return = SectionCRUD::updateSection($section);
}else {
  $return = SectionCRUD::setSection($section);
}
if ($return == 1) {
  print_r("success");
}
 ?>
