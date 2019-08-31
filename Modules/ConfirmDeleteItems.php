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

$userId = htmlspecialchars($_SESSION["LoggedIn"]['ID']);
if (empty($userId))
{
	die("ConfirmDeleteItems: nie je LoggedIn ID");
}

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
	}
}

$num = numItems($link, $userId);
@$smarty->assign('PoloziekNaZmazanie', $num);

$smarty->display("ConfirmDeleteItems.tpl");
?>
