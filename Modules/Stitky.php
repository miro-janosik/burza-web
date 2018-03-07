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
	#die("POZOR ZMENI CISLO!");
	##############################################################################
	echo "<pre>";
	echo "N;ID;UserID;BC;CENA;VELKOST;OPIS;\n";
	###
  $query = "SELECT * FROM `Polozky` WHERE `IDBurzy` = '15' AND `Vytlacene` = '0' ORDER BY `UserID`,`ID`";	
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
		###
		$PredoslyUser = false;
                $i = 0;
		###
    while($row = mysqli_fetch_assoc($result)){
			###############################################
                        $i++;
                        ###############################################
			$TerajsiUser = $row['UserID'];
			if($TerajsiUser != $PredoslyUser){
				$CenaCelkom = 0;
				$Pocet = 0;
				$PredoslyUser = $TerajsiUser;
			}
			$Pocet++;
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
                        #
                        # Pre topanky tlacime 2 stitky
                        #
                        $DvaStitky = false;
                        if($row['Velkost'] > 17 && $row['Velkost'] < 38) $DvaStitky = true;
                        #
                        #
			if($row['Velkost'] == 18) $row['Velkost'] = "Baby";
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
                        #############################
                        if($row['Velkost'] == 38) $row['Velkost'] = "50";
			if($row['Velkost'] == 39) $row['Velkost'] = "56";
			if($row['Velkost'] == 40) $row['Velkost'] = "62";
			if($row['Velkost'] == 41) $row['Velkost'] = "68";
			if($row['Velkost'] == 42) $row['Velkost'] = "74";
			if($row['Velkost'] == 43) $row['Velkost'] = "S";
			if($row['Velkost'] == 44) $row['Velkost'] = "M";
			if($row['Velkost'] == 45) $row['Velkost'] = "L";
			if($row['Velkost'] == 46) $row['Velkost'] = "XL";
			if($row['Velkost'] == 47) $row['Velkost'] = "--";
                        #
			$CenaCelkom = $CenaCelkom + $row['Cena'];
			$row['Cena'] = sprintf("%.2f", $row['Cena']);
			$row['Cena'] = @str_replace('.',',',$row['Cena']);
			$row['Popis'] = htmlspecialchars($row['Popis']);
			$row['Popis'] = str_replace(array("\n", "\r"), ' ', $row['Popis']);
			$row['Popis'] = str_replace(';', ',', $row['Popis']);
      $row['Popis'] = trim($row['Popis']);
      $BarCode = $row['BarCode'];
			##############
			$NoveCislo = $TerajsiUser.'/'.($Pocet);
			##############
			//echo($TerajsiUser.'/'.($Pocet).';'.$row['Cena'].';'.$row['Velkost'].';'.$row['Druh'].', '.$row['Popis'].';'."\n");
			$TextRiadku = ($row['ID'].';'.$row['UserID'].';'.$BarCode.';'.$row['Cena'].';'.$row['Velkost'].';'.$row['Popis'].';'."\n");
                        echo ($i.';'.$TextRiadku);
                        if($DvaStitky){
                          $i++;
                          echo ($i.';'.$TextRiadku);
                        }
			#########################################
    }
  }
	$Provizia = $CenaCelkom / 100 * 15;
	$Provizia = round($Provizia, 2);
	$Zisk = $CenaCelkom - $Provizia;
	$Provizia = sprintf("%.2f", $Provizia);
	$Zisk = sprintf("%.2f", $Zisk);
	$CenaCelkom = sprintf("%.2f", $CenaCelkom);
	##############################################################################
	echo "</pre>";
?>
