function reloadComments(imageId) {
    ajaxPost("/gallery/reloadcomments", ('imageId=' + imageId), function(response) {
        document.querySelector('[class="all_comments"][id="' + imageId + '"]').innerHTML = response;
	})
}

function comment() {
    event.preventDefault();
	let imageId = event.currentTarget.dataset.imageid;
	if (imageId === undefined) {
		return ;
    }
    let input = document.querySelector('[class="input_comment"][data-imageid="' + imageId + '"]');
    if (input === undefined)
        return ;
    let comment = input.value;
	ajaxPost("/gallery/comment", ('imageId=' + imageId + '&comment=' + comment), function(response) {
        document.querySelector('[class="new_comment"][id="' + imageId + '"]').innerHTML = response;
        reloadComments(imageId);
	})
}

function onEnter(event, action) {
    if (event.keyCode === 13)
        action(event);
}