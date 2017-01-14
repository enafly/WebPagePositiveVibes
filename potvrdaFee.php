<?php
include('header.php');

$kom = new SimpleXMLElement("feedback.xml",null,true);
$i=count($kom)-1;
$name =$kom->komentar[$i]->nick;

print"
<div class='col-2'>
</div>

<div class='col-8'>

<h1 id ='dobrodoslica'> Poslan feedback! </h1>
<h2 id ='dobrodoslica'> Hvala ".(string)$name."! </h2>
<h3 id ='dobrodoslica'> Ostavite feedback ponovo! </h3>

</div>

<div class='col-2'>
</div> ";

include('footer.php');
?>
