<?php

function procitajKorisnike()
{
  $veza= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
  $veza->exec("set names utf8");
  $rezultat=$veza->query("select id, ime, email, pass from users");
  if(!$rezultat){
    $greska=$veza->errorInfo();
    print"<h1> SQL greska: "-$greska[2]."</h1>";
    exit();
  }
  $users=[];
  foreach ($rezultat as $korisnik) {
    $user = new stdClass;
    $user->id=$korisnik['id'];
    $user->ime=$korisnik['ime'];
    $user->email=$korisnik['email'];
    $user->pass=$korisnik['pass'];

    array_push($users, $user);

  }
  return $users;
}
function procitajFeedback()
{
$veza= new PDO("mysql:dbname=wt4;host=localhost;charset=utf8","ena","ena");
$veza->exec("set names utf8");
$rezultat=$veza->query("select id, tekst, userID from komentar");
if(!$rezultat){
  $greska=$veza->errorInfo();
  print"<h1> SQL greska: "-$greska[2]."</h1>";
  exit();
}
$komentari=[];
foreach ($rezultat as $kom) {
  $komi= new stdClass;
  $komi->id=$kom['id'];
  $komi->tekst=$kom['tekst'];
  $komi->userID=$kom['userID'];

  array_push($komentari, $komi);

}
return $komentari;
}

$kom=simplexml_load_file('feedback.xml');
 $ukupno=count($kom);

//Komentari
file_put_contents('Izvjestaj.csv',"Komentari koje imate su:\n",FILE_APPEND);

  $i=0;
  //komentare stavi
  $fee=procitajFeedback();
  foreach ($fee as $k) {
    $i=$i+1;
    $komentar =$k->tekst;
    file_put_contents('Izvjestaj.csv',(string)$i.','.(string)$komentar."\n",FILE_APPEND);

  }
  //usere stavi
  file_put_contents('Izvjestaj.csv',"Korisnici koji su registrovani su: \n",FILE_APPEND);

  $users=procitajKorisnike();
  foreach ($users as $user) {
    $i=$i+1;
    $name = $user->ime;
		$email = $user->email;
		$pass= $user->pass;
		file_put_contents('Izvjestaj.csv',(string)$i.','.(string)$name.','.(string)$email.','.(string)$pass."\n",FILE_APPEND);

  }

  /*xml kupi feedback
	for($i = 0; $i < count($kom); $i++){
		$name =$kom->komentar[$i]->nick;
		$email =$kom->komentar[$i]->email;
		$komentar=$kom->komentar[$i]->tekstKomentar;
		file_put_contents('Izvjestaj.csv',(string)$name.','.(string)$email.','.(string)$komentar."\n",FILE_APPEND);
	}*/
//Korisnici
/*
file_put_contents('Izvjestaj.csv',"Korisnici koji su registrovani su: \n",FILE_APPEND);
	$users=simplexml_load_file("users.xml");
	$ukupno=count($users->user);
	for($i = 0; $i < count($users->user); $i++){
		$name = $users->user[$i]->username;
		$email = $users->user[$i]->email;
		$pass= $users->user[$i]->pass;
		file_put_contents('Izvjestaj.csv',(string)$name.','.(string)$email.','.(string)$pass."\n",FILE_APPEND);
	}*/

	$file = "Izvjestaj.csv";
	// Quick check to verify that the file exists
	if( !file_exists($file) ) die("File not found");
	// Force the download
	header("Content-Disposition: attachment; filename=".basename($file)." ");
	header("Content-Length: " . filesize($file));
	header("Content-Type: application/octet-stream;");
	readfile($file);

	unlink($file);

 ?>
