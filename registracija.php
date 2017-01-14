<?php
include('header.php');


if(isset($_REQUEST['registrujSe']) && !empty($_POST['userR']) && !empty($_POST['emailR']) && !empty($_POST['passR'])){
	/* upisi u users.xml */
$dobro=1;
//PROVJERI IMA LI tog usera vec sa usernameom

$users=procitajKorisnike();
$ukupno=count($users);

		foreach($users as $user){
			$name = $user->ime;
			if($_REQUEST["userR"]==$name){
					// Postoji user
					print "
					<div class='col-2'>
					</div>

					<div class='col-8'>
					<div id='containerRL'>
						<div id=tabbox>
							<a href='#' id='signUp' class='tab SignUp'>Registruj se</a>
						</div>
						<div id='formpanel'>
							<div id='registrujSebox'>
								<form id='RegistracijaForma'  action='registracija.php' method ='post' onsubmit='return validacijaR()'>
										<input type='text' id='userR' name='userR' class='textStil' tabindex='1' placeholder='Korisničko ime (A-Z a-z 0-9)'>
										<p class='obav'>*</p>
										<p id='korisnickiErr' > Postoji user, odaberi drugi nick</p>
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
					</div>
					</div>

					<div class='col-2'>
					</div>";
					$dobro=0;
					break;
			}

		}

		if($dobro==1)
		{
				//Dodaj usera u xml
					$users = new SimpleXMLElement("users.xml",null,true);

					$user = $users->addChild('user');
					$user->addChild('username',proveri($_REQUEST["userR"]));
					$user->addChild('email', proveri($_REQUEST["emailR"]));
					$user->addChild('pass',md5(proveri($_REQUEST["passR"])));

					$users->asXML('users.xml');

					$name=proveri($_REQUEST["userR"]);
				//dodaj usera u bazu :D

					$ime=proveri($_REQUEST["userR"]);
					$email=proveri($_REQUEST["emailR"]);
					$pass=md5(proveri($_REQUEST["passR"]));

					$db = new PDO("mysql:host=localhost;dbname=wt4", "ena", "ena");
					$db->exec("set names utf8");

					$sm=$db->prepare("insert into users(ime,email,pass) values(?,?,?)");
					$sm->bindParam(1,$name);
					$sm->bindParam(2,$email);
					$sm->bindParam(3,$pass);

          $sm->execute();

					print"
					<div class='col-2'>
					</div>

					<div class='col-8'>

					<h1 id ='dobrodoslica'> Uspješna registracija </h1>
					<h2 id ='dobrodoslica'> Hvala ".(string)$name."! </h2>

					</div>

					<div class='col-2'>
					</div> ";

				}
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
