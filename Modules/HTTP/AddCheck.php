<?php
  #
  if(@$_POST['Save']){
    //print_r($_POST);
    $error = false;
    #Overime hostname
    if(@strlen($_POST['host']) < 11){
      $error[] = "HOSTNAME-EMPTY";
    }
    if(@$_POST['interval'] < 1 || @$_POST['interval'] > 8){
      $error[] = "INTERVA-BAD";
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
      if(@empty($_POST['responsecode']) || @$_POST['responsecode'] < 100 || @$_POST['responsecode'] > 599){
        $_POST['responsecode'] = NULL;
        //die("kundy3");
      }
      if(@strlen($_POST['searchstring']) < 1) $_POST['searchstring'] = NULL;
              
      # Vlozime vysledky do db
      $query = "INSERT INTO `HTTPChecks` SET `CustomerID` = ?, `URL` = ?, `Period` = ?, `Timeout` = ?, `DRC` = ?, `SearchString` = ?";
      $stmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($stmt, $query)){
        die("moj ty kokot2!\n");
      }
      mysqli_stmt_bind_param($stmt, "isiiis", $_SESSION["LoggedIn"]['ID'], $_POST['host'], $Period, $_POST['timeout'], $_POST['responsecode'], $_POST['searchstring']);
      mysqli_stmt_execute($stmt);
      #Vsetko ok
      header('Location: '.$HostnamePort.'HTTP');
    }
    else{
      print_r($error);
      die();
    }
  }
  
  $smarty->display("AddHTTPCheck.tpl");  
?>
