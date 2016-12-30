<?php
include('header.php');

if(isset($_POST ['brisanje'])){
		$kom=simplexml_load_file("feedback.xml");
		$red= $_POST['red'];
		// sada je red koji je user po redu, brise ono na tom mjestu i njegovu djecu
 		unset($kom->komentar[intval($red)]);

		file_put_contents("feedback.xml", $kom->saveXML());
}

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){

print"
<div class= 'row'>
		<div id='glavni' class='col-12'>
<div class='col-2' >
</div>

<div class='col-8'>
<h3 id='tekst'> Nije uredu da admin ostavlja feedback na svoju stranicu! </h3>
			<h3 id='tekst'> Feedback</h3>";
		 $kom=simplexml_load_file('feedback.xml');
			$ukupno=count($kom);
			print "
			<h3 id='tekst'>Ukupno komentara: ".(string)$ukupno." </h3>";

			if($ukupno!=0){
			print "<h3 id='tekst'> Komentari:</h3>
			<table id='tabelaFee'>
			<TR>
					<TH>Nick </TH>
					<TH>E-mail </TH>
					<TH>Komentar</TH>
					<TH>Obriši</TH>
			<TR>";

			$name = "";
			$email = "";
			$komentar= "";
//Pokupi podatke iz feedback.xml-a i ispisati za admina koji moze da ih brise!
		for($i = 0; $i < count($kom); $i++){
			$name =$kom->komentar[$i]->nick;
			$email =$kom->komentar[$i]->email;
			$komentar=$kom->komentar[$i]->tekstKomentar;
			print
			"<form action='feedback.php' method='POST'>
				<TR>
					<TD>".(string)$name."</TD>
					<TD>".(string)$email."</TD>
					<TD id='zaKomentar'>".(string)$komentar."</TD>
					<TD> <input type='hidden' name='red' value='".$i."'><input type='submit' name='brisanje' value='X'></TD>
		</TR>
			</form>";
		}
print "</table>
</div>
<div class='col-2'>
</div>
</div>
</div>";

	}
}

else{
	print"<div class= 'row'>
			<div id='glavni' class='col-12'>
	<div class='col-2' >
	</div>

	<div class='col-8'>
			<div id='containerF'>
					<div id=tabboxF>
							<a href='#' id='feedback' class='tab Feedback' >Feedback</a>
						</div>
						<div id='formPanelFeedback'>
							<div id='feedbackbox'>
		 				<form id='FeedbackForma'  action='feedback.php' method='post' onsubmit='return validacijaF()' >
								<input type='text' id='nickF' name='nickF' class='textStil' tabindex='1' placeholder='Ime ili nick (A-Z a-z 0-9)'>
								<p class='obav'>*</p>
								<p id='nickErrF' ></p>
								<input type='text' id='emailF' name='emailF' class='textStil' tabindex='2' placeholder='E-mail'>
								<p class='obav'>*</p>
								<p id='emailErrF' ></p>
								<textarea rows='10' cols='50' name='komentarF' class='textStil2' id='komentarF' tabindex='3' placeholder='Komentar'></textarea>
								<p class='obav'>*</p>
								<p id='komentarErrF' ></p>
								<input type='submit' form='FeedbackForma' name='posaljiFeedback' value='Pošalji feedback' class='btn' tabindex='4'>

								<p id='obavPod'>Polja označena (*) su obavezna!</p>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class='col-2'>
		</div>
		</div>
</div>";
}

if(isset($_REQUEST['posaljiFeedback']))
{
	//snimi feedback u xml feedback.xml
	$komentari = new SimpleXMLElement("feedback.xml",null,true);

	$komentar = $komentari->addChild('komentar');
	$komentar->addChild('nick', proveri($_REQUEST["nickF"]));
	$komentar->addChild('email', proveri($_REQUEST["emailF"]));
	$komentar->addChild('tekstKomentar', proveri($_REQUEST["komentarF"]));

	$komentari->asXML('feedback.xml');

	header("Location: potvrdaFee.php");
}

include('footer.php');
?>
