<?php
include('header.php');

if(isset($_REQUEST['registrujSe']) && !empty($_POST['userR']) && !empty($_POST['emailR']) && !empty($_POST['passR'])){
	/* upisi u users.xml */


	$users = new SimpleXMLElement("users.xml",null,true);

	$user = $users->addChild('user');
	$user->addChild('username',proveri($_REQUEST["userR"]));
	$user->addChild('email', proveri($_REQUEST["emailR"]));
	$user->addChild('pass',md5(proveri($_REQUEST["passR"])));


	$users->asXML('users.xml');

	$name=proveri($_REQUEST["userR"]);
	print"
	<div class='col-2'>
	</div>

	<div class='col-8'>

	<h1 id ='dobrodoslica'> Uspješna registracija </h1>
	<h2 id ='dobrodoslica'> Hvala ".(string)$name."! </h2>

	</div>

	<div class='col-2'>
	</div> ";


/*
	<div id='containerRL'>
		<div id=tabbox>
			<h1 href='#' id='signUp' class='tab SignUp' id ='dobrodoslica'>Uspješna registracija</h1>
		</div>
		<div id='formpanel'>
			<div id='registrujSebox'>

				</div>
			</div>
	</div>
	";*/

}
else{
print "
<div id='containerRL'>
	<div id=tabbox>
		<a href='#' id='signUp' class='tab SignUp'>Registruj se</a>
	</div>
	<div id='formpanel'>
		<div id='registrujSebox'>
			<form id='RegistracijaForma'  action='registracija.php' method ='post' onsubmit='return validacijaR()'>
					<input type='text' id='userR' name='userR' class='textStil' tabindex='1' placeholder='Korisničko ime (A-Z a-z 0-9)'>
					<p class='obav'>*</p>
					<p id='korisnickiErr' ></p>
					<input type='text' id='emailR' name='emailR' class='textStil' tabindex='2' placeholder='E-mail'>
					<p class='obav'>*</p>
					<p id='emailErr' ></p>
					<input type='password' id='passR' name='passR' class='textStil' tabindex='3' placeholder='Šifra (min8 max20)'>
					<p class='obav'>*</p>
					<p id='passErr' ></p>
					<input type='password' id='passPR'  name='passPR' class='textStil' tabindex='4' placeholder='Potvrdi šifru'>
					<p class='obav'>*</p>
					<p id='ppassErr' ></p>
					<input type='submit' form='RegistracijaForma' name='registrujSe' value='Registruj se' class='btn' tabindex='5'>
					<p id='obavPod'>Polja označena (*) su obavezna!</p>
				</form>
			</div>
		</div>
</div>";
}



		include('footer.php');
?>
