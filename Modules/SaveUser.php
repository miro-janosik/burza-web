<?php
		
	$id = htmlspecialchars($_SESSION["LoggedIn"]['ID']);
	if (empty($id))
	{
		die("SaveUser: nie je LoggedIn ID");
	}
	
	$Name = htmlspecialchars($_POST['Name']);
	$Mail = htmlspecialchars($_POST['Email']);
	$Kontakt = htmlspecialchars(@$_POST['Kontakt']);
	
	$query = "UPDATE `Users` SET `Name` = '$Name', `Mail` = '$Mail', `Kontakt` = '$Kontakt' WHERE `ID` = '$id'";
	$stmt = mysqli_stmt_init($link);
	if(!mysqli_stmt_prepare($stmt, $query)){
		echo $query . " ...";
		die("SaveUser prepare do databazy neuspesne!");
	}
	# mysqli_stmt_bind_param($stmt, "sssi", $Name, $Mail, $Kontakt);
	if (!mysqli_stmt_execute($stmt))
	{
		die("SaveUser execute do databazy neuspesne!");
	}
	
	# refresh data in _SESSSION - that is where they are read from into GUI
	$_SESSION["LoggedIn"]['Name'] = $Name;
	$_SESSION["LoggedIn"]['Mail'] = $Mail;
	$_SESSION["LoggedIn"]['Kontakt'] = $Kontakt;
	
	# now load Dashboard just as if nothing happened
	require_once 'Modules/Dashboard/Dashboard.php';
	header('Location: '.$HostnamePort.'Dashboard');
	die();
?>
