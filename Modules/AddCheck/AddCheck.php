<?php
  if(@$_POST['Save']){
    $error = false;
    #Overime hostname
    if(@strlen($_POST['host']) > 0){
      if(!IsValidHostName($_POST['host'])){
        $error[] = "HOSTNAME-BAD";
      }
    }else{
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
      if(@empty($_POST['packetsize']) || @$_POST['packetsize'] < 16 || @$_POST['packetsize'] > 4096){
        $_POST['packetsize'] = 64;
        //die("kundy2");
      }
      if(@empty($_POST['packetcount']) || @$_POST['packetcount'] < 1 || @$_POST['packetcount'] > 20){
        $_POST['packetcount'] = 5;
        //die("kundy3");
      }
              
      # Vlozime vysledky do db
      $query = "INSERT INTO PingChecks SET `CustomerID` = ?, `Target` = ?, `Period` = ?, `Timeout` = ?, `PacketSize` = ?, `PacketCount` = ?";
      $stmt = mysqli_stmt_init($link);
      if(!mysqli_stmt_prepare($stmt, $query)){
        die("moj ty kokot2!\n");
      }
      mysqli_stmt_bind_param($stmt, "isiiii", $_SESSION["LoggedIn"]['ID'], $_POST['host'], $Period, $_POST['timeout'], $_POST['packetsize'], $_POST['packetcount']);
      mysqli_stmt_execute($stmt);
      #Vsetko ok
      header('Location: '.$HostnamePort.'ICMP');
    }
    else{
      print_r($error);
      die();
    }
  }

  
  function IsValidHostName($domain_name){
    return(preg_match("/^(\*\.)?([a-z\d](-*[a-z\d])*)(\.([a-z\d](-*[a-z\d])*))*$/i", $domain_name) //valid chars check
           && preg_match("/^.{1,253}$/", $domain_name) //overall length check
           && preg_match("/^[^\.]{1,63}(\.[^\.]{1,63})*$/", $domain_name)   ); //length of each label
  }

  $smarty->display("AddCheck.tpl");  
?>
