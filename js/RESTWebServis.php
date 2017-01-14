<?php
require('header.php');

$users=procitajKorisnike();

if(isset($_GET['id'])){
  foreach($users as $user){
    if($user->id == $_GET['id'])
    {
      $moje=$user;
      break;
    }
  }
  header('Content-Type: application/json');
  global $moje;
  echo json_encode($moje, JSON_PRETTY_PRINT);
}
else {
    header('Content-Type: application/json');
      echo json_encode($users, JSON_PRETTY_PRINT);
}

 ?>
