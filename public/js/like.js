function like(event) {
	event.preventDefault();
	var imageid = event.currentTarget.dataset.imageid;
	if (imageid === undefined) {
		return ;
	}
	request("/gallery/like", ('imageId=' + imageid), function(response) {
		document.getElementById(imageid).innerHTML = response;
	})	
}

function dislike(event) {
	event.preventDefault();
	var imageid = event.currentTarget.dataset.imageid;
	if (imageid === undefined) {
		return ;
	}
	request("/gallery/dislike", ('imageId=' + imageid), function(response) {
		document.getElementById(imageid).innerHTML = response;
	})	
}