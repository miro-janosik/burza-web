ZOZNAM CHECKOV

        <p>Checks... Neskor<br /><br /></p>
        {if isset($Checks)}
          <ul>
          {foreach from=$Checks key=k item=v}
            <li><a href="/View/ICMP/{$v['ID']}">{$v["Target"]}</a></li>
          {/foreach}
          </ul>
        {/if}

        
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
    . "WHERE (`PingStates`.`ID` = (SELECT max(`ID`) FROM `PingStates` WHERE `CheckID` = `PingChecks`.`ID`)) AND (`PingChecks`.`CustomerID` = ?)"
    . "ORDER BY `PingChecks`.`ID` DESC";