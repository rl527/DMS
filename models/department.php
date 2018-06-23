<?php

/*@desc CRUD operations for users table in class Department
  @version 7.0
  @author susmitha
  @date June 21/18
*/


include_once 'modelwrapper.php';

class Department  
{

	
	/*@desc selecting the records from department table
	  @return string data
	 */
	
	function selectAll()
	{
		$modelWrap = new ModelWrapper();	
		$data = $modelWrap->selectAll("department");
		return $data;
	}

	/*@desc selecting the department record by id in department table
      @param int id*/

     function selectById($id)
     {
     	$modelWrap = new ModelWrapper();
		$data = $modelWrap->selectById("department",$id);
		return $data;
     }
 		
 		/*@desc deleting the records in department table
          @param int id
       */

	function delete($id)
	{
		$modelWrap = new ModelWrapper();
		$modelWrap->deleteById($id,"department");
	}


	 /*@desc updating department records
       @param string updateArr
       @param int id
        */

	function update($updateArr,$id)
    {
      $modelWrap = new ModelWrapper();
      $rows = $modelWrap->updateRecord("department",$updateArr,$id);
    }

 		/*@desc adding records into the department table
 		  @param string fieldArr
        */

	function addDept($fieldArr)
	{
		$fieldArr['createdBy'] = 1;
		$fieldArr['updatedBy'] = 1;
		$modelWrap = new ModelWrapper();
		$modelWrap->insertData($fieldArr,"department");				
	}

    /*@desc selecting department records to display on the userdashboard
	  @return string rows
	*/

	  function tablerows()
	  {
		$modelWrap = new ModelWrapper();
		$rows = $modelWrap->tablerows("department");
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