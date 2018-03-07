<?php
  #
  $query = "SELECT `Status`,COUNT(*) as count FROM `LastHTTPStates` LEFT JOIN `HTTPStates` ON `LastHTTPStates`.`MaxID` = `HTTPStates`.`ID` GROUP BY `Status`";
  
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
  if(@$RequestURI[1] == 'HTTP/AddCheck') {
    require_once 'Modules/HTTP/AddCheck.php';
    die();
  }
  if(@$RequestURI[1] == 'HTTP/View') {
    require_once 'Modules/HTTP/View.php';
    die();
  }
  #####################
  if(@$RequestURI[1] == 'HTTP/Delete') {
    if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'HTTP');
    $query = "DELETE FROM `HTTPChecks` WHERE `ID` = ? AND `CustomerID` = ?";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("mxxx!");
    }else{
      mysqli_stmt_bind_param($stmt, "ii", $RequestURIsingle[2], $_SESSION["LoggedIn"]['ID']);
      mysqli_stmt_execute($stmt);
    }
    header('Location: '.$HostnamePort.'HTTP');
  }
  #
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
    . "`LastHTTPStates`.`MaxID` as `LastStateID`,"
    . "`HTTPStates`.`Status` as `HTTPStatesStatus`,"
    . "`HTTPStates`.`ResultID` as `HTTPStatesResultID`,"
    . "`HTTPStates`.`Problems` as `HTTPStatesProblems`,"
    . "`HTTPResults`.`Time` as `Time`,"
    . "`HTTPResults`.`ResponseCode` as `ResponseCode`,"
    . "`HTTPResults`.`LastFrom` as `LastFrom`,"
    . "`HTTPResults`.`RequestTook` as `RequestTook`,"
    . "`HTTPResults`.`RawResult` as `RawResult`"
    . "FROM `HTTPChecks`"
    . "LEFT JOIN `LastHTTPStates` ON `HTTPChecks`.`ID` = `LastHTTPStates`.`CheckID`"
    . "LEFT JOIN `HTTPStates` ON `LastHTTPStates`.`MaxID` = `HTTPStates`.`ID`"
    . "LEFT JOIN `HTTPResults` ON `HTTPStates`.`ResultID` = `HTTPResults`.`ID`"
    . "WHERE `HTTPChecks`.`CustomerID` = ?";
  
  if(@$RequestURI[1] == 'HTTP/OK') {
    $query .= " AND `HTTPStates`.`Status` = 'OK'";
  }
  
  if(@$RequestURI[1] == 'HTTP/CRITICAL') {
    $query .= " AND `HTTPStates`.`Status` = 'CRITICAL'";
  }
  
  $query .= " ORDER BY `HTTPChecks`.`ID` DESC";
  
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
  $smarty->display("HTTP.tpl");
