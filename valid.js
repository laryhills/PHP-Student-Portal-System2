var password = "MySuper4PassPhrase1";
var pattern = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[a-zA-Z0-9]+$/;
if (pattern.test(password)) {
	alert("valid password")
}else{
	alert("invalid password")
}

