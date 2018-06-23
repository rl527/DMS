/*@desc validations for password changing
  @author susmitha
  @date June 21/18*/

function validateForm()
{
    $ok = true;

    if(document.myForm.currentPwd.value=="") 
    { 
    document.getElementById('currentPwdError').innerHTML = "* Enter your current password";
    $ok = false;
     
    } 
    else
    {
        document.getElementById('currentPwdError').innerHTML="";
    } 



   
    if(document.myForm.confirmPwd.value=="") 
    { 
    document.getElementById('confirmPwdError').innerHTML = "*Confirm your password";
    $ok = false;

     
    } 
    else
    {
        document.getElementById('confirmPwdError').innerHTML="";
    } 


    var regex = /^(?=.*\d)(?=.*[a-zA-Z]).{6,10}$/;
    var z = document.getElementById('nPwd').value;
    if (z.match(regex)) 
    {
        document.getElementById('newPwdError').innerHTML = "";

        
    }
    else if(z=="")
    {
        document.getElementById('newPwdError').innerHTML = "*Enter your new password";
         $ok = false;
    }
    else if(!z.match(regex))
    {
        document.getElementById('newPwdError').innerHTML = "enter alphanumeric";
         $ok = false;
        
    }

console.log($ok);
   return $ok;

}

 function validatePwd()
 {
    var pwd = document.getElementById('nPwd').value;
    var pwd_rep = document.getElementById('cPwd').value;
    if(pwd === pwd_rep){     
     document.getElementById('passerror').innerHTML = "password matched";
}
else
{   
 document.getElementById('passerror').innerHTML = "password is not matched";
}
return 0;
}

