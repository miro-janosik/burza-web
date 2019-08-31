<?php
  setlocale(LC_TIME, "en_US.UTF-8");
  #########################
  date_default_timezone_set("UTC");
  #########################
  $HostnamePort = "http://".$_SERVER['SERVER_NAME']."/";
  #########################
  session_start();
  ###########################
  $Nahadzovanie = 2; #normalna
  #$Nahadzovanie = 3; #tehotenska
  # $Nahadzovanie = 0; #vypnute
  ###
  $IDBurzy = 15;

  require 'db.php';

  ###########################
  date_default_timezone_set('Europe/Bratislava');

require_once '_smarty/Smarty.class.php';
  $smarty = new Smarty;
	$smarty->caching = false;
	$smarty->force_compile = true;

require_once 'strings.php';
	
//	$debug = 'yes'; if (isset($debug)) @$smarty->assign('debug', $debug);

  //pripojim sa do db
  $link = mysqli_connect('127.0.0.1', 'XXXX', 'XXXX', 'bbk_burza');
	if (!mysqli_set_charset($link, "utf8")) {
		printf("Error loading character set utf8: %s\n", mysqli_error($link));
	}
  //overim, ci boli zadane hodnoty do oboch policok
  if(!$link){
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
  }
  //
  // Pozrieme kde sme
  //
  #Odstranim posledny slash a posekam cez ostatne
  $RequestURI = explode('/', trim($_SERVER["REQUEST_URI"], "/"));
  $RequestURIsingle = explode('/', trim($_SERVER["REQUEST_URI"], "/"));
  foreach($RequestURI as $key => $value){
    if($key > 0) $RequestURI[$key] = $RequestURI[$key-1].'/'.$RequestURI[$key];
  }
  unset($value);

  if (isset($debug))
	{
echo "<!-- Debug:";
if (count($RequestURI) > 0) echo " RequestURI[0]: " . $RequestURI[0] ;
if (count($RequestURI) > 1) echo " RequestURI[1]: " . $RequestURI[1] ;
if (count($RequestURI) > 2) echo " RequestURI[2]: " . $RequestURI[2] ;
echo "-->";
	}

  //print_r($RequestURI);
  //die();
  ##################################################
  #SPECIALITA - TERMINAL
  # TREBA OVERIT CI SOM LOCALHOST
  if($RequestURI[0] == 'Terminal'){
    if($_SERVER['SERVER_NAME'] != "localhost") die('To viiiis...'); 
    require_once 'Modules/Terminal.php';
    die();
  }
  ##################################################
  #Logout je logicky prva mozna akcia
  if($RequestURI[0] == 'Logout'){
    unset($_SESSION["LoggedIn"]);
    session_destroy();
    header('Location: '.$HostnamePort.'Login');
    die();
  }
  ##################################################
  #Volna sekcia
  if($RequestURI[0] == 'Rules') {
    require_once 'Modules/Rules.php';
  }
  if($RequestURI[0] == 'Oprava') {
    require_once 'Modules/Oprava.php';
		die();
  }

  if($RequestURI[0] == 'LoginCode'){
    require_once 'Modules/Login/LoginCode.php';
    die();
  }

  if($RequestURI[0] == 'ConfirmDeleteItems'){
    require_once 'Modules/ConfirmDeleteItems.php';
    die();
  }

  ##################################################
  # Ak nie je nikto prihlaseny a nie sme na /login, skocime tam
  if(@!$_SESSION["LoggedIn"] && $RequestURI[0] != 'Login'){
    header('Location: '.$HostnamePort.'Login');
    die();
  }
  ##################################################
  # Tu uz musime byt prihlaseny, alebo sme na /Login
  if($RequestURI[0] == 'Login'){
    require_once 'Modules/Login/Login.php';
  }elseif($RequestURI[0] == 'Dashboard'){
    require_once 'Modules/Dashboard/Dashboard.php';
  }elseif($RequestURI[0] == 'Delete'){
    if($Nahadzovanie) require_once 'Modules/Dashboard/Dashboard.php';
    header('Location: '.$HostnamePort.'Dashboard');
  }elseif($RequestURI[0] == 'Edit'){
    if($Nahadzovanie) require_once 'Modules/Dashboard/Dashboard.php';
    # Redirect nie, ukaz Dashboard aj s Edit fieldom cez include. header('Location: '.$HostnamePort.'Dashboard');
  }elseif($RequestURI[0] == 'Pridaj'){
    if($Nahadzovanie) require_once 'Modules/Dashboard/Dashboard.php';
    header('Location: '.$HostnamePort.'Dashboard');
  }elseif($RequestURI[0] == 'Predane'){
    ########## Nepouzivat require_once 'Modules/Dashboard/Dashboard.php';
  }elseif($RequestURI[0] == 'Skry'){
    require_once 'Modules/Dashboard/Dashboard.php';
  }elseif($RequestURI[0] == 'Linky'){
    require_once 'Modules/Linky.php';
  }elseif($RequestURI[0] == 'Zoznam'){
    require_once 'Modules/Zoznam.php';
  }elseif($RequestURI[0] == 'Stitky'){
    require_once 'Modules/Stitky.php';
  }elseif($RequestURI[0] == 'SaveUser'){
    require_once 'Modules/SaveUser.php';
  }else{
    header('Location: '.$HostnamePort.'Dashboard');
  }
  ###################################################################
?>
