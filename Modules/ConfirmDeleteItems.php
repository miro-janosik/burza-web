<?php

function deleteItems($link, $userId)
{
	$stmt = mysqli_stmt_init($link);
	$query = "DELETE FROM `Polozky` WHERE `UserID` = $userId";
	if (!mysqli_stmt_prepare($stmt, $query))
		die("deleteItems prepare '$query'");
	if (!mysqli_stmt_execute($stmt))
		die("deleteItems execute '$query'");
	$deleted = mysqli_stmt_affected_rows($stmt);
	return $deleted;
}

function numItems($link, $userId)
{
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT COUNT(ID) as count FROM `Polozky` WHERE `UserID` = $userId";
	if (!mysqli_stmt_prepare($stmt, $query))
		die("SELECT COUNT prepare '$query'");
	if (!mysqli_stmt_execute($stmt))
		die("SELECT COUNT execute '$query'");
	$row = dbGetSingleRowAsArray($stmt);

	$num = -2;
	if ($row != null)
	{
		$num = $row['count'];
		if (!is_numeric($num))
		{
			$num = -1;
		}
	}

	return $num;
}

function deletItemsByItemNumbers($link, $userId, $text)
{
	// split string on spaces or commas
	$itemNumbers = preg_split( "/( |,)/", $text );
	
	if (count( $itemNumbers ) < 3)
	{
		return "Not enough items to delete, less than 3";
	}
	
	// get item numbers of the user
	$stmt = mysqli_stmt_init($link);
	$query = "SELECT `Cislo`, `ID` FROM `Polozky` WHERE `UserID` = $userId";
	if (!mysqli_stmt_prepare($stmt, $query))
		die("deletItemsByItemNumbers prepare '$query'");
	if (!mysqli_stmt_execute($stmt))
		die("deletItemsByItemNumbers execute '$query'");
	$row = dbGetSingleRowAsArray($stmt);
	
	// check the numbers
	$itemIds = [];
	foreach($itemNumbers as $itemNum)
	{
		$id = -1;
		foreach($rows AS $row)
		{
			if ( $row['Cislo'] == $itemNum )
			{
				$id = $row['ID'];
			}
		}
		
		if ($id == -1)
		{
			return "There is no such item with number '$itemNum'";
		}
		
		array_push($itemIds, $id);
	}
	
	// delete them
	$ids = join(",", $itemIds);
	$query = "DELETE FROM `Polozky` WHERE `ID` IN ($ids)";
	if (!mysqli_stmt_prepare($stmt, $query))
		die("deletItemsByItemNumbers prepare '$query'");
	if (!mysqli_stmt_execute($stmt))
		die("deletItemsByItemNumbers execute '$query'");
	$deleted = mysqli_stmt_affected_rows($stmt);

	return 0;
}

$userId = htmlspecialchars($_SESSION["LoggedIn"]['ID']);
if (empty($userId))
{
	die("ConfirmDeleteItems: nie je LoggedIn ID");
}

$vybraneItemy = @$_POST['ItemsToDelete'];
if (!isset($vybraneItemy))
{
	// this is not correct, the field has to be present.
	header('Location: '.$HostnamePort.'Dashboard');
	die();
}

if ($vybraneItemy == "ALL")
{
	$mazancieSlovo = @$_POST['MazacieSlovo'];
	if (isset($mazancieSlovo))
	{
		if ($mazancieSlovo == "zmazat")
		{
			$deleted = deleteItems($link, $userId);
			$_SESSION["Zmazanych"] = $deleted;
			@$smarty->assign('Zmazanych', $deleted);
		
			# $smarty->display("Dashboard-Predaj.tpl");
			#$_SESSION["Pridaj"] = true;
			header('Location: '.$HostnamePort.'Dashboard');
			die();
		}
		else 
		{
			@$smarty->assign('ZmazanieNespraveSlovo', true);
			$_SESSION["Chyba"] = "Nesprávne opísané slovo";
			@$smarty->assign('Chyba', "Nesprávne opísané slovo");
		}
	}

	$num = numItems($link, $userId);
	@$smarty->assign('PoloziekNaZmazanie', $num);

	$smarty->display("ConfirmDeleteItems.tpl");
}
else
{
	$res = deletItemsByItemNumbers($link, $userId, $vybraneItemy);
	if ($res != 0)
	{
		$_SESSION["Chyba"] = $res;
		@$smarty->assign('Chyba', $res);
	}
	
	header('Location: '.$HostnamePort.'Dashboard');
	die();
}

?>
