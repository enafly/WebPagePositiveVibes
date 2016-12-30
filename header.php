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
<script type="text/javascript" src="js/adminAkcijeJS.js"></script>
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
						<li><a 	href="feedback.php" >Feedback</a></li>
            <?php
              if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
                  print "<li><a  href='opcijeAdmin.php' > Opcije</a></li>";
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
      if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
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

   ?>

</header>
