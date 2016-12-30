<?php
require('pdf/fpdf.php');

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
$kom=simplexml_load_file('feedback.xml');
$ukupno=count($kom);

$pdf->Cell(0,10,'',0,1);

$pdf->SetFont('Times','B',13);
$pdf->Cell(0,10,'Komentari koje imate su:',0,1);

$pdf->SetFont('Times','',12);
for($i = 0; $i < count($kom); $i++){
   $name =$kom->komentar[$i]->nick;
   $email =$kom->komentar[$i]->email;
   $komentar=$kom->komentar[$i]->tekstKomentar;
   $n=$i+1;
   $red=''.$n.': '.(string)$name.', '.(string)$email.', '.(string)$komentar.'';
   $pdf->Cell(0,10,$red,0,1);
}
$pdf->Cell(0,10,'',0,1);
$users=simplexml_load_file('users.xml');
$ukupno=count($users->user);

$pdf->SetFont('Times','B',13);
$pdf->Cell(0,10,'Korisnici koji su registrovani su:',0,1);

$pdf->SetFont('Times','',12);
for($i = 0; $i < count($users->user); $i++){
    $name = $users->user[$i]->username;
    $email = $users->user[$i]->email;
    $pass= $users->user[$i]->pass;
    $n=$i+1;
    $red=''.$n.': '.(string)$name.', '.(string)$email.', '.(string)$pass.'';
    $pdf->Cell(0,10,$red,0,1);
}
$pdf->Output('izvjestaj.pdf','D');
header("Content-Disposition: attachment; filename='izvjestaj.pdf'");
header("Content-Length: " . filesize(izvjestaj.pdf));
header("Content-Type: application/octet-stream;");

?>
