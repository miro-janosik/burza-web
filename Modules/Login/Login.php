<?php
	if(@empty($RequestURIsingle[1]))
	{
		$smarty->display("Login.tpl");
	}else{
		$user = $RequestURIsingle[1];
		$query = "SELECT * FROM Users WHERE `LoginStr` = ?";
		$stmt = mysqli_stmt_init($link);
		if(!mysqli_stmt_prepare($stmt, $query))
		{
			die($text_DatabaseProblem);
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);

			$row = dbGetSingleRowAsArray($stmt);
			if ($row) {
				$_SESSION["LoggedIn"] = $row;
				$_SESSION["Pridaj"] = false;
				header('Location: '.$HostnamePort.'Dashboard');
				die();
			}
			
			# login failed
			unset($_SESSION["LoggedIn"]);
			session_destroy();
			# header('Location: '.$HostnamePort.'Login');
			
			@$smarty->assign('PrihlasenieZlyhalo', true);
			$smarty->display("Login.tpl");
		}
	}  
	die();

?>
