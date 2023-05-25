function validate()
{
	var username=document.getElementById("username").value;
	var Password=document.getElementById("password").value;
	if(username=="admin"&& Password=="admin1")
	{
		alert("login succesfully");
        window.location.href="dashboard.html"
		return false;
	}
	else{
		alert("login failed");
	}
}