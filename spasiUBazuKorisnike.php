<?php
include('header.php');

if (file_exists('users.xml')) {
    $db = new PDO("mysql:host=localhost;dbname=wt4", "ena", "ena");
    $users=simplexml_load_file("users.xml");
    $ukupno=count($users->user);

    for($i = 0; $i < count($users->user); $i++){
          $id=$i+1;
    			$name = $users->user[$i]->username;
    			$email = $users->user[$i]->email;
    			$pass= $users->user[$i]->pass;

          $stmt = $db->prepare("insert into users values(?,?,?,?)");
          $stmt->bindParam(1, $id);
          $stmt->bindParam(2,$name);
          $stmt->bindParam(3,$email);
          $stmt->bindParam(4,$pass);

          $stmt->execute();
    }
}


print"
<div class='col-2'>
</div>

<div class='col-8'>

<h1 id ='dobrodoslica'> Spašeni korisnici u bazu ! </h1>
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
