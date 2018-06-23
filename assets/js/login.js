/*@desc validations for login form
  @author priyanka
  @date June 21/18
  */
function validateForm() 
{

                var errorCount=0;
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                $ok=true;
                
                var email = document.getElementById("email").value;
                if(email=="")
                {
                    document.getElementById("emailError").innerHTML="Email ID should be filled";
                    document.getElementById("emailError").style.color="Red";
                    $ok=false;   
                }
                else if (!(email).match(emailReg)) 
                {
                    document.getElementById("emailError").innerHTML="Invalid email id..!!!!!!";
                    $ok=false;       
                }
                else
                {
                   document.getElementById("emailError").innerHTML="";
                  
                }

               
              
                var password = document.getElementById("pwd").value;
                if(password=="")
                {
                    document.getElementById("pwdError").innerHTML="password should be filled";
                    document.getElementById("pwdError").style.color="Red";
                    $ok=false;   
                }
                
                else
                {
                    document.getElementById("pwdError").innerHTML="";
                   
                }

                if($ok==false)
                {
                    return false;
                }
                else
                {
                    return true;
                }
                

}
               
             










