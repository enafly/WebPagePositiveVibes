<?php
require('pdf/fpdf.php');
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

class PDF extends FPDF
{
  // Page header
  function Header()
  {
      // Logo
      $this->Image('img/logo.png',10,6,30);
      // Arial bold 15
      $this->SetFont('Times','B',15);
      // Background color
      $this->SetFillColor(200,220,255);
      // Move to the right
      $this->Cell(80);
      // Title
      $this->Cell(30,10,'Izvjestaj',1,0,'C');
      // Line break
      $this->Ln(20);
  }

  // Page footer
  function Footer()
  {
      // Position at 1.5 cm from bottom
      $this->SetY(-15);
      // Arial italic 8
      $this->SetFont('Times','I',10);
      // Page number
      $this->Cell(0,10,'Stranica '.$this->PageNo().'/{nb}',0,0,'C');
  }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
///POdaci
//$kom=simplexml_load_file('feedback.xml');
//$ukupno=count($kom);

$pdf->Cell(0,10,'',0,1);

$pdf->SetFont('Times','B',13);
$pdf->Cell(0,10,'Komentari koje imate su:',0,1);

$pdf->SetFont('Times','',12);

$i=0;
// feedback baza
$fee=procitajFeedback();
foreach ($fee as $k) {
  $i=$i+1;
  $komentar =$k->tekst;
  $red=''.$i.': '.(string)$komentar.'';
  $pdf->Cell(0,10,$red,0,1);
}

/*//xml
for($i = 0; $i < count($kom); $i++){
   $name =$kom->komentar[$i]->nick;
   $email =$kom->komentar[$i]->email;
   $komentar=$kom->komentar[$i]->tekstKomentar;
   $n=$i+1;
   $red=''.$n.': '.(string)$name.', '.(string)$email.', '.(string)$komentar.'';
   $pdf->Cell(0,10,$red,0,1);
}*/
$pdf->Cell(0,10,'',0,1);
//users load xml
//$users=simplexml_load_file('users.xml');
//$ukupno=count($users->user);

$pdf->SetFont('Times','B',13);
$pdf->Cell(0,10,'Korisnici koji su registrovani su:',0,1);

$pdf->SetFont('Times','',12);
//users db
$i=0;
$users=procitajKorisnike();
foreach ($users as $user) {
  $i=$i+1;
  $name = $user->ime;
  $email = $user->email;
  $pass= $user->pass;
  $red=''.$i.': '.(string)$name.', '.(string)$email.', '.(string)$pass.'';
  $pdf->Cell(0,10,$red,0,1);
}
/*//users xml
for($i = 0; $i < count($users->user); $i++){
    $name = $users->user[$i]->username;
    $email = $users->user[$i]->email;
    $pass= $users->user[$i]->pass;
    $n=$i+1;

    $red=''.$n.': '.(string)$name.', '.(string)$email.', '.(string)$pass.'';
    $pdf->Cell(0,10,$red,0,1);
}*/
$pdf->Output('izvjestaj.pdf','D');
header("Content-Disposition: attachment; filename='izvjestaj.pdf'");
header("Content-Length: " . filesize(izvjestaj.pdf));
header("Content-Type: application/octet-stream;");

?>
