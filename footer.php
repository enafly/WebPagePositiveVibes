<?php

if(isset($_REQUEST['odjavi']) ){
    $_SESSION['logged_in']==false;
    session_unset();
    header("Location:odjava.php");
}
?>
  </body>
<!--<footer>
      <p id="copirajt">Copyright &copy; Ena Fly Muratspahić 2016/2017.</p>
</footer>-->

</html>
