<?php
  ##############################################################################
  # HOME
  ##############################################################################
  if(@$_SESSION['Terminal-Akcia'] == "Home"){
    if(@strlen($_POST['BarCode']) > 1){
      $BarCode = $_POST['BarCode'];
      if($BarCode == "BBK-AKCIA1K"){
        #NASKLADNIT
        $_SESSION['BarCodes'] = array(); #Reset
        $_SESSION['Terminal-Akcia'] = "Naskladni";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }
      ####### Ak sme sa sem dostali, bola nascanovana PICOVINA
      header('Location: '.$HostnamePort.'Terminal');
      die();
    }
    #NEBOLO SCANOVANE
    $smarty->display("Terminal-Home.tpl");
    die();
  ##############################################################################
  # NASKLADNI
  ##############################################################################
  }elseif(@$_SESSION['Terminal-Akcia'] == "Naskladni"){
    #Naskladni
    #Die('naskladni');
    if(@strlen($_POST['BarCode']) > 1){
      $BarCode = $_POST['BarCode'];
      if($BarCode == "BBK-AKCIA1K"){
        #POTVRDIT (ak nie 0)
        if(@count($_SESSION['BarCodes']) < 1){
          header('Location: '.$HostnamePort.'Terminal');
          die();
        }else{
          $_SESSION['Terminal-Akcia'] = "Potvrdit";
          header('Location: '.$HostnamePort.'Terminal');
          die();
        }
      }elseif($BarCode == "BBK-AKCIA3M"){
        #ZRUSIT
        $_SESSION['BarCodes'] = false;
        $_SESSION['Terminal-Akcia'] = "Home";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }
      if(@strlen($_POST['BarCode']) > 1 && @strlen($_POST['BarCode']) < 10){
        ####### Ak sme sa sem dostali, bol nascanovany LIVE BAR CODE
        #Odstranime duplicity...
        if(@array_search($BarCode, $_SESSION['BarCodes']) === false){
          $_SESSION['BarCodes'][] = $BarCode;
          header('Location: '.$HostnamePort.'Terminal');
          die();
        }else{
          @$smarty->assign('ERR', 'Duplicitné nascanovanie!');
          $count = count($_SESSION['BarCodes']);
          @$smarty->assign('POCET', $count);
          $smarty->display("Terminal-Naskladnit.tpl");
        }
      }
      ####### Ak sme sa sem dostali, bola nascanovana PICOVINA
      header('Location: '.$HostnamePort.'Terminal');
      die();
    }
    $count = count($_SESSION['BarCodes']);
    @$smarty->assign('POCET', $count);
    $smarty->display("Terminal-Naskladnit.tpl");
    ####
  ##############################################################################
  # POTVRDIT
  ##############################################################################
  }elseif(@$_SESSION['Terminal-Akcia'] == "Potvrdit"){
    ############################################################################
    if(@strlen($_POST['BarCode']) > 1){
      $BarCode = $_POST['BarCode'];
      if($BarCode == "BBK-AKCIA1K"){
        #DOPLNIT = spat na naskladnit
        $_SESSION['Terminal-Akcia'] = "Naskladni";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }elseif($BarCode == "BBK-AKCIA2L"){
        #POTVRDIT
        $_SESSION['Terminal-Akcia'] = "Zapisat";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }elseif($BarCode == "BBK-AKCIA3M"){
        #ZRUSIT
        $_SESSION['BarCodes'] = false;
        $_SESSION['Terminal-Akcia'] = "Home";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }
      ####### Ak sme sa sem dostali, bola nascanovana PICOVINA
      header('Location: '.$HostnamePort.'Terminal');
      die();
    }
    ############
    # NIC SA NESCANOVALO
    ############################################################################
    # Tu sa pozrieme ci su vsetky barkody od jednej predajkyne...
    # a ci ziaden nechyba...
    #
    # Ak nic nechyba, rovno potvrdime do DB!
    #
    # Ak chyba, dame moznost zrusit, potvrdit co je, alebo doplnit
    #
    $BarCodes = join('\',\'',$_SESSION['BarCodes']);
    $BarCodes = "'".$BarCodes."'";
    $query = "SELECT * FROM `Polozky` WHERE `BarCodeWSUM` IN (".$BarCodes.")";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("Nieeeeeeeeeeeee...");
    }else{
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      ##########
      $UserID = false;
      $Error = false;
      ##########
      while($row = mysqli_fetch_assoc($result)){
        if($UserID === false) $UserID = $row['UserID'];
        # VELKA CHYBA, POMIESANE MATKY
        if($UserID != $row['UserID']){
          @$smarty->assign('ERR', 'Nie vsetky scanovane stitky boli od jednej predajkyne!<br>Toto ststem zatial nezvlada..!<br>V jednom naskladneni sa smu nachadzat len stitky jednej predajkyne!');
          $_SESSION['BarCodes'] = false;
          $_SESSION['Terminal-Akcia'] = "Home";
          $smarty->display("Terminal-Home.tpl");
          die();
        }
      }
    }
    ##########################
    # Teraz pozrieme tie co chybaju...
    $query = false;
    $stmt = false;
    $result = false;
    $row = false;
    $query = "SELECT * FROM `Polozky` WHERE (`UserID` = '".$UserID."' AND `BarCodeWSUM` NOT IN (".$BarCodes."));";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("Nieeeeeeeeeeeee...");
    }else{
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $rows2 = mysqli_stmt_affected_rows($stmt);
    }
    # Zobrazime 13
    $query = false;
    $stmt = false;
    $result = false;
    $row = false;
    $query = "SELECT SQL_CALC_FOUND_ROWS * FROM `Polozky` WHERE (`UserID` = '".$UserID."' AND `BarCodeWSUM` NOT IN (".$BarCodes.")) LIMIT 0 , 13;";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("Nieeeeeeeeeeeee...");
    }else{
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $rows = mysqli_stmt_affected_rows($stmt);
      ##########
      while($row = mysqli_fetch_assoc($result)){
        $xxx[] = $row;
      }
    }  
    #echo "<pre>";print_r($xxx);echo"</pre>";die();
    $Chyba = @count($xxx);
    if($Chyba < 1){
      $_SESSION['PocetChybajucich'] = 0;
      $_SESSION['Terminal-Akcia'] = "Zapisat";
      header('Location: '.$HostnamePort.'Terminal');
      die();
    }else{
      @$smarty->assign('Polozky', $xxx);
      @$smarty->assign('Zobrazujem', $rows);
      @$smarty->assign('PocetChybajucich', $rows2);
      $_SESSION['PocetChybajucich'] = $rows2;
      $smarty->display("Terminal-Potvrdit.tpl");
      die();
    }
    ######
  ##############################################################################
  # ZAPISAT DO DB
  ##############################################################################
  }elseif(@$_SESSION['Terminal-Akcia'] == "Zapisat"){
    #Zapisat
    #Die('Zapis...');
    if(@strlen($_POST['BarCode']) > 1){
      $BarCode = $_POST['BarCode'];
      if($BarCode == "BBK-AKCIA1K"){
        #ZRUSIT
        $_SESSION['BarCodes'] = false;
        $_SESSION['Terminal-Akcia'] = "Home";
        header('Location: '.$HostnamePort.'Terminal');
        die();
      }
      ####### Ak sme sa sem dostali, bola nascanovana PICOVINA
      header('Location: '.$HostnamePort.'Terminal');
      die();
    }
    ############################################################################
    # A ideme zapisaovat do db...
    ############################################################################
    $celkom = 0;
    $duplicita = 0;
    foreach ($_SESSION['BarCodes'] as $CurrentBC) {
      #echo "Value: $CurrentBC<br />\n";
      $Xquery = "UPDATE `Polozky` SET `Naskladnene` = 1 WHERE `BarCodeWSUM` = ?";
      $Xstmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($Xstmt, $Xquery)){
        die("PROBLEEEEEEEEEEEEEEM!\n");
      }
      mysqli_stmt_bind_param($Xstmt, "s", $CurrentBC);
      mysqli_stmt_execute($Xstmt);
      $rows3 = mysqli_stmt_affected_rows($Xstmt);
      $celkom = $celkom + $rows3;
      if($rows3 != 1){
        $duplicita++;
      }
    }
    if($duplicita != 0) @$smarty->assign('Duplicita', $duplicita);
    @$smarty->assign('Donesenych', $celkom);
    @$smarty->assign('NEDonesenych', $_SESSION['PocetChybajucich']);
    ############################################################################
    $smarty->display("Terminal-Zapis.tpl");
    die();
    ####
  ##############################################################################
  # NEDEFINOVANE (zaciatok)
  ##############################################################################
  }else{
    # Ak nemame nastavenu akciu, nastavime home a redirect
    $_SESSION['BarCodes'] = false;
    $_SESSION['Terminal-Akcia'] = "Home";
    header('Location: '.$HostnamePort.'Terminal');
    die();
  }
?>