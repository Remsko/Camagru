//Ajax Query

function ajaxPost(url, data, action) {
	if (window.XMLHttpRequest) {
		ajax = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	ajax.open('POST', url, true);
	ajax.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajax.onload = function () {
		console.log(this.responseText);
		action(this.responseText);
	};
	ajax.send(data);
}