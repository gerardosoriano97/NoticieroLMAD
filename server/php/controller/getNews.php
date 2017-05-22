<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');

$idNews = $_GET['idNews'];

$news = new News();
$news->setId($idNews);
$multimedia = NewsCRUD::getMultimediaByNews($news);
$news = NewsCRUD::getNews($news);

$return = array(
  'news' => $news[0],
  'multimedia' => $multimedia
);

print_r(json_encode($return));
 ?>
