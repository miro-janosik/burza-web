<?php
  #
  $query = "SELECT `Status`,COUNT(*) as count FROM `LastSMTPStates` LEFT JOIN `SMTPStates` ON `LastSMTPStates`.`MaxID` = `SMTPStates`.`ID` GROUP BY `Status`";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("moj ty kokot!");
  }else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      if(@$row['Status'] == "OK") $ok = $row['count'];
      if(@$row['Status'] == "CRITICAL") $crit = $row['count'];
      $x[] = $row;
    }
    //print_r($x);
    @$smarty->assign('OK', $ok);
    @$smarty->assign('CRIT', $crit);
  }
  ######################
  if(@$RequestURI[1] == 'SMTP/AddCheck') {
    require_once 'Modules/SMTP/AddCheck.php';
    die();
  }
  if(@$RequestURI[1] == 'SMTP/View') {
    require_once 'Modules/SMTP/View.php';
    die();
  }
  #####################
  if(@$RequestURI[1] == 'SMTP/Delete') {
    if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'SMTP');
    $query = "DELETE FROM `SMTPChecks` WHERE `ID` = ? AND `CustomerID` = ?";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("mxxx!");
    }else{
      mysqli_stmt_bind_param($stmt, "ii", $RequestURIsingle[2], $_SESSION["LoggedIn"]['ID']);
      mysqli_stmt_execute($stmt);
    }
    header('Location: '.$HostnamePort.'SMTP');
  }
  #
  $smarty->assign('CustomerID', $_SESSION["LoggedIn"]['ID']);
  ##################
  $query = "SELECT "
    . "`SMTPChecks`.`ID` as `SMTPCheckID`,"
    . "`SMTPChecks`.`CustomerID` as `SMTPCheckCustomerID`,"
    . "`SMTPChecks`.`CriteriaID` as `SMTPCheckCriteriaID`,"
    . "`SMTPChecks`.`LastRun` as `SMTPCheckLastRun`,"
    . "`SMTPChecks`.`Period` as `SMTPCheckPeriod`,"
    . "`SMTPChecks`.`Host` as `SMTPCheckURL`,"
    . "`SMTPChecks`.`TimeOut` as `SMTPCheckTimeOut`,"
    . "`SMTPChecks`.`Port` as `Port`,"
    . "`SMTPChecks`.`UserName` as `UserName`,"
    . "`SMTPChecks`.`From` as `MailFrom`,"
    . "`SMTPChecks`.`To` as `MailTo`,"
    . "`LastSMTPStates`.`MaxID` as `LastStateID`,"
    . "`SMTPStates`.`Status` as `SMTPStatesStatus`,"
    . "`SMTPStates`.`ResultID` as `SMTPStatesResultID`,"
    . "`SMTPStates`.`Problems` as `SMTPStatesProblems`,"
    . "`SMTPResults`.`Time` as `Time`"
    . "FROM `SMTPChecks`"
    . "LEFT JOIN `LastSMTPStates` ON `SMTPChecks`.`ID` = `LastSMTPStates`.`CheckID`"
    . "LEFT JOIN `SMTPStates` ON `LastSMTPStates`.`MaxID` = `SMTPStates`.`ID`"
    . "LEFT JOIN `SMTPResults` ON `SMTPStates`.`ResultID` = `SMTPResults`.`ID`"
    . "WHERE `SMTPChecks`.`CustomerID` = ?";
  
  if(@$RequestURI[1] == 'SMTP/OK') {
    $query .= " AND `SMTPStates`.`Status` = 'OK'";
  }
  
  if(@$RequestURI[1] == 'SMTP/CRITICAL') {
    $query .= " AND `SMTPStates`.`Status` = 'CRITICAL'";
  }
  
  $query .= " ORDER BY `SMTPChecks`.`ID` DESC";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_bind_param($stmt, "d", $_SESSION["LoggedIn"]['ID']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      $Checks[] = $row;
    }
  }
  @$smarty->assign('Checks', $Checks);
  ##################
  $smarty->display("SMTP.tpl");
