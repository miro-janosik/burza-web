<?php

	## Zmena v DB:
	## ALTER TABLE `Users` ADD `VariantName` VARCHAR(255) NOT NULL DEFAULT 'Jesen', ADD `VariantActive` BOOL NOT NULL DEFAULT TRUE;

	if(@empty($RequestURIsingle[1]))
	{
		$smarty->display("Login.tpl");
	}else{
		$user = $RequestURIsingle[1];
		# Mozem mat viacero rovnakyh uzivatelov s rovnaky kodom, ale len jeden Variant je aktivny
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

			$rows = dbGetAllRowsArrayOfArrays($stmt);
			# Pre kazdy variant je jeden zaznam uzivatela
			$user = null;
			$variantNames = array();
			foreach($rows AS $row)
			{
				array_push($variantNames, $row['VariantName']);
				if ($row['VariantActive'])
				{
					$user = $row;
				}
			}

			if ($user) {
				$_SESSION["LoggedIn"] = $user;
				$_SESSION["LoggedIn"]["VariantNames"] = $variantNames;
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
