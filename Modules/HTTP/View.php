<?php
  if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'HTTP'); 

  $smarty->assign('CustomerID', $_SESSION["LoggedIn"]['ID']);
  ##################
  $query = "SELECT "
    . "`HTTPChecks`.`ID` as `HTTPCheckID`,"
    . "`HTTPChecks`.`CustomerID` as `HTTPCheckCustomerID`,"
    . "`HTTPChecks`.`CriteriaID` as `HTTPCheckCriteriaID`,"
    . "`HTTPChecks`.`LastRun` as `HTTPCheckLastRun`,"
    . "`HTTPChecks`.`Period` as `HTTPCheckPeriod`,"
    . "`HTTPChecks`.`URL` as `HTTPCheckURL`,"
    . "`HTTPChecks`.`TimeOut` as `HTTPCheckTimeOut`,"
    . "`HTTPChecks`.`DRC` as `HTTPCheckDRC`,"
    . "`HTTPChecks`.`SearchString` as `HTTPSearchString`,"
    . "`HTTPStates`.`Status` as `HTTPStatesStatus`,"
    . "`HTTPStates`.`ResultID` as `HTTPStatesResultID`,"
    . "`HTTPStates`.`Problems` as `HTTPStatesProblems`,"
    . "`HTTPResults`.`Time` as `Time`,"
    . "`HTTPResults`.`ResponseCode` as `ResponseCode`,"
    . "`HTTPResults`.`LastFrom` as `LastFrom`,"
    . "`HTTPResults`.`RequestTook` as `RequestTook`,"
    . "`HTTPResults`.`RawResult` as `RawResult`"
    . "FROM `HTTPChecks`"
    . "LEFT JOIN `HTTPStates` ON `HTTPChecks`.`ID` = `HTTPStates`.`CheckID`"
    . "LEFT JOIN `HTTPResults` ON `HTTPStates`.`ResultID` = `HTTPResults`.`ID`"
    . "WHERE (`HTTPChecks`.`CustomerID` = ?) AND (`HTTPChecks`.`ID` = ?)"
    . "ORDER BY `HTTPStates`.`ID` DESC LIMIT 30";
  
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
    . "`HTTPResults`.`Time` as `Time`,"
    . "`HTTPResults`.`ResponseCode` as `ResponseCode`,"
    . "`HTTPResults`.`LastFrom` as `LastFrom`,"
    . "`HTTPResults`.`Error` as `Error`,"
    . "`HTTPResults`.`RequestTook` as `RequestTook`,"
    . "`HTTPResults`.`RawResult` as `RawResult`"
    . "FROM `HTTPResults`"
    . "WHERE (`HTTPResults`.`CustomerID` = ?) AND (`HTTPResults`.`CheckID` = ?)"
    . "ORDER BY `HTTPResults`.`ID` DESC LIMIT 100";
  
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
  $smarty->display("ViewHTTP.tpl");
?>
