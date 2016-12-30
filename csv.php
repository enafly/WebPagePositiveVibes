<?php

$kom=simplexml_load_file('feedback.xml');
 $ukupno=count($kom);

//Komentari
file_put_contents('Izvjestaj.csv',"Komentari koje imate su:\n",FILE_APPEND);

	for($i = 0; $i < count($kom); $i++){
		$name =$kom->komentar[$i]->nick;
		$email =$kom->komentar[$i]->email;
		$komentar=$kom->komentar[$i]->tekstKomentar;
		file_put_contents('Izvjestaj.csv',(string)$name.','.(string)$email.','.(string)$komentar."\n",FILE_APPEND);
	}
//Korisnici
file_put_contents('Izvjestaj.csv',"Korisnici koji su registrovani su: \n",FILE_APPEND);
	$users=simplexml_load_file("users.xml");
	$ukupno=count($users->user);
	for($i = 0; $i < count($users->user); $i++){
		$name = $users->user[$i]->username;
		$email = $users->user[$i]->email;
		$pass= $users->user[$i]->pass;
		file_put_contents('Izvjestaj.csv',(string)$name.','.(string)$email.','.(string)$pass."\n",FILE_APPEND);
	}

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
