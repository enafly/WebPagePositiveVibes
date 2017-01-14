<?php

include('header.php');

$mydata = simplexml_load_file("mydata.xml");

$logini = "";
$password = "";
$loginname = "";

$logini = $mydata->login_details[0]->logini;
$password = $mydata->login_details[0]->password;
$loginname = $mydata->login_details[0]->login_name;

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
    //Print za admina
			header("Location: opcijeAdmin.php");
}
else{
	$neLogovan= "
	<div id='containerRL'>

			<div id=tabbox>
				<a href='#' id='signIn' class='tab SignIn'>Prijavi se</a>
			</div>
			<div id='formpanel'>
				<div id='prijaviSebox'>
					<form id='LogInForma'  action='login.php' method ='post' onsubmit='return validacijaP()'>
							<p class='obav' name='err'></p>
							<input type='text' id='userP' name='userP' class='textStil' class='textStil' tabindex='1' placeholder='Korisničko ime'>
							<p class='obav'>*</p>
							<p id='korisnickiErrP' ></p>
							<input type='password' id='passP' name='passP' class='textStil' tabindex='2' placeholder='Šifra'>
							<p class='obav'>*</p>
							<p id='passErrP'></p>
							<div class='cxbCenter'>
								<input type='checkbox' name='zapamti' value='zapamti' tabindex='3'>Zapamti me
							</div>
							<input type='submit' form='LogInForma' value='Prijavi se' class='btn' name='login' tabindex='4'>
							<p id='obavPod'>Polja označena (*) su obavezna!</p>
							<div class='text-center'>
								<a href='registracija.php' tabindex='5' class='zaboravioPas'>Nemate račun? Registruj se!</a>
							</div>
							<div class='text-center'>
								<a href='zaboravljenaSifra.php' tabindex='5' class='zaboravioPas'>Zaboravljena šifra?</a>
							</div>
					</form>
				</div>
			</div>
	</div>";
	print($neLogovan);
}
//login admin
if(isset($_REQUEST['login']) ){
    if(empty($_POST["userP"]) || empty($_POST["passP"]))
    {
        $_SESSION['error']='Popunite polja';
    }
		//admin login
    if(($_REQUEST["userP"] == $logini)){
		 	if(($_REQUEST["passP"] == $password)){
				//Ovo je da je postavljena sesija
				$_SESSION['logged_in'] = true;
        //unset password
        unset($mydata->login_details[0]->password);
				header("Location: opcijeAdmin.php");
			}
			else {
				header("Location: pogresnaSifra.php");
			}
		}
		//user login
		else if(($_REQUEST["userP"] != $logini)){

			$ime=proveri($_REQUEST["userP"]);
			$passProv=md5($_REQUEST["passP"]);
			$name = "";
			$email = "";
			$pass= "";
			//baza upisivanje
			$usersdb=procitajKorisnike();
			foreach ($usersdb as $user) {
				if(strcmp($user->ime,$ime)==0){
						if(strcmp($user->pass,$passProv)==0){
							$_SESSION['username'] =(string)$user->ime;
							header("Location: feedbackKor.php");
						}
						else{
								header("Location: pogresnaSifra.php");
						}
				}
				else{
							//nepostojeciKorisnik
							header("Location: nepostojeciKorisnik.php");
				}
		}
	}
	else{
			session_unset();
			$_SESSION['logged_in'] = false;
			$_SESSION['username'] = false;
			$username="";

			header("Location: nepostojeciKorisnik.php");
		}
}
include('footer.php');

?>
