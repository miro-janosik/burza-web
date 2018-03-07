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
  #
	setlocale(LC_TIME, "en_US.UTF-8");
  #
  $link = mysqli_connect('localhost', 'XXXXX', 'XXXX', 'bbk_burza');
	if (!mysqli_set_charset($link, "utf8")) {
		printf("Error loading character set utf8: %s\n", mysqli_error($link));
	}
  //overim, ci boli zadane hodnoty do oboch policok
  if(!$link){
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
  }
	##############################################################################
  $query = "SELECT * FROM `Polozky` WHERE (`IDBurzy` = '15' AND `BarCode` IS NULL) ORDER BY `UserID`,`ID`";	
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      $BarCode = generateRandomString();
      $BarCodeSUM = checksum_code39($BarCode);
      $BarCodeWSUM = $BarCode . $BarCodeSUM;
      echo($row['ID'].' --> '.$BarCode." --> ".$BarCodeWSUM."\n");
      #########################################
      $Xquery = "UPDATE `Polozky` SET `BarCode` = ?, BarCodeWSUM = ? WHERE `ID` = '".$row['ID']."'";
      $Xstmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($Xstmt, $Xquery)){
        die("moj ty kokot2!\n");
      }
      mysqli_stmt_bind_param($Xstmt, "ss", $BarCode, $BarCodeWSUM);
      mysqli_stmt_execute($Xstmt);
      #########################################
    }
  }
  ####################
  function generateRandomString($length = 8) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
   }
   function checksum_code39($code) {

    //Compute the modulo 43 checksum

    $chars = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
                            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K',
                            'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V',
                            'W', 'X', 'Y', 'Z', '-', '.', ' ', '$', '/', '+', '%');
    $sum = 0;
    for ($i=0 ; $i<strlen($code); $i++) {
        $a = array_keys($chars, $code[$i]);
        $sum += @$a[0];
    }
    $r = $sum % 43;
    return $chars[$r];
  }
?>
