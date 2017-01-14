<?php

include('header.php');

print"<div class= 'row'>
    <div id='glavni' class='col-12'>
<div class='col-2' >
</div>

<div class='col-8'>
<h1> Welcome ".(string)$_SESSION['username']."!</h1>
    <div id='containerF'>
        <div id=tabboxF>
            <a href='#' id='feedback' class='tab Feedback' >Feedback</a>
          </div>
          <div id='formPanelFeedback'>
            <div id='feedbackbox'>
          <form id='FeedbackForma'  action='feedbackKor.php' method='post' onsubmit='return validacijaF()' >
            <input type='text' id='Lok' name='Lok' class='textStil' tabindex='1' placeholder='Država (A-Z a-z)'>
            <p class='obav'>*</p>
            <p id='LokErr'></p>
              <textarea rows='10' cols='50' name='komentarF' class='textStil2' id='komentarF' tabindex='2' placeholder='Komentar'></textarea>
              <p class='obav'>*</p>
              <p id='komentarErrF' ></p>
              <input type='submit' form='FeedbackForma' name='posaljiFeedback' value='Pošalji feedback' class='btn' tabindex='4'>

              <p id='obavPod'>Polja označena (*) su obavezna!</p>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class='col-2'>
  </div>
  </div>
</div>";


if(isset($_REQUEST['posaljiFeedback']) && isset($_SESSION['username']))
{
  if(empty($_POST["komentarF"]))
  {
    $_POST['komentarErrF']='Popunite polja';
  }
  else{
//snimi feedback u xml feedback.xml
    $komentari = new SimpleXMLElement("feedback.xml",null,true);

    $komentar = $komentari->addChild('komentar');

    $komentar->addChild('nick', proveri($_SESSION["username"]));
    $komentar->addChild('lokacija', proveri($_REQUEST["Lok"]));

    $komentar->addChild('tekstKomentar', proveri($_REQUEST["komentarF"]));

    $komentari->asXML('feedback.xml');

    $nick=proveri($_SESSION["username"]);
    $komentar=proveri($_REQUEST["komentarF"]);
    $lokacija=proveri($_REQUEST["Lok"]);
    //nadji id usera
    $userID=0;
    $users=procitajKorisnike();
    foreach ($users as $user) {
      $ime=$user->ime;
      if(strcmp($nick,$ime)==0)
        $userID= $user->id;
    }

    //u bazuu
    $db = new PDO("mysql:host=localhost;dbname=wt4", "ena", "ena");
    $db->exec("set names utf8");

    $sm=$db->prepare("insert into komentar(tekst,userID) values(?,?)");
    $sm->bindParam(1,$komentar);
    $sm->bindParam(2,$userID);

    $sm->execute();

    $komentari=procitajFeedback();
    $kraj=count($komentari);
    $komentarID= $komentari[$kraj-1]->id;

    //lokacija
    $sm=$db->prepare("insert into lokacija(lokacija,komentarID) values(?,?)");
    $sm->bindParam(1,$lokacija);
    $sm->bindParam(2,$komentarID);

    $sm->execute();

    header("Location: potvrdaFee.php");
  }
}

include('footer.php');
?>
