<?php

/*@desc CRUD operations for devices table in class Devices
  @version 7.0
  @author priyanka
  @date June 21/18
*/

include_once 'modelwrapper.php';

class Devices  
{

	
	/*@desc selecting the records in the devices table
	  @return string data
	 */
	
	
	
	function selectAll()
	{
		$modelWrap = new ModelWrapper();	
		$data = $modelWrap->selectAll("devices");
		return $data;
	}

		/*@desc selecting the devices record by id in devices table
          @param int id*/

     function selectById($id)
     {
     	$modelWrap = new ModelWrapper();
		$data = $modelWrap->selectById("devices",$id);
		return $data;
     }

     	/*@desc deleting the records in devices table
          @param int id
       */

	function delete($id)
	{
		$modelWrap = new ModelWrapper();
		$modelWrap->deleteById($id,"devices");
	}


	/*@desc updating devices records
       @param string updateArr
       @param int id
        */

	function update($updateArr,$id)
    {
      $modelWrap = new ModelWrapper();
      $rows = $modelWrap->updateRecord("devices",$updateArr,$id);
    }


 		/*@desc adding records into the devices table
 		  @param string fieldArr
        */

	function addDevices($fieldArr)
	{
		$fieldArr['createdBy'] = 1;
		$fieldArr['updatedBy'] = 1;
		$modelWrap = new ModelWrapper();
		$modelWrap->insertData($fieldArr,"devices");				
	}


 /*@desc selecting data from devices and users table
    @param string $startfrom
    @param string $recpage
    @return string $data*/

	function tableData($startfrom,$recpage)
    {
      $userid =  $_SESSION['userid'];
      $sql = "select d.id as id,d.deviceName as dname,u.name as uname,u.email as email from users u ,devices d WHERE u.id = d.updatedBy AND d.isActive = 1 AND role='user' LIMIT $startfrom, $recpage";
      
       $rows = $this->runQuery($sql);

      return $rows;
    }



	/*@desc selecting devices records to display on the userdashboard
	  @return string data
	*/

	  function tablerows()
	  {
		$modelWrap = new ModelWrapper();
		$rows = $modelWrap->tablerows("devices");
		return $rows;
	}

  /*@desc for all querires to run
    @param string sql
    @return string rows*/


	function runQuery($sql)
	{
			$dbObj = new connectDB();
			$result = mysqli_query($dbObj->conn,$sql);

			if($result == TRUE)
			{ 
			$num_rows=mysqli_num_rows($result);	
			$i=0;
			while($i < $num_rows)
			{
				$row = mysqli_fetch_assoc($result);
			    $rows[] = $row;
			    $i++;
			}
				return $rows;
			}
			else
			{
			  echo "Fails";
			}
	}

}

?>