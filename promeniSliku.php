<?php
include('header.php');

$podaci = simplexml_load_file("omeni.xml");

$srcSlike = $podaci->cont[0]->slikaLoc;
$tekst = $podaci->cont[0]->tekst;
print"
<div class='col-10'>
      <div id='editi' class='col-10'>
      <table>
      	<TR>
            <TD> <img id='oNama' name='imgs' src='".(string)$srcSlike."' alt='Stay positive!'> </TD>
              <TD>
                  <form action='klikPromenaSlike.php' method='post' enctype='multipart/form-data'>
                    Selektuj sliku:
                      <input type='file' name='fileToUpload' id='fileToUpload' class='btnA'>
                      <input type='submit' value='Spasi sliku' name='submit' class='btnA'>
                  </form>
              </TD>
              <TD>	<h3 id='tekst'>".(string)$tekst."</h3></TD>
        </TR>
      </table>
      </div>
</div>
 <div class='col-2'>
 </div>";


   include('footer.php');
?>
