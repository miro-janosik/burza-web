<?php
  //echo "<pre>"; print_r($RequestURIsingle); echo "</pre><br><br>";
  //2 $RequestURIsingle[2]
  #
  //die($RequestURIsingle[2]);

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

  if(@empty($RequestURIsingle[2]) || @!is_numeric($RequestURIsingle[2])) header('Location: '.$HostnamePort.'ICMP'); 

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
    . "LEFT JOIN `PingStates` ON `PingChecks`.`ID` = `PingStates`.`CheckID`"
    . "LEFT JOIN `PingCriteria` ON `PingStates`.`Status` = `PingCriteria`.`ID`"
    . "LEFT JOIN `PingResults` ON `PingStates`.`ResultID` = `PingResults`.`ID`"
    . "WHERE (`PingChecks`.`CustomerID` = ?) AND (`PingChecks`.`ID` = ?)"
    . "ORDER BY `PingStates`.`ID` DESC LIMIT 30";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("moj ty kokot!");
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
    . "`PingResults`.`Time` as `Time`,"
    . "`PingResults`.`PacketLoss` as `PacketLoss`,"
    . "`PingResults`.`Min` as `MinLatency`,"
    . "`PingResults`.`Max` as `MaxLatency`,"
    . "`PingResults`.`Avg` as `AvgLatency`,"
    . "`PingResults`.`mdev` as `MdevLatency`,"
    . "`PingResults`.`LastFrom` as `LastFrom`,"
    . "`PingResults`.`Error` as `Error`,"
    . "`PingResults`.`RawResult` as `RawResult`"
    . "FROM `PingResults`"
    . "WHERE (`PingResults`.`CustomerID` = ?) AND (`PingResults`.`CheckID` = ?)"
    . "ORDER BY `PingResults`.`ID` DESC LIMIT 100";
  
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("moj ty kokot!");
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
  $smarty->display("ViewICMP.tpl");
?>
