<?php
include_once(dirname(__DIR__).'/data/sectionCRUD.php');

$sm = new SectionMethods();
$json = $sm->getAllSections();
print_r($json);
 ?>
