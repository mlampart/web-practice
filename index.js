function deletePhoto(id){
    if(confirm('Are you sure you want to delete this photo?')){
        window.location.href='index.php?delete_id='+id;
    }
}

var validateForm;
validateForm = function(){
	var x = document.forms["register"]["username"].value;
	if (x == null || x == ""){
		//TODO show error next to text field
		alert("put a username in there yo cmon");
		return false;
	}
	var y = document.forms["register"]["confirm_username"].value;
	if (y == null || y == ""){
		//TODO show error next to text field
		alert("confirm your username yo cmon");
		return false;
	}
	if (y != x){
		//TODO show error next to text field
		alert("usernames don't match yo cmon it's 3 characters how you mess that up");
		return false;
	}
	var z = document.forms["register"]["fullname"].value;
	if (z == null || z == ""){
		//TODO show error next to text field
		alert("put ya name in there yo cmon");
		return false;
	}
	return true;
}
