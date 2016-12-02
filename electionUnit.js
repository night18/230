function readJSON(){
	var decode_array = JSON.parse(encode_string);
	return(decode_array);
}

function loadTab(obj,n){
	var layer;
	eval("layer=\'S"+n+"\'");

	var tabsF=document.getElementById('tabsF').getElementsByTagName('li');
	for (var i=0;i<tabsF.length;i++){
	    tabsF[i].setAttribute('id',null);
	    eval("document.getElementById(\'S"+(i+1)+"\').style.display=\'none\'");
	}

	obj.parentNode.setAttribute('id','current');
	document.getElementById(layer).style.display="inline";
}