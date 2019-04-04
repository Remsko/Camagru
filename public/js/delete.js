
function deletePicture(event) {
event.preventDefault();
var imageid = event.currentTarget.dataset.imageid;
if (imageid === undefined) {
	return 0;
}
ajaxPost("/gallery/deletePicture", ('imageId=' + imageid), function(response) {
	contener = document.getElementById(imageid);
	contener.parentNode.removeChild(contener);
});	
}