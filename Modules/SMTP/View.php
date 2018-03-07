<?php
  if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'SMTP'); 

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
    . "`SMTPStates`.`Status` as `SMTPStatesStatus`,"
    . "`SMTPStates`.`ResultID` as `SMTPStatesResultID`,"
    . "`SMTPStates`.`Problems` as `SMTPStatesProblems`,"
    . "`SMTPResults`.`Time` as `Time`"
    . "FROM `SMTPChecks`"
    . "LEFT JOIN `SMTPStates` ON `SMTPChecks`.`ID` = `SMTPStates`.`CheckID`"
    . "LEFT JOIN `SMTPResults` ON `SMTPStates`.`ResultID` = `SMTPResults`.`ID`"
    . "WHERE (`SMTPChecks`.`CustomerID` = ?) AND (`SMTPChecks`.`ID` = ?)"
    . "ORDER BY `SMTPStates`.`ID` DESC LIMIT 30";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("fffffff!");
  }else{
    mysqli_stmt_bind_param($stmt, "di", $_SESSION["LoggedIn"]['ID'], $RequestURIsingle[2]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      $Checks1[] = $row;
    }
  }
  //
  //echo "<pre>";print_r($Checks);echo "</pre>";
  //
  @$smarty->assign('Checks1', $Checks1);
  ##################
  ##################
  $query = "SELECT "
    . "`SMTPResults`.`Time` as `Time`,"
    . "`SMTPResults`.`Error` as `Error`"
    . "FROM `SMTPResults`"
    . "WHERE (`SMTPResults`.`CustomerID` = ?) AND (`SMTPResults`.`CheckID` = ?)"
    . "ORDER BY `SMTPResults`.`ID` DESC LIMIT 100";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("gggggggg!");
  }else{
    mysqli_stmt_bind_param($stmt, "di", $_SESSION["LoggedIn"]['ID'], $RequestURIsingle[2]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      $Checks2[] = $row;
    }
  }
  //
  //echo "<pre>";print_r($Checks);echo "</pre>";
  //
  @$smarty->assign('Checks2', $Checks2);
  ##################
  $smarty->display("ViewSMTP.tpl");
?>
