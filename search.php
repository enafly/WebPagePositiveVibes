<?php
include('header.php');

?>
<script>
function showResult(str) {
  if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    xmlhttp=new XMLHttpRequest();
  } else {
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
</script>

<div id='containerRL'>
<div id='formpanel'>
    <div id='prijaviSebox'>
      <h2 id='pretraga'> Pretražite stranicu i malo šire ;)</h2>
      <form>
        <input type="text" size="30" class="textStil" onkeyup="showResult(this.value)">
        <div id="livesearch"></div>
      </form>
    </div>

</div>
</div>

<?php
	include('footer.php');
?>
