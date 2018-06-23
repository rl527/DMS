<?php

/*@desc CRUD operations for types table in class Types
  @version 7.0
  @author Ramesh
  @date June 21/18
*/

include_once 'modelwrapper.php';

class Types  
{

	/*@desc selecting the records in the types table
	  @return string data
	 */
	
	
	function selectAll()
	{
		$modelWrap = new ModelWrapper();	
		$data = $modelWrap->selectAll("types");
		return $data;
	}

		/*@desc selecting the types record by id in types table
          @param int id*/

     function selectById($id){
     	$modelWrap = new ModelWrapper();
		$data = $modelWrap->selectById("types",$id);
		return $data;
     }


     	/*@desc deleting the records in types table
          @param int id
       */

	function delete($id)
	{
		$modelWrap = new ModelWrapper();
		$modelWrap->deleteById($id,"types");
	}


	 /*@desc updating types records
       @param string updateArr
       @param int id
        */



	function update($updateArr,$id)
    {
      $modelWrap = new ModelWrapper();
      $rows = $modelWrap->updateRecord("types",$updateArr,$id);
    }



 		/*@desc adding records into the types table
 		  @param string fieldArr
        */

		function addTypes($fieldArr)
		{
			$fieldArr['createdBy'] = 1;
			$fieldArr['updatedBy'] = 1;
			$modelWrap = new ModelWrapper();
			$modelWrap->insertData($fieldArr,"types");				
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