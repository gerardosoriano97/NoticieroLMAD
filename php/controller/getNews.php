<?php
include_once(dirname(__DIR__).'/model/news.php');
include_once(dirname(__DIR__).'/data/newsCRUD.php');

$id = $_POST['id'];
$news = new NewsModel();
$news->setId($id);
$nm = new NewsMethods();
$result = $nm->getNews($news);
print_r($result);
 ?>
