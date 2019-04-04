//Ajax Query

function request(url, data, success) {
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax.open('POST', url, true);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.onload = function () {
		console.log('Ajax request to ' + url + ' returned successfully.');
		if (ajax.responseText === 'ERROR') {
			console.log('An error occured.');
		}
		else {
			success(this.responseText);
		}
	};
	ajax.send(data);
}
