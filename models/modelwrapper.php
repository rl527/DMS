<?php
/*@desc CRUD operations for all tables in class ModelWrapper
  @author ramesh
  @version 7.0
  @date June 21/18*/

include_once 'includes/dbconnect.php';

class ModelWrapper
{
	/*@desc selecting records from all the tables
	  @param string table
	  @return string result
	  */
	function selectAll($table)
	{
		$sql = "SELECT * FROM $table";
		$result = $this->runQuery($sql);
		return $result;
    }


	/*@desc selecting records from all the tables through id
	  @param string table
	  @param int id
	  @return string result
	  */
    function selectById($table,$id)
    {
    	$sql .= "SELECT * FROM $table where id = '$id' ";
    	$result = $this->runQuery($sql);
		return $result;
    }


	/*@desc delecting records from all the tables through id
	  @param string table
	  @param int id
	  */
	function deleteById($id,$table)
    {
		$sql = "DELETE FROM $table WHERE id = '$id'";
		$this->runQuery($sql);
		return 0;
 	}

 	/*@desc inserting records to all the tables 
	  @param string fieldArr
	  @param string table
	  */
	function insertData($fieldArr,$table)
		{
		$dbObj = new connectDB();
		$sql .= "INSERT INTO $table(";
		$keysArray =  array_keys($fieldArr);
		$count = count($fieldArr);
		$i=0;
		while($i<$count){
			$sql .= "".$keysArray[$i].",";
			$i++;
		}
		$sql = rtrim($sql,",");
		$sql .= ") VALUES('";
		$i=0;
		while($i<$count){
		
			$sql .= "".$fieldArr[$keysArray[$i]]."','";
			$i++;
		}	
		$sql = rtrim($sql,",'");
		$sql .= "')";
		$result = mysqli_query($dbObj->conn,$sql);
		if($result == TRUE)
		{
			return 1;
		}
		else
		{
			return 0;
		}
		
    }


 	/*@desc updating records to all the tables 
	  @param string fieldArr
	  @param string table
	  @param int id
	  */

    function updateRecord($table,$updateArr,$id)
	{
		$dbObj = new connectDB();
  		$sql .= "UPDATE $table
				SET";
		$keysArray =  array_keys($updateArr);
		$count = count($updateArr);
		$i=0;
		while($i<$count){
			$sql .= " ".$keysArray[$i] ." = '".$updateArr[$keysArray[$i]]."',";
			$i++;
		}
		$sql = rtrim($sql,",");
		$sql .= " where id = '$id'";
		$result = mysqli_query($dbObj->conn,$sql);
		if($result == TRUE)
		{
		}
		else{
			echo "Failes to update";
		}
	}


	/*@desc selecting records from the tables to display on the Dahsboard
	  @param string table
	  */

	public function tablerows($table)
	{
		$dbconnect = new connectDB();
		$sql = "SELECT * FROM $table";
		$num_rows = mysqli_num_rows($dbconnect->conn->query($sql));
		return $num_rows;
	}

		/*@desc for all queries to run
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
		  return 0;
		}
	}

  }

?>
