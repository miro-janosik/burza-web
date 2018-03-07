<?php
  if(@empty($RequestURIsingle[1])){
    $smarty->display("Login.tpl");
  }else{
    //
    $user = $RequestURIsingle[1];
    $query = "SELECT * FROM Users WHERE `LoginStr` = ?";
    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
      die("Databaza na to jebe...");
    }else{
      mysqli_stmt_bind_param($stmt, "s", $user);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        #print_r($row); die();
        $_SESSION["LoggedIn"] = $row;
				$_SESSION["Pridaj"] = false;
        header('Location: '.$HostnamePort.'Dashboard');
        die();
      }
      unset($_SESSION["LoggedIn"]);
      session_destroy();
      header('Location: '.$HostnamePort.'Login');
    }
  }  
  die();
?>