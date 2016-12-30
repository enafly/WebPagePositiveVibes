<?php
include('header.php');

print"
<div class='col-2'>
</div>

<div class='col-8'>

<h1 id ='dobrodoslica'> Dobrodošla ! </h1>
<h3 id='adminMogucnost'> Imate mogućnost da pogledate i izmijenite : </h3>
<a href='adminKorisnici.php' id='link'><input type='button' value='Korisnike' class='btnA'></a>
<a href='feedback.php' id='link'><input type='button' value='Feedback' class='btnA'></a>
<a href='izmjenaOmeni.php' id='link'><input type='button' value='O meni' class='btnA'></a>
</div>

<div class='col-2'>
</div> ";


?>

<?php
	include('footer.php');
?>
