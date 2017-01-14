<?php
$podaci = simplexml_load_file("omeni.xml");

$srcSlike = $podaci->cont[0]->slikaLoc;
$tekst = $podaci->cont[0]->tekst;

$promjena=0;
$target_dir = "img/";
$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File nije slika- ".$check["mime"].".";
        $uploadOk = 1;
    } else {
        echo "File nije slika.";
        $uploadOk = 0;
    }
}
if (file_exists($target_file)) {
    echo "Fajl već postoji.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Žao nam je, fajl je prevelik.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif" ) {
    echo "Dozvoljeni su samo JPG, JPEG, PNG & GIF fajlovi.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Žao nam je, vaš fajl nije snimljen.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Fajl ". basename( $_FILES["fileToUpload"]["name"]). " je snimljen.";
        $promjena=1;

    } else {
        echo "Žao nam je, došlo je do greške prilikom snimanja fajla.";
    }
}
$xml = new SimpleXMLElement("<omeni/>");
$cont= $xml->addChild("cont");
$cont->addChild('slikaLoc',$target_file);
$cont->addChild('tekst',(string)$tekst);
file_put_contents("omeni.xml",$xml->asXML());
header('Location: izmjenaOmeni.php');
?>
