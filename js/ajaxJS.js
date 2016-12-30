function promijeni(stranica){
  var ajax= new XMLHttpRequest();
    ajax.onreadystatechange= function(){

      if(ajax.readyState ==4 && ajax.status==200){
        document.getElementById('glavni').innerHTML=ajax.responseText;
      }
      if(ajax.readyState !=4 && ajax.status==404){
        document.getElementById('glavni').innerHTML="404 stranica nije pronađena..";
      }
    };
    ajax.open("GET",stranica, true);
    ajax.send();
}
function promijeniL(stranica,i ){
  var ajax= new XMLHttpRequest();
    ajax.onreadystatechange= function(){

      if(ajax.readyState ==4 && ajax.status==200 ){
        if(i==0){
          //greska
        }
        else{
          document.getElementById('glavni').innerHTML=ajax.responseText;

        }
        document.getElementById('glavni').innerHTML=ajax.responseText;
      }
      if(ajax.readyState !=4 && ajax.status==404){
        document.getElementById('glavni').innerHTML="404 stranica nije pronađena..";
      }
    };
    ajax.open("GET",stranica, true);
    ajax.send();


}
