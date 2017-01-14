<?php
include('header.php');
?>
			<div id="containerRL">
				<div id=tabbox>
					<a href="#" id="vrati" class="tab vrati">Vrati račun</a>
				</div>
				<div id="formpanel">
					<div id="Vratibox">
						<form id="VratiForma"  action="register.php" method ="post" onsubmit="return validacijaV()" method="post">
							<input type="text" id="useremail" name="useremail" class="textStil1" tabindex="1" placeholder="E-mail">
							<p id="emailErrV" ></p>
							<input type="submit" form="VratiForma" value="Pošalji" class="btn1" tabindex="2">
						</form>
					</div>
				</div>
			</div>

<?php
include('footer.php');
?>
