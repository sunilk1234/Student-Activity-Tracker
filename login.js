function validate()
{
	var username=document.getElementById("username").value;
	var Password=document.getElementById("password").value;

	if((username == "user" && Password == "user1")||(username == "siddu" && Password == "royal"))
	{
		alert("login succesfully");
        window.location.href="home.html"
		return false;
	}
	else{
		alert("login failed");
	}
}