<?php
include('header.php');

$mydata = simplexml_load_file("mydata.xml");
$loginname = $mydata->login_details[0]->login_name;

print"
<div class='col-2'>
</div>

<div class='col-8'>

<h1 id ='dobrodoslica'> Dobrodošla ".(string)$loginname."! </h1>
<h3 id='adminMogucnost'> Imate mogućnost da pogledate i promijenite : </h3>
<a href='adminKorisnici.php' id='link'><input type='button' value='Korisnike' class='btnA'></a>
<a href='feedback.php' id='link'><input type='button' value='Feedback' class='btnA'></a>
<a href='izmjenaOmeni.php' id='link'><input type='button' value='O meni' class='btnA'></a>

<a href='csv.php' id='link'><input type='button' value='Preuzmi izvještaj (.csv)' class='btnA'></a>
<a href='pdf.php' id='link'><input type='button' value='Preuzmi izvještaj (.pdf)' class='btnA'></a>
<a href='spasiUBazuKorisnike.php' id='link'><input type='button' value='Spasi u bazu korisnike' class='btnA'></a>
<a href='spasiUBazuFeedbackILokaciju.php' id='link'><input type='button' value='Spasi u bazu ostalo' class='btnA'></a>

</div>

<div class='col-2'>
</div> ";

	include('footer.php');
?>
