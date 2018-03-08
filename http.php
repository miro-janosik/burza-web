<?php
  setlocale(LC_TIME, "en_US.UTF-8");
  #########################
  date_default_timezone_set("UTC");
  #########################
  $HostnamePort = "http://".$_SERVER['SERVER_NAME']."/";
  #########################
  session_start();
  ###########################
  #$Nahadzovanie = 2; #normalna
  #$Nahadzovanie = 3; #tehotenska
  $Nahadzovanie = false; #vypnute
  ###
  $IDBurzy = 15;
  #$Nadpis = "Burza jarného a letného detského oblečenia 2017";
  $Nadpis = "Burza tehotenského a novorodeneckého oblečenia 2017";
  #$Nadpis = "Burza jesenného a zimného detského oblečenia 2017";
  #$Podstata = "Na burze sa predáva jarné a letné detské oblečenie do veľkosti 164 (vrátane), športové a iné potreby.";
  $Podstata = "Na burze sa predáva tehotenské a novorodenecké oblečenie do veľkosti 74 (vrátane), potreby s tým súvisiace.";
  #$Podstata = "Na burze sa predáva jesenné a zimné detské oblečenie do veľkosti 164 (vrátane), športové a iné potreby.";
  $Prihadzovanie = "09.10. - 15.10.";
  $Zber = "16.10. - 20.10.";
  $Predaj = "23.10. - 03.11.";
  $Vyzdvihnutie = "06.11. - 10.11.";
  $Likvidacia = "13.11.2017";

  require 'db.php';

  ###########################
  date_default_timezone_set('Europe/Bratislava');
  require_once '_smarty/Smarty.class.php';
  $smarty = new Smarty;
	$smarty->caching = false;
	$smarty->force_compile = true;
	#
  @$smarty->assign('Nadpis', $Nadpis);
  @$smarty->assign('PrihadzovanieDatumy', $Prihadzovanie);
  @$smarty->assign('ZberDatumy', $Zber);
  @$smarty->assign('PredajDatumy', $Predaj);
  @$smarty->assign('VyzdvihnutieDatumy', $Vyzdvihnutie);
  @$smarty->assign('LikvidaciaDatum', $Likvidacia);
  @$smarty->assign('Podstata', $Podstata);
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
    header('Location: '.$HostnamePort.'Dashboard');
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
  }else{
    header('Location: '.$HostnamePort.'Dashboard');
  }
  ###################################################################
?>
