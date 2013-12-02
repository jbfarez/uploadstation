// JS function library for Uploader
// --

// FIXME : This is not yet implemented to interface
//         but the concept is to allow notifications
//         to multiple contacts
function addDest(){
	fields = 0;
	var cont = document.getElementById('mailForm');

	if ( fields <= 4 ){
		var div = document.createElement('div');

		var inp = document.createElement('input');
		inp.type = 'text';
		inp.name = 'mail[]';
		inp.size = '40';
		inp.maxlength = '100';
		inp.setAttribute('onChange', 'addDest(this)');

		stringAppend(div, 'E-Mail 2 : ');
		div.appendChild(inp);
		cont.appendChild(div);

		fields += 1;
	}else{
		document.getElementById('mailForm').innerHTML += "<br/>Only 4 upload fields allowed.";
		document.createElement.disabled = true;
	}
}

function stringAppend( o , s ){
	if ( typeof(o.textContent) != 'undefined' ){
		o.textContent += s;
	}else{
		o.firstChild.nodeValue += s;
	}
}
