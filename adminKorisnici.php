<?php
include('header.php');

//Brise na klik
if(isset($_POST ['brisanje'])){
		$users=simplexml_load_file("users.xml");
		$red= $_POST['red'];
		// sada je red koji je user po redu, brise ono na tom mjestu i njegovu djecu
 		unset($users->user[intval($red)]);

		file_put_contents("users.xml", $users->saveXML());

}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){

	if (file_exists('users.xml')) {

		//$zaSnimiti = "</users>";
		//file_put_contents('users.xml',$zaSnimiti, FILE_APPEND);
		print"<div class= 'row'>
		<div id='glavni' class='col-12'>
			<div class='col-2' >
			</div>
			<div class='col-8'>
				<h2 id='tekst'> Korisnici</h3>";

			$users=simplexml_load_file("users.xml");
			$ukupno=count($users->user);
			print "	<h3 id='tekst'>Ukupno registrovanih korisnika: ".(string)$ukupno."</h3>";

			if($ukupno!=0){
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
		for($i = 0; $i < count($users->user); $i++){
			$name = $users->user[$i]->username;
			$email = $users->user[$i]->email;
			$pass= $users->user[$i]->pass;
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
}

include('footer.php');
?>
