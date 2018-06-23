/*@desc validations for registration form
  @author susmitha
  @date June 21/18
  */
function submitForm()
{


      var userName = document.getElementById("username").value;
     
      $ok = true;

    if ( userName == "") 
    {
        document.getElementById('nameErr').innerHTML = "*username  can't be empty";
        $ok = false;
    }

    else
    {
        document.getElementById('nameErr').innerHTML  = null;     

    }



   
	var mailRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	var email = document.getElementById('Email').value;
	 if (email.match(mailRegex))
	{
	 	document.getElementById('emailErr').innerHTML="";
	 	
	}
	else if(email=="")
	{
		document.getElementById('emailErr').innerHTML = " *enter this field";
         $ok = false;
	}
	else if(!email.match(mailRegex))
	{
		document.getElementById('emailErr').innerHTML = "enter valid email";
         $ok = false;

	}
	

	// phone number validation

	var phoneRegex = /^\d{10,15}$/;
	var phone = document.getElementById('tel').value;
    if (phone.match(phoneRegex)) 
    {
    	document.getElementById('telErr').innerHTML = "";
    	
    }
    else if(phone=="")
    {
    	document.getElementById('telErr').innerHTML = "*please fill this field";
         $ok = false;
    }
    else if(!phone.match(phoneRegex))
    {
     	document.getElementById('telErr').innerHTML = "enter valid number only";
         $ok = false;
     	
    }



    var pwdRegex = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/;
    var pwd = document.getElementById('pwd2').value;
     console.log(pwd);
    if (pwd.match(pwdRegex)) 
    {
        document.getElementById('pasErr').innerHTML = "";
        
    }
    else if(pwd=="")
    {
        document.getElementById('pasErr').innerHTML = "*please fill this field";
         $ok = false;
    }
    else if(!pwd.match(pwdRegex))
    {
        document.getElementById('pasErr').innerHTML = "password should be atleast one special char,one capital letter and one number";
         $ok = false;
        
    }
    

if($ok == false){
    return false;
}
else
{
    return true;
}
}
	