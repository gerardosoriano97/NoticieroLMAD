<?php
include_once(dirname(__DIR__).'/data/newsCRUD.php');
include_once(dirname(__DIR__).'/data/sectionCRUD.php');

if(isset($_GET['start'])){
  $start = $_GET['start'];
}else {
  $start = 0;
}

if (isset($_GET['idSection'])) {
  $idSection = $_GET['idSection'];

  $news = new News();
  $news->setFKidSection($idSection);
  $news->setStyle('destacada');
  $newsOutstanding = NewsCRUD::getRecentNewsBySection($news,0);
  $news->setStyle('normal');
  $newsNormal = NewsCRUD::getRecentNewsBySection($news,$start);

  $section = new Section();
  $section->setId($idSection);
  $section = SectionCRUD::getSection($section);

  $return = array(
    'outstanding'=> $newsOutstanding,
    'normal'=> $newsNormal,
    'section'=> $section[0]['sectionName']
  );

  print_r(json_encode($return));
}else {
  $news = new News();
  $news->setStyle('destacada');
  $newsOutstanding = NewsCRUD::getRecentNews($news,0);
  $news->setStyle('normal');
  $newsNormal = NewsCRUD::getRecentNews($news,$start);

  $return = array(
    'outstanding' => $newsOutstanding,
    'normal' => $newsNormal,
    'section' => 'homepage'
  );

  print_r(json_encode($return));
}
 ?>
