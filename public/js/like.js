function like(event) {
	event.preventDefault();
	let imageid = event.currentTarget.dataset.imageid;
	if (imageid === undefined) {
		return ;
	}
	ajaxPost("/gallery/like", ('imageId=' + imageid), function(response) {
		document.querySelector('[class="like"][id="' + imageid + '"]').innerHTML = response;
	})	
}

function dislike(event) {
	event.preventDefault();
	let imageid = event.currentTarget.dataset.imageid;
	if (imageid === undefined) {
		return ;
	}
	ajaxPost("/gallery/dislike", ('imageId=' + imageid), function(response) {
		document.querySelector('[class="like"][id="' + imageid + '"]').innerHTML = response;
	})
}