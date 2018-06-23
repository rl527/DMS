<?php
/*@desc creating class connetDB for database connection
  @version 7.0
  @author Ramesh
  @date 9/6/2018
*/

class connectDB
{
public function __construct()
{	
 $this->conn = new mysqli("localhost","root","Root@123","dms");	
		
				 if($conn->connect_error)
				{
				die("Error Occured ".$conn->connect_error);
			}
			else
			{
				// echo "Connected Successfully";
			}
			
		}
	}
	?>
