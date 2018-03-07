<?php
	#print_r($_SESSION); die();
	##################
	if(@$RequestURI[0] == 'Pridaj'){
		$_SESSION["Pridaj"] = true;
		header('Location: '.$HostnamePort.'Dashboard');
		die();
	}
	if(@$RequestURI[0] == 'Skry'){
		$_SESSION["Pridaj"] = false;
		header('Location: '.$HostnamePort.'Dashboard');
		die();
	}
	@$smarty->assign('Pridaj', $_SESSION["Pridaj"]);
	##################
	@$smarty->assign('Name', $_SESSION["LoggedIn"]['Name']);
	@$smarty->assign('ID', $_SESSION["LoggedIn"]['ID']);
  ##################
  if(@$_POST['Save']){
		###
		if($_SESSION["LoggedIn"]['ID'] == 0) die("Ty nemozes...");
		###
		$error = false;
    if($Nahadzovanie === 2){
      if(@$_POST['velkost'] < 1 || @$_POST['velkost'] > 37){
        $error[] = "CHYBNA-VELKOST";
        $smarty->assign('ERRVELKOST', true);
      }
    }elseif($Nahadzovanie === 3){
      if(@$_POST['velkost'] < 38 || @$_POST['velkost'] > 47){
        $error[] = "CHYBNA-VELKOST";
        $smarty->assign('ERRVELKOST', true);
      }
    }		
		$_POST['cena'] = @str_replace(',','.',$_POST['cena']);
		if(@!is_numeric($_POST['cena'])){
      $error[] = "CHYBNA-CENA";
			$smarty->assign('ERRCENA', true);
    }
		
//		if(@mb_strlen($_POST['druh']) < 3 || @mb_strlen($_POST['druh']) > 10){
//      $error[] = "CHYBNY-DRUH";
//			$smarty->assign('ERRDRUH', true);
//    }
		
		if(@mb_strlen($_POST['popis']) < 3 || @mb_strlen($_POST['popis']) > 80){
      $error[] = "CHYBNY-POPIS";
			$smarty->assign('ERRPOPIS', true);
    }
		
		if($error){
			@$smarty->assign('Velkost', @$_POST['velkost']);
			@$smarty->assign('Cena', @$_POST['cena']);
			@$smarty->assign('Druh', @$_POST['druh']);
			@$smarty->assign('Popis', @$_POST['popis']);
		}else{
			# Vlozime vysledky do db
      #$query = "INSERT INTO `Polozky` SET `UserID` = ?, `Cena` = ?, `Druh` = ?, `Popis` = ?, `Velkost` = ?";
      $query = "INSERT INTO `Polozky` SET `UserID` = ?, `Cena` = ?, `Popis` = ?, `Velkost` = ?";
      $stmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($stmt, $query)){
        die("moj ty kokot2!\n");
      }
      #mysqli_stmt_bind_param($stmt, "idssi", $_SESSION["LoggedIn"]['ID'], $_POST['cena'], $_POST['druh'], $_POST['popis'], $_POST['velkost']);
      mysqli_stmt_bind_param($stmt, "idsi", $_SESSION["LoggedIn"]['ID'], $_POST['cena'], $_POST['popis'], $_POST['velkost']);
      mysqli_stmt_execute($stmt);
			header('Location: '.$HostnamePort.'Dashboard');
			die();
		}	
  }
  ##################
	if(@$RequestURI[0] == 'Delete') {
		#
		if($_SESSION["LoggedIn"]['ID'] == 0) die("Ty nemozes...");
		#
    if(@empty($RequestURIsingle[1]) || @!is_numeric($RequestURIsingle[1])) header('Location: '.$HostnamePort.'Dashboard');
    $query = "DELETE FROM `Polozky` WHERE `ID` = ? AND `UserID` = ? AND `IDBurzy` = '".$IDBurzy."' AND `Vytlacene` < 1";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("mxxx!");
    }else{
      mysqli_stmt_bind_param($stmt, "ii", $RequestURIsingle[1], $_SESSION["LoggedIn"]['ID']);
      mysqli_stmt_execute($stmt);
    }
    header('Location: '.$HostnamePort.'Dashboard');
		die();
  }
	##################
	if(@$RequestURI[0] == 'Edit') {
		#
		if($_SESSION["LoggedIn"]['ID'] == 0) die("Ty nemozes...");
		#
		if(@empty($RequestURIsingle[1]) || @!is_numeric($RequestURIsingle[1])) header('Location: '.$HostnamePort.'Dashboard');
		#
		if(@$_POST['SaveEdit']){
			#######################################################
			$error = false;
      if($Nahadzovanie === 2){
        if(@$_POST['velkost'] < 1 || @$_POST['velkost'] > 37){
          $error[] = "CHYBNA-VELKOST";
          $smarty->assign('ERRVELKOST', true);
        }
      }elseif($Nahadzovanie === 3){
        if(@$_POST['velkost'] < 38 || @$_POST['velkost'] > 47){
          $error[] = "CHYBNA-VELKOST";
          $smarty->assign('ERRVELKOST', true);
        }
      }
			$_POST['cena'] = @str_replace(',','.',$_POST['cena']);
			if(@!is_numeric($_POST['cena'])){
				$error[] = "CHYBNA-CENA";
				$smarty->assign('ERRCENA', true);
			}

//			if(@mb_strlen($_POST['druh']) < 3 || @mb_strlen($_POST['druh']) > 10){
//				$error[] = "CHYBNY-DRUH";
//				$smarty->assign('ERRDRUH', true);
//			}

			if(@mb_strlen($_POST['popis']) < 3 || @mb_strlen($_POST['popis']) > 80){
				$error[] = "CHYBNY-POPIS";
				$smarty->assign('ERRPOPIS', true);
			}

			if($error){
				@$smarty->assign('Velkost', @$_POST['velkost']);
				@$smarty->assign('Cena', @$_POST['cena']);
				@$smarty->assign('Druh', @$_POST['druh']);
				@$smarty->assign('Popis', @$_POST['popis']);
				@$smarty->assign('Pridaj', true);
				@$smarty->assign('EditID', $RequestURIsingle[1]);
				
			}else{
				# Vlozime vysledky do db
 			  $query = "UPDATE `Polozky` SET `Cena` = ?, `Popis` = ?, `Velkost` = ? WHERE `UserID` = ? AND `ID` = ?  AND `IDBurzy` = '".$IDBurzy."' AND `Vytlacene` < 1";
				$stmt = mysqli_stmt_init($link);
				if(!mysqli_stmt_prepare($stmt, $query)){
					die("moj ty kokot2!\n");
				}
				#mysqli_stmt_bind_param($stmt, "dssiii", $_POST['cena'], $_POST['druh'], $_POST['popis'], $_POST['velkost'], $_SESSION["LoggedIn"]['ID'], $RequestURIsingle[1]);
 				mysqli_stmt_bind_param($stmt, "dsiii", $_POST['cena'], $_POST['popis'], $_POST['velkost'], $_SESSION["LoggedIn"]['ID'], $RequestURIsingle[1]);
				mysqli_stmt_execute($stmt);
				$_SESSION["Pridaj"] = false;
				header('Location: '.$HostnamePort.'Dashboard');
				die();
			}
			
			#######################################################
		}else{
			#
			$query = "SELECT * FROM `Polozky` WHERE `UserID` = ? AND `ID` = ?  AND `IDBurzy` = '".$IDBurzy."'";
			$stmt = mysqli_stmt_init($link);
			if(!mysqli_stmt_prepare($stmt, $query)){
				die("Nieeeeeeeeeeeee...");
			}else{
				mysqli_stmt_bind_param($stmt, "ii", $_SESSION["LoggedIn"]['ID'], $RequestURIsingle[1]);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				$row = mysqli_fetch_assoc($result);
				$row['Cena'] = sprintf("%.2f", $row['Cena']);
				$row['Cena'] = @str_replace('.',',',$row['Cena']);
				#
				//echo "<pre>"; print_r($row); echo "</pre>";	die();
				#
				@$smarty->assign('Velkost', @$row['Velkost']);
				@$smarty->assign('Cena', @$row['Cena']);
				//@$smarty->assign('Druh', @$row['Druh']);
				@$smarty->assign('Popis', @$row['Popis']);
				@$smarty->assign('Pridaj', true);
				@$smarty->assign('EditID', $RequestURIsingle[1]);
			}
		}
		$query = false;
		$stmt = false;
		$result = false;
		$row = false;
  }
	##################
	if(@$RequestURI[0] == 'Predane') {
		#
		if($_SESSION["LoggedIn"]['ID'] != 0) die("Ty nemozes...");
		#
		if(@empty($RequestURIsingle[1]) || @!is_numeric($RequestURIsingle[1])) die('Vadne ID polozky...');
		#
		$query = "UPDATE `Polozky` SET `Predane` = '1' WHERE `ID` = ?";
		$stmt = mysqli_stmt_init($link);
		if(!mysqli_stmt_prepare($stmt, $query)){
			die("moj ty kokot2!\n");
		}
		mysqli_stmt_bind_param($stmt, "i", $RequestURIsingle[1]);
		mysqli_stmt_execute($stmt);
		header('Location: '.$HostnamePort.'Dashboard');
		die();
  }
  $query = "SELECT * FROM `Polozky` WHERE `IDBurzy` = '".$IDBurzy."'";
	if($_SESSION["LoggedIn"]['ID'] == 0){
		$query .= " ORDER BY `ID` DESC";
	}else{
		$query .= " AND `UserID` = ? ORDER BY `ID` DESC";
	}
	#$query = "SELECT * FROM `Polozky`";
	#if($_SESSION["LoggedIn"]['ID'] == 0){
	#	$query .= " ORDER BY `Cislo`";
	#}else{
	#	$query .= " WHERE `UserID` = ? ORDER BY `ID` DESC";
	#}
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
		if($_SESSION["LoggedIn"]['ID'] != 0){
			mysqli_stmt_bind_param($stmt, "d", $_SESSION["LoggedIn"]['ID']);
		}
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
		$NepredaneCelkom = 0;
		$PredaneCelkom = 0;
    $VsetkyCelkom = 0;
    $NedodaneCelkom = 0;
		$PocetDokopy = 0;
		$PocetPredanych = 0;
		$PocetNepredanych = 0;
    $PocetNedodanych = 0;
    while($row = mysqli_fetch_assoc($result)){
			$PocetDokopy++;
			if($row['Velkost'] == 1) $row['Velkost'] = "50 - 56, novorodenec";
			if($row['Velkost'] == 2) $row['Velkost'] = "62 - 68, 3 - 6 mesiacov";
			if($row['Velkost'] == 3) $row['Velkost'] = "74, 6 - 9 mesiacov";
			if($row['Velkost'] == 4) $row['Velkost'] = "80, 9 - 12 mesiacov";
			if($row['Velkost'] == 5) $row['Velkost'] = "86, 12 - 18 mesiacov";
			if($row['Velkost'] == 6) $row['Velkost'] = "92, 18 - 24 mesiacov";
			if($row['Velkost'] == 7) $row['Velkost'] = "98, 2 - 3 roky";
			if($row['Velkost'] == 8) $row['Velkost'] = "104, 3 - 4 roky";
			if($row['Velkost'] == 9) $row['Velkost'] = "110, 4 - 5 rokov";
			if($row['Velkost'] == 10) $row['Velkost'] = "116, 5 - 6 rokov";
			if($row['Velkost'] == 11) $row['Velkost'] = "122, 6 - 7 rokov";
			if($row['Velkost'] == 12) $row['Velkost'] = "128, 7 - 8 rokov";
			if($row['Velkost'] == 13) $row['Velkost'] = "134, 8 - 9 rokov";
			if($row['Velkost'] == 14) $row['Velkost'] = "140, 9 - 10 rokov";
			if($row['Velkost'] == 15) $row['Velkost'] = "146, 10 - 11 rokov";
			if($row['Velkost'] == 16) $row['Velkost'] = "152 a viac, 11 a viac rokov";
			if($row['Velkost'] == 17) $row['Velkost'] = "Univerzálna veľkosť";
			#
			if($row['Velkost'] == 18) $row['Velkost'] = "Novorodenecké";
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
			if($row['Velkost'] == 38) $row['Velkost'] = "50, predčasniatko";
			if($row['Velkost'] == 39) $row['Velkost'] = "56, novorodenec";
			if($row['Velkost'] == 40) $row['Velkost'] = "62, 3 mesiace";
			if($row['Velkost'] == 41) $row['Velkost'] = "68, 6 mesiacov";
			if($row['Velkost'] == 42) $row['Velkost'] = "74, 6 až 9 mesiacov";
			if($row['Velkost'] == 43) $row['Velkost'] = "S";
			if($row['Velkost'] == 44) $row['Velkost'] = "M";
			if($row['Velkost'] == 45) $row['Velkost'] = "L";
			if($row['Velkost'] == 46) $row['Velkost'] = "XL";
			if($row['Velkost'] == 47) $row['Velkost'] = "bez veľkosti";
      			#
			if($row['Predane'] == 1){
				$PredaneCelkom = $PredaneCelkom + $row['Cena'];
				$PocetPredanych++;
			}else{
        if($row['Naskladnene'] == 1){
          $NepredaneCelkom = $NepredaneCelkom + $row['Cena'];
          $PocetNepredanych++;
        }else{
          $NedodaneCelkom = $NedodaneCelkom + $row['Cena'];
          $PocetNedodanych++;
        }
			}
      $VsetkyCelkom += $row['Cena'];
      #######
			$row['Cena'] = sprintf("%.2f", $row['Cena']);
			$row['Cena'] = @str_replace('.',',',$row['Cena']);
			$row['Druh'] = htmlspecialchars($row['Druh']);
			$row['Popis'] = htmlspecialchars($row['Popis']);
			##############
      $Checks[] = $row;
    }
  }
	$MoznaProvizia = $VsetkyCelkom / 100 * 15;
	$MoznaProvizia = round($MoznaProvizia, 2);
	$MoznyZisk = $VsetkyCelkom - $MoznaProvizia;
	#
	$Provizia = $PredaneCelkom / 100 * 15;
	$Provizia = round($Provizia, 2);
	$Zisk = $PredaneCelkom - $Provizia;
	#
	$Provizia = sprintf("%.2f", $Provizia);
	$Zisk = sprintf("%.2f", $Zisk);
	$PredaneCelkom = sprintf("%.2f", $PredaneCelkom);
	#
	$MoznaProvizia = sprintf("%.2f", $MoznaProvizia);
	$MoznyZisk = sprintf("%.2f", $MoznyZisk);
	$NepredaneCelkom = sprintf("%.2f", $NepredaneCelkom);
  $NedodaneCelkom = sprintf("%.2f", $NedodaneCelkom);
  #
  $VsetkyCelkom = sprintf("%.2f", $VsetkyCelkom);
	###########################
	@$smarty->assign('PocetDokopy', $PocetDokopy);
	@$smarty->assign('PocetPredanych', $PocetPredanych);
	@$smarty->assign('PocetNepredanych', $PocetNepredanych);
  @$smarty->assign('PocetNedodanych', $PocetNedodanych);
	@$smarty->assign('PredaneCelkom', $PredaneCelkom);
	@$smarty->assign('Provizia', $Provizia);
	@$smarty->assign('Zisk', $Zisk);
	@$smarty->assign('NepredaneCelkom', $NepredaneCelkom);
  @$smarty->assign('NedodaneCelkom', $NedodaneCelkom);
	@$smarty->assign('MoznaProvizia', $MoznaProvizia);
	@$smarty->assign('MoznyZisk', $MoznyZisk);
  @$smarty->assign('Polozky', $Checks);
  @$smarty->assign('VsetkyCelkom', $VsetkyCelkom);
  ###########################
  if($Nahadzovanie === 2){
    $smarty->display("Dashboard-Nahadzovanie-Normalna.tpl");
  }elseif($Nahadzovanie === 3){
    $smarty->display("Dashboard-Nahadzovanie-Tehotenska.tpl");
  }else{
    $smarty->display("Dashboard-Predaj.tpl");
  }
?>
