<?php
include('header.php');

//dodati da se kupi slika i tekst iz omeni.xml
$podaci = simplexml_load_file("omeni.xml");

$srcSlike = $podaci->cont[0]->slikaLoc;
$tekst = $podaci->cont[0]->tekst;
print"
<div class='col-10'>
      <div id='editi' class='col-10'>
      <table>
      	<TR>
          <form id='OmeniForma'  action='promenaOmeni.php' method='post' >
          <TD> <img id='oNama' name='imgs' src='".(string)$srcSlike."' alt='Stay positive!'> </TD>
            <!--</div>-->
              <TD><textarea rows='25' cols='50' name='postOM' class='textstil' id='postOM' tabindex='2' placeholder='Napiši post...'>".(string)$tekst."</textarea> </TD>
             <TD>  <input type='submit' form='OmeniForma' name='spasiTekst' value='Spasi promijene' class='btnA' tabindex='3'> </TD>
          </form>
        </TR>
      </table>
      </div>
</div>
 <div class='col-2'>
 </div>";
 if(isset($_REQUEST["spasiTekst"])){

   $xml = new SimpleXMLElement("<omeni/>");
   $cont= $xml->addChild("cont");
   $cont->addChild('slikaLoc',$srcSlike);
   $cont->addChild('tekst', proveri($_REQUEST["postOM"]));
   file_put_contents("omeni.xml",$xml->asXML());
   header('Location: izmjenaOmeni.php');
 }

include('footer.php');
?>
