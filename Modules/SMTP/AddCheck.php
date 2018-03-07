<?php
  #
  if(@$_POST['Save']){
    //print_r($_POST);
    $error = false;
    #Overime hostname
    if(@strlen($_POST['host']) < 5){
      $error[] = "HOSTNAME-EMPTY";
    }
    if(@$_POST['interval'] < 1 || @$_POST['interval'] > 8){
      $error[] = "INTERVA-BAD";
    }
    if(@strlen($_POST['username']) < 1){
      $error[] = "USERNAME-EMPTY";
    }
    if(@strlen($_POST['host']) < 1){
      $error[] = "PASSWORD-EMPTY";
    }
    if(@$_POST['port'] < 1 || @$_POST['interval'] > 65535){
      $error[] = "PORT-BAD";
    }
    if(!strpos(@$_POST['mailfrom'], '@')){
      $error[] = "MAILFROM-BAD";
    }
    if(!strpos(@$_POST['mailto'], '@')){
      $error[] = "MAILTO-BAD";
    }
    
    #Ak nebol error
    if(@!$error){
      
      if($_POST['interval'] == 1) $Period = 5;
      if($_POST['interval'] == 2) $Period = 10;
      if($_POST['interval'] == 3) $Period = 30;
      if($_POST['interval'] == 4) $Period = 60;
      if($_POST['interval'] == 5) $Period = 300;
      if($_POST['interval'] == 6) $Period = 600;
      if($_POST['interval'] == 7) $Period = 900;
      if($_POST['interval'] == 8) $Period = 1800;
      
      if(@empty($_POST['timeout']) || @$_POST['timeout'] < 5 || @$_POST['timeout'] > 120){
        $_POST['timeout'] = 30;
        //die("kundy1");
      }
      # Vlozime vysledky do db
      $query = "INSERT INTO `SMTPChecks` SET `CustomerID` = ?, `Host` = ?, `Period` = ?, `Timeout` = ?, `Port` = ?, `UserName` = ?, `Password` = ?, `From` = ?, `To` = ?";
      $stmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($stmt, $query)){
        die("moj ty kokot2!\n");
      }
      mysqli_stmt_bind_param($stmt, "isiiissss", $_SESSION["LoggedIn"]['ID'], $_POST['host'], $Period, $_POST['timeout'], $_POST['port'], $_POST['username'], $_POST['password'], $_POST['mailfrom'], $_POST['mailto']);
      mysqli_stmt_execute($stmt);
      #Vsetko ok
      header('Location: '.$HostnamePort.'SMTP');
    }
    else{
      print_r($error);
      die();
    }
  }
  
  $smarty->display("AddSMTPCheck.tpl");  
?>
