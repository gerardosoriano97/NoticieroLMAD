<?php
include_once(dirname(__DIR__).'/data/sectionCRUD.php');

$return = SectionCRUD::getAllSections();
print_r(json_encode($return));
 ?>
