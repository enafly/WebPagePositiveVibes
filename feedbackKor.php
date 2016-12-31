<?php
include('header.php');

print"<div class= 'row'>
    <div id='glavni' class='col-12'>
<div class='col-2' >
</div>

<div class='col-8'>
<h1> Welcome </h1>
    <div id='containerF'>
        <div id=tabboxF>
            <a href='#' id='feedback' class='tab Feedback' >Feedback</a>
          </div>
          <div id='formPanelFeedback'>
            <div id='feedbackbox'>
          <form id='FeedbackForma'  action='feedbackKor.php' method='post' onsubmit='return validacijaF()' >
              <input type='text' id='nickF' name='nickF' class='textStil' tabindex='1' placeholder='Ime ili nick (A-Z a-z 0-9)'>
              <p class='obav'>*</p>
              <p id='nickErrF' ></p>
              <textarea rows='10' cols='50' name='komentarF' class='textStil2' id='komentarF' tabindex='3' placeholder='Komentar'></textarea>
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
//snimi feedback u xml feedback.xml
  $komentari = new SimpleXMLElement("feedback.xml",null,true);
  $users=simplexml_load_file("users.xml");

  $komentar = $komentari->addChild('komentar');

  $komentar->addChild('nick', proveri($_REQUEST["nickF"]));

  for($i = 0; $i < count($users->user); $i++){
    $name = $users->user[$i]->username;
    if($_SESSION['username']==$name){
          $email = $users->user[$i]->email;
          $komentar->addChild('email',$email );
    }
  }
  $komentar->addChild('tekstKomentar', proveri($_REQUEST["komentarF"]));

  $komentari->asXML('feedback.xml');

  header("Location: potvrdaFee.php");
}

include('footer.php');
?>
