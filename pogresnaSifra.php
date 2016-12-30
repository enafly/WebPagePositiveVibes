<?php
include('header.php');

print	"
 <div id='containerRL'>

     <div id=tabbox>
       <a href='#' id='signIn' class='tab SignIn'>Prijavi se</a>
     </div>
     <div id='formpanel'>
       <div id='prijaviSebox'>
         <form id='LogInForma'  action='login.php' method ='post' onsubmit='return validacijaP()'>
             <p class='obav'>Netačna šifra!</p>
             <input type='text' id='userP' name='userP' class='textStil' tabindex='1' placeholder='Korisničko ime'>
             <p class='obav'>*</p>
             <p id='korisnickiErrP' ></p>
             <input type='password' id='passP' name='passP' class='textStil' tabindex='2' placeholder='Šifra'>
             <p class='obav'>*</p>
             <p id='passErrP'></p>
             <div class='cxbCenter'>
               <input type='checkbox' name='zapamti' value='zapamti' tabindex='3'>Zapamti me
             </div>
             <input type='submit' form='LogInForma' value='Prijavi se' class='btn' name='login' tabindex='4'>
             <p id='obavPod'>Polja označena (*) su obavezna!</p>
             <div class='text-center'>
               <a href='registracija.php' tabindex='5' class='zaboravioPas'>Nemate račun? Registruj se!</a>
             </div>
             <div class='text-center'>
               <a href='zaboravljenaSifra.php' tabindex='5' class='zaboravioPas'>Zaboravljena šifra?</a>
             </div>
         </form>
       </div>
     </div>
 </div>";

 include('footer.php');
 ?>
