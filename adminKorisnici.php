<?php
include('header.php');

//Brise na klik
if(isset($_POST ['brisanje'])){
//brisanje korisnika
		$db= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
		$db->exec("set names utf8");
		$red= $_POST['red'];
		$sql="delete from users where id=".$red." ";
		$query = $db->prepare($sql);
		$query->execute();
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
//iz baze citanje
	$users=procitajKorisnike();
	$ukupno=count($users);

	if($ukupno!=0){
		print"<div class= 'row'>
		<div id='glavni' class='col-12'>
			<div class='col-2' >
			</div>
			<div class='col-8'>
				<h2 id='tekst'> Korisnici</h3>";

			print "	<h3 id='tekst'>Ukupno registrovanih korisnika: ".(string)$ukupno."</h3>";


						print "<h3 id='tekst'> Komentari:</h3>
						<table id='tabelaKor'>
						<TR>
								<TH>Nick </TH>
								<TH>E-mail </TH>
								<TH>Heširana šifra</TH>
								<TH>Obriši</TH>
						<TR>";

					$name = "";
					$email = "";
					$pass= "";

			//Pokupi podatke iz feedback.xml-a i ispisati za admina koji moze da ih brise!
					foreach($users as $user){
						$name = $user->ime;
						$email= $user->email;
						$pass= $user->email;
						$i= $user->id;
						print
						"<form action='adminKorisnici.php' method='POST'>
							<TR>
								<TD>".(string)$name."</TD>
								<TD>".(string)$email."</TD>
								<TD>".(string)$pass."</TD>
								<TD><input type='hidden' name='red' value='".$i."'> <input type='submit' name='brisanje' value='X'></TD>
							</TR>
						</form>";
					}
					print"</table>
					</div>
					<div class='col-2' >
					</div>
					</div>
			</div>
					";
			}
	else{
		print"
				<div class= 'row'>
						<div id='glavni' class='col-12'>
				<div class='col-2' >
				</div>

				<div class='col-8'>
							<h2 id='tekst'> Korisnici</h3>
							<h3 id='tekst'>Nema registrovanih korisnika.</h3>
							</div>
					</div>";
	}

}

include('footer.php');
?>
