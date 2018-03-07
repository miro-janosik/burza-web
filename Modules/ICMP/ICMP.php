<?php
  if(@$RequestURI[1] == 'ICMP/AddCheck') {
    require_once 'Modules/AddCheck/AddCheck.php';
    die();
  }
  if(@$RequestURI[1] == 'ICMP/View') {
    require_once 'Modules/View/View.php';
    die();
  }
  #####################
  if(@$RequestURI[1] == 'ICMP/Delete') {
    if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'ICMP');
    $query = "DELETE FROM `PingChecks` WHERE `ID` = ? AND `CustomerID` = ?";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("mxxx!");
    }else{
      mysqli_stmt_bind_param($stmt, "ii", $RequestURIsingle[2], $_SESSION["LoggedIn"]['ID']);
      mysqli_stmt_execute($stmt);
    }
    header('Location: '.$HostnamePort.'ICMP');
  }
  ##################### SELECT uid, MAX(id) id FROM foo GROUP BY uid
  $query = "SELECT `Status`,COUNT(*) as count FROM `LastStates` LEFT JOIN `PingStates` ON `LastStates`.`MaxID` = `PingStates`.`ID` GROUP BY `Status`";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("moj ty kokot!");
  }else{
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      if(@$row['Status'] == "1") $ok = $row['count'];
      if(@$row['Status'] == "2") $warn = $row['count'];
      if(@$row['Status'] == "3") $crit = $row['count'];
      $x[] = $row;
    }
    //print_r($x);
    @$smarty->assign('OK', $ok);
    @$smarty->assign('CRIT', $crit);
    @$smarty->assign('WARN', $warn);
  }
  ######################
  #
  $smarty->assign('CustomerID', $_SESSION["LoggedIn"]['ID']);
  ##################
  $query = "SELECT "
    . "`PingChecks`.`ID` as `PingCheckID`,"
    . "`PingChecks`.`CustomerID` as `CustomerID`,"
    . "`PingChecks`.`CriteriaID` as `CriteriaGroupID`,"
    . "`PingChecks`.`LastRun` as `PingCheckLastRun`,"
    . "`PingChecks`.`Period` as `PingCheckPeriod`,"
    . "`PingChecks`.`Timeout` as `PingCheckTimeout`,"
    . "`PingChecks`.`PacketCount` as `PingCheckPacketCount`,"
    . "`PingChecks`.`PacketSize` as `PingCheckPacketSize`,"
    . "`PingChecks`.`Target` as `PingCheckTarget`,"
    . "`LastStates`.`MaxID` as `LastStateID`,"
    . "`PingStates`.`Status` as `PingStatesStatusID`,"
    . "`PingStates`.`ProblemType` as `PingStatesProblemType`,"
    . "`PingStates`.`ResultID` as `PingStatesResultID`,"
    . "`PingStates`.`Problems` as `PingStatesProblems`,"
    . "`PingCriteria`.`StateName` as `ResultingState`,"
    . "`PingResults`.`Time` as `Time`,"
    . "`PingResults`.`PacketLoss` as `PacketLoss`,"
    . "`PingResults`.`Min` as `MinLatency`,"
    . "`PingResults`.`Max` as `MaxLatency`,"
    . "`PingResults`.`Avg` as `AvgLatency`,"
    . "`PingResults`.`mdev` as `MdevLatency`,"
    . "`PingResults`.`LastFrom` as `LastFrom`,"
    . "`PingResults`.`RawResult` as `RawResult`"
    . "FROM `PingChecks`"
    . "LEFT JOIN `LastStates` ON `PingChecks`.`ID` = `LastStates`.`CheckID`"
    . "LEFT JOIN `PingStates` ON `LastStates`.`MaxID` = `PingStates`.`ID`"
    . "LEFT JOIN `PingCriteria` ON `PingStates`.`Status` = `PingCriteria`.`ID`"
    . "LEFT JOIN `PingResults` ON `PingStates`.`ResultID` = `PingResults`.`ID`"
    . "WHERE `PingChecks`.`CustomerID` = ?";
  
  if(@$RequestURI[1] == 'ICMP/OK') {
    $query .= " AND `PingCriteria`.`StateName` = 'OK'";
  }
  
  if(@$RequestURI[1] == 'ICMP/CRITICAL') {
    $query .= " AND `PingCriteria`.`StateName` = 'CRITICAL'";
  }
  
  $query .= " ORDER BY `PingChecks`.`ID` DESC";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("moj ty kokot!");
  }else{
    mysqli_stmt_bind_param($stmt, "d", $_SESSION["LoggedIn"]['ID']);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while($row = mysqli_fetch_assoc($result)){
      $Checks[] = $row;
    }
  }
  //
  //echo "<pre>";print_r($Checks);echo "</pre>";
  //
  @$smarty->assign('Checks', $Checks);
  ##################
  $smarty->display("ICMP.tpl");
?>
