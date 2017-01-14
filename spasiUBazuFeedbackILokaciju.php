<?php
include('header.php');

if (file_exists('feedback.xml')) {
   $db = new PDO("mysql:host=localhost;dbname=wt4", "ena", "ena");
   $kom=simplexml_load_file('feedback.xml');
   $users=simplexml_load_file("users.xml");
   $ukupno=count($users->user);

   for($i = 0; $i < count($kom); $i++){
         $id=$i+1;
         $tekst=$kom->komentar[$i]->tekstKomentar;
         $userIDP=$kom->komentar[$i]->nick;
         $userID=0;
         for($j = 0; $j < $ukupno; $j++){
           $ime=$users->user[$j]->username;

           if(strcmp($userIDP,$ime)==0){
               $userID=$j+1;

                $stmt = $db->prepare("insert into komentar values(?,?,?)");
                $stmt->bindParam(1, $id);
                $stmt->bindParam(2,$tekst);
                $stmt->bindParam(3,$userID);

                $stmt->execute();
              }
        }
        $komentarID=$id;
        $lokacija=$kom->komentar[$i]->lokacija;
        $lok = $db->prepare("insert into lokacija values(?,?,?)");
        $lok->bindParam(1, $id);
        $lok->bindParam(2,$lokacija);
        $lok->bindParam(3,$komentarID);

        $lok->execute();
      }
}
print"
<div class='col-2'>
</div>

<div class='col-8'>

<h1 id ='dobrodoslica'> Spašeni feedback i lokacija u bazu ! </h1>
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
