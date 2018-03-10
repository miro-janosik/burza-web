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
	##############################################################################
  echo "OPRAVA...<br><br>";
	###
	#$query = "SELECT * FROM `Stitky` WHERE `Processed` IS NULL";
	$query = "SELECT * FROM `Stitky`";
	##############################################################################
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("mysqli_stmt_prepare error oprava.1...");
  }
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	while($row = mysqli_fetch_assoc($result)){
		echo "Idem opravovat cislo: <b>".$row['ID']."</b> s cenou <b>".$row['CENA']."</b> a opisom ".$row['OPIS']."<br>";
		$cena = @str_replace(',','.',$row['CENA']);
		echo "Menim cenu na: <b>".$cena."</b><br>";
		######################################################
		list($druh, $opis) = explode(', ', $row['OPIS'], 2);
		echo "Nastavujem druh: <b>".$druh."</b> a opis: ".$opis."<br>";
		$opis = @str_replace('&,','&',$opis);
		echo "Opravil som & v popise: ".$opis."<br>";
		list($user, $cisloPolozky) = explode('/', $row['ID'], 2);
		echo "Uzivatel cislo: <b>".$user."</b>, polozka cislo: <b>".$cisloPolozky."</b><br>";
		#######################################################
		#######################################################
		#########################################
		$Xquery = "UPDATE `Polozky` SET `Cislo` = ?, `Opravene` = '1' WHERE `UserID` = ? AND `Cena` = ? AND `Druh` = ? AND `Popis` = ?";
		$Xstmt = mysqli_stmt_init($link);
		if(!mysqli_stmt_prepare($Xstmt, $Xquery)){
			die("mysqli_stmt_prepare error oprava.2!\n");
		}
		mysqli_stmt_bind_param($Xstmt, "sidss", $row['ID'], $user, $cena, $druh, $opis);
		mysqli_stmt_execute($Xstmt);
		$opravene = mysqli_affected_rows($link);
		echo "Opravenych bol: <b>".$opravene."</b> riadok<br><br>";
		$Xquery = false;
		$Xstmt = false;
		$opravene = FALSE;
	}
	
?>
