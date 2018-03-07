<?php
	ini_set("mbstring.language", "Neutral");
	ini_set("mbstring.internal_encoding", "UTF-8");
	ini_set("mbstring.encoding_translation", "On");
	ini_set("mbstring.http_input", "auto");
	ini_set("mbstring.http_output", "UTF-8");
	ini_set("mbstring.detect_order", "auto");
	ini_set("mbstring.substitute_character", "none");
	ini_set("default_charset", "UTF-8");
	ini_set("mbstring.func_overload", 7);

	setlocale(LC_TIME, "en_US.UTF-8");
	
	if(@$_SESSION["LoggedIn"]['ID'] != 0){
		header('Location: http://piv.pivpiv.dk/');
		die();
	}
	##############################################################################
	if(@empty($RequestURIsingle[1]) || @!is_numeric($RequestURIsingle[1])) die("Ake ciselko?!");
	##############################################################################
	$query = "SELECT * FROM `Users` WHERE `ID` = ?";
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_bind_param($stmt, "i", $RequestURIsingle[1]);
		mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
		echo "<h1>{$row['Name']}, {$row['ID']}</h1>";
	}
	##############################################################################
  $query = "SELECT * FROM `Polozky` WHERE `UserID` = ? ORDER BY `Predane` DESC, `ID`";	
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_bind_param($stmt, "i", $RequestURIsingle[1]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
		#############
		$PredaneCelkom = 0;
		$PocetPredanych = 0;
		#############
		echo "<b>Zoznam predaných položiek:</b><br><br>";
		$np = false;
    while($row = mysqli_fetch_assoc($result)){
			###############################################
			if($row['Velkost'] == 1) $row['Velkost'] = "50 - 56";
			if($row['Velkost'] == 2) $row['Velkost'] = "62 - 68";
			if($row['Velkost'] == 3) $row['Velkost'] = "74";
			if($row['Velkost'] == 4) $row['Velkost'] = "80";
			if($row['Velkost'] == 5) $row['Velkost'] = "86";
			if($row['Velkost'] == 6) $row['Velkost'] = "92";
			if($row['Velkost'] == 7) $row['Velkost'] = "98";
			if($row['Velkost'] == 8) $row['Velkost'] = "104";
			if($row['Velkost'] == 9) $row['Velkost'] = "110";
			if($row['Velkost'] == 10) $row['Velkost'] = "116";
			if($row['Velkost'] == 11) $row['Velkost'] = "122";
			if($row['Velkost'] == 12) $row['Velkost'] = "128";
			if($row['Velkost'] == 13) $row['Velkost'] = "134";
			if($row['Velkost'] == 14) $row['Velkost'] = "140";
			if($row['Velkost'] == 15) $row['Velkost'] = "146";
			if($row['Velkost'] == 16) $row['Velkost'] = "152+";
			if($row['Velkost'] == 17) $row['Velkost'] = "UNI";
			#
			if($row['Velkost'] == 18) $row['Velkost'] = "<18 (EU)";
			if($row['Velkost'] == 19) $row['Velkost'] = "18 (EU)";
			if($row['Velkost'] == 20) $row['Velkost'] = "19 (EU)";
			if($row['Velkost'] == 21) $row['Velkost'] = "20 (EU)";
			if($row['Velkost'] == 22) $row['Velkost'] = "21 (EU)";
			if($row['Velkost'] == 23) $row['Velkost'] = "22 (EU)";
			if($row['Velkost'] == 24) $row['Velkost'] = "23 (EU)";
			if($row['Velkost'] == 25) $row['Velkost'] = "24 (EU)";
			if($row['Velkost'] == 26) $row['Velkost'] = "25 (EU)";
			if($row['Velkost'] == 27) $row['Velkost'] = "26 (EU)";
			if($row['Velkost'] == 28) $row['Velkost'] = "27 (EU)";
			if($row['Velkost'] == 29) $row['Velkost'] = "28 (EU)";
			if($row['Velkost'] == 30) $row['Velkost'] = "29 (EU)";
			if($row['Velkost'] == 31) $row['Velkost'] = "30 (EU)";
			if($row['Velkost'] == 32) $row['Velkost'] = "31 (EU)";
			if($row['Velkost'] == 33) $row['Velkost'] = "32 (EU)";
			if($row['Velkost'] == 34) $row['Velkost'] = "33 (EU)";
			if($row['Velkost'] == 35) $row['Velkost'] = "34 (EU)";
			if($row['Velkost'] == 36) $row['Velkost'] = "35 (EU)";
			if($row['Velkost'] == 37) $row['Velkost'] = "36 (EU)";
			#
			if($row['Predane'] == 1){
				$PredaneCelkom = $PredaneCelkom + $row['Cena'];
				$PocetPredanych++;
			}else{
				if($np == false) echo "<br><b>Zoznam nepredaných položiek:</b><br><br>";
				$np = true;
			}
			$row['Cena'] = sprintf("%.2f", $row['Cena']);
			$row['Cena'] = @str_replace('.',',',$row['Cena']);
			$row['Druh'] = htmlspecialchars($row['Druh']);
			$row['Popis'] = htmlspecialchars($row['Popis']);
			#
			$row['Cena'] = sprintf("%.2f", $row['Cena']);
			$row['Cena'] = @str_replace('.',',',$row['Cena']);
			$row['Druh'] = htmlspecialchars($row['Druh']);
			$row['Druh'] = str_replace(array("\n", "\r"), ' ', $row['Druh']);
			$row['Druh'] = str_replace(';', ',', $row['Druh']);
			$row['Popis'] = htmlspecialchars($row['Popis']);
			$row['Popis'] = str_replace(array("\n", "\r"), ' ', $row['Popis']);
			$row['Popis'] = str_replace(';', ',', $row['Popis']);
			##############
			echo("Kód: ".$row['Cislo'].'; Cena: '.$row['Cena'].' €; veľkosť: '.$row['Velkost'].'; Popis: '.$row['Druh'].', '.$row['Popis'].';'."<br>");
			#########################################
    }
		#########################
		$Provizia = $PredaneCelkom / 100 * 15;
		$Provizia = round($Provizia, 2);
		$Zisk = $PredaneCelkom - $Provizia;
		#
		$Provizia = sprintf("%.2f", $Provizia);
		$Zisk = sprintf("%.2f", $Zisk);
		$PredaneCelkom = sprintf("%.2f", $PredaneCelkom);
	###########################
		echo "<br><b>Vyhodnotenie predaných položiek:</b><br><br>";
		echo "Suma cien predaných položiek: ".$PredaneCelkom." €<br>";
		echo "Z toho provízia pre Baba Klub: ".$Provizia." €<br>";
		echo "Z toho zisk: ".$Zisk." €<br>";
  }
	##############################################################################
?>