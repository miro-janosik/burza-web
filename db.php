<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

// Helper functions that return rows after calls:
// $stmt = mysqli_stmt_init($link);
// if(!mysqli_stmt_prepare($stmt, $query)){
//   die($text_DatabaseProblem);
// }
// mysqli_stmt_bind_param($stmt, "s", $user);
// Instead of:
// mysqli_stmt_execute($stmt);

// get single row result
function dbGetSingleRowAsArray($stmt)
{
/*	Original:
	$result = mysqli_stmt_get_result($stmt);
	$row = mysqli_fetch_assoc($result);
	return $row;
*/
	mysqli_stmt_store_result($stmt);
	if($stmt->num_rows>0)
	{
		$row = array();
		$md = $stmt->result_metadata();
		$params = array();
		while($field = $md->fetch_field()) 
		{
			$params[] = &$row[$field->name];
		}
		call_user_func_array(array($stmt, 'bind_result'), $params);
		if($stmt->fetch())
		{
			return $row;
		}
	}

	return null;
}

// Get all result rows at once as array.
// $rows = dbGetAllRowsArrayOfArrays($stmt);
// foreach($rows AS $row) { ... $row['Cena'] .... }
function dbGetAllRowsArrayOfArrays($stmt)
{
/*	Original:
	$rows = array();
	$result = mysqli_stmt_get_result($stmt);
	while($row = mysqli_fetch_assoc($result)){
		$rows[] = $row;
	}
	return $rows;
*/

	mysqli_stmt_store_result($stmt);
	$rows = array();

	$row = array();
	$md = $stmt->result_metadata();
	$params = array();
	while($field = $md->fetch_field()) {
		$params[] = &$row[$field->name];
	}
	call_user_func_array(array($stmt, 'bind_result'), $params);

	while ($stmt->fetch())
	{
		// $row data is overwritten in every loop, so I can't 
		// use it directly, I have to make a copy
		$copied_array = array();
		foreach ($row as $key => $value)
			$copied_array[ $key ] = $value;

		$rows[] = $copied_array;
	}

	return $rows;
}


?>
