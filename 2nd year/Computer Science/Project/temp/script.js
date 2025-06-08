	function submitForm() {
            var x=document.myform.username.value;
            if(x == ""){
		alert("Please enter your username !");
		document.myform.name.focus();
		return false;
	}
            var p=document.myform.userid.value;
            if(p == ""){
		alert("Please enter your User Id !");
		document.myform.name.focus();
		return false;
	}
	var y=document.myform.email.value;
	if(y ==""){
		alert("Please enter your  email adress!");
		document.myform.email.focus();
		return false;
	}
	var z = document.myform.email.value.lenght;
	 if(z<10){
		("Please enter your correct email adress!");
		document.myform.email.focus();
		return false;
	}
	else{
	alert("your message is successfully submitted Thank you .");}
	
return(true);
}