<?php

/*@desc CRUD operations for users table in class Brands
  @version 7.0
  @author Ramesh
  @date June 21/18
*/

// include_once 'includes/dbconnect.php';
include_once 'modelwrapper.php';

class Brands  
{

	/*@desc selecting the records in the brands table
	  @return string data
	 */
	
	
	function selectAll()
	{
		$modelWrap = new ModelWrapper();	
		$data = $modelWrap->selectAll("brands");
		return $data;
	}

		
		/*@desc selecting the brands record by id in brands table
          @param int id*/

     function selectById($id){
     	$modelWrap = new ModelWrapper();
		$data = $modelWrap->selectById("brands",$id);
		return $data;
     }

     	/*@desc deleting the records in brands table
          @param int id
       */

	function delete($id)
	{
		$modelWrap = new ModelWrapper();
		$modelWrap->deleteById($id,"brands");
	}


	 /*@desc updating brands records
       @param string updateArr
       @param int id
        */



	function update($updateArr,$id)
    {
      $modelWrap = new ModelWrapper();
      $rows = $modelWrap->updateRecord("brands",$updateArr,$id);
    }
        /*@desc adding records into the brands table
 		  @param string fieldArr
        */

	function addBrands($fieldArr)
	{
		$fieldArr['createdBy'] = 1;
		$fieldArr['updatedBy'] = 1;
		$modelWrap = new ModelWrapper();
		$modelWrap->insertData($fieldArr,"brands");				
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