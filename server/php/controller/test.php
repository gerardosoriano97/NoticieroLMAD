<?php

if(isset($_FILES['avatar'])){
   $errors= array();
   $file_name = $_FILES['avatar']['name'];
   $file_size =$_FILES['avatar']['size'];
   $file_tmp =$_FILES['avatar']['tmp_name'];
   $file_type=$_FILES['avatar']['type'];
   $file_ext=strtolower(end(explode('.',$_FILES['avatar']['name'])));

   $expensions= array("jpeg","jpg","png");

   if(in_array($file_ext,$expensions)=== false){
      $errors[]="extension not allowed, please choose a JPEG or PNG file.";
   }

   if($file_size > 2097152){
      $errors[]='File size must be excately 2 MB';
   }
   print_r($file_name);
 }
 ?>
