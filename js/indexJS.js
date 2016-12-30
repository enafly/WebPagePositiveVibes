function prikazi(id){

	var m = document.getElementById(id);
	if(m.style.display== 'inline-block' || m.style.display== ''){
		m.style.display= 'block';
	}
	else {
		m.style.display== 'none';
	}
}
