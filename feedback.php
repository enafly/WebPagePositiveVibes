<?php
include('header.php');

if(isset($_POST ['brisanje'])){
	$db= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
	$db->exec("set names utf8");
	$red= $_POST['red'];
	$sql="delete from komentar where id=".$red." ";
	$query = $db->prepare($sql);
	$query->execute();

	$sql="delete from lokacija where id=".$red." ";
	$query = $db->prepare($sql);
	$query->execute();

}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){

	$kom=procitajFeedback();
	$ukupnok=count($kom);
	$users=procitajKorisnike();
	$ukupno=count($users);

	print"
		<div class= 'row'>
			<div id='glavni' class='col-12'>
				<div class='col-2' >
				</div>

<div class='col-8'>
			<h3 id='tekst'> Feedback</h3>";

			if($ukupnok!=0){
			print "
			<h3 id='tekst'>Ukupno komentara: ".(string)$ukupnok." </h3>";

			print "<h3 id='tekst'> Kliknite dva puta na X za brisanje (ako se predomislite).</h3>
			<h3 id='tekst'> Komentari:</h3>";

			$komentar= "";
			print"		<table id='tabelaFee'>
					<TR>
							<TH>Komentar</TH>
							<TH>Obriši</TH>
					</TR>	";
						foreach ($kom as $k){
							print"
							<TR>
								<form action='feedback.php' method='POST'>
										<TD id='zaKomentar'>".(string)$k->tekst."</TD>
										<TD> <input type='hidden' name='red' value='".$k->id."'><input type='submit' name='brisanje' value='X'></TD>
								</form>
								</TR>";
						}
			}
			print"	</table>
			</div>
				</div>
						<div class='col-2'>
				</div>
		</div>";
}

else if(isset($_SESSION['username']) && $_SESSION['username']==true){
		header("Location: feedbackKor.php");
}

include('footer.php');
?>
