<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
<title>PositiveVibes</title>

<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/indexStil.css">
<script type="text/javascript" src="js/indexJS.js"></script>
<script type="text/javascript" src="js/carouselJS.js"></script>
<script type="text/javascript" src="js/ajaxJS.js"></script>
<script type="text/javascript" src="js/fullscreenJS.js"></script>
<link rel="stylesheet" href="css/errori.css">
<script type="text/javascript" src="js/validacijeJS.js"></script>

</head>

<body>
	<header>
		<div id="row-1" class="col-12">
			<div id="logo" class="col-3">
				<a href="index.php"><img class="logo" src="img/logo.png" alt="PositiveVibes" ></a>
			</div>
			<div id=menu-wraper>
				<span id="menu-trigger" onclick="prikazi('menu');">|||</span>
				<div id="menu" class="col-9">
					<ul id=nav>
						<li><a  href="oNama.php" >O nama</a></li>
						<li><a  href="popularno.php" >Popularno</a></li>
            <?php
              if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                  print "<li><a  href='opcijeAdmin.php' > Opcije</a></li>";
              }
              else if (isset($_SESSION['username'])){
                  print"<li><a 	href='feedback.php' >Feedback</a></li>";
              }
              else{
                  print "<li><a  href='login.php' > Prijava/Registracija</a></li>";
              }
            ?>
            <li><a 	href="search.php" >Search</a></li>
					</ul>
				</div>
			</div>
      <?php
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true || isset($_SESSION['username'])){
          //Print za admina
          print"
            <form id='dioOdjava' action='login.php' method ='post'>
              <input type='submit' class='btnO' form='dioOdjava' name='odjavi' value='Odjavi se'>
            </form>";
      }
      ?>
		</div>

  <?php
  function proveri($data)
  {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
  }

  function procitajKorisnike()
  {
    $veza= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
    $veza->exec("set names utf8");
    $rezultat=$veza->query("select id, ime, email, pass from users");
    if(!$rezultat){
      $greska=$veza->errorInfo();
      print"<h1> SQL greska: "-$greska[2]."</h1>";
      exit();
    }
    $users=[];
    foreach ($rezultat as $korisnik) {
      $user = new stdClass;
      $user->id=$korisnik['id'];
      $user->ime=$korisnik['ime'];
      $user->email=$korisnik['email'];
      $user->pass=$korisnik['pass'];

      array_push($users, $user);

    }
    return $users;
}
function procitajFeedback()
{
  $veza= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
  $veza->exec("set names utf8");
  $rezultat=$veza->query("select id, tekst, userID from komentar");
  if(!$rezultat){
    $greska=$veza->errorInfo();
    print"<h1> SQL greska: "-$greska[2]."</h1>";
    exit();
  }
  $komentari=[];
  foreach ($rezultat as $kom) {
    $komi= new stdClass;
    $komi->id=$kom['id'];
    $komi->tekst=$kom['tekst'];
    $komi->userID=$kom['userID'];

    array_push($komentari, $komi);

  }
  return $komentari;
}

function odTogUseraKom($i){
  $veza= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
  $veza->exec("set names utf8");
  $rezultat=$veza->query("select u.id, k.tekst, k.userID from users u, komentar k where k.userID=".$i." ");
  $komentari=[];
  foreach ($rezultat as $kom) {
    $komi= new stdClass;
    $komi->id=$kom['id'];
    $komi->tekst=$kom['tekst'];
    $komi->userID=$kom['userID'];

    array_push($komentari, $komi);
  }
  return $komentari;
}


   ?>

</header>
