<?php
include('header.php');

$podaci = simplexml_load_file("omeni.xml");

$srcSlike = $podaci->cont[0]->slikaLoc;
$tekst = $podaci->cont[0]->tekst;

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true){
		//Print za admina
			header('Location: izmjenaOmeni.php');
}
else {
			print"
				<div class='row'>
					<div id='glavni' class='col-12'>
						<div class='col-2'>
						</div>

						<div class='col-8'>
							<table id='tabelaKor'>
								<TR>
									<TD><img id='oNama' src='".(string)$srcSlike."'  alt='Stay positive!'> </TD>
									<TD><h3 id='tekst'>".(string)$tekst."</h3> </TD>
								</TR>
							</table>
						</div>

						<div class='col-2'>
						</div>

						</div>
						</div>";
}
include('footer.php');
?>
