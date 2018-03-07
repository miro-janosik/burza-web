<?php
  setlocale(LC_TIME, "en_US.UTF-8");
  #
  $link = mysqli_connect('localhost', 'xxxxxxx', 'xxxxx', 'bbk_burza');
  if (!mysqli_set_charset($link, "utf8")) {
    printf("Error loading character set utf8: %s\n", mysqli_error($link));
  }
  //overim, ci boli zadane hodnoty do oboch policok
  if(!$link){
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
  }
  ######################
  $query = "SELECT * FROM `Users` WHERE `PoslatTeraz` = '1'";
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }
  #################################################
  require '/var/www/bbk-burza/twilio-php-master/Services/Twilio.php';
  // Step 2: set our AccountSid and AuthToken from www.twilio.com/user/account
  $AccountSid = "xxxxxxxxxxxxxxxxxxxxxx";
  $AuthToken = "xxxxxxxxxxxxxxxxxxxxx";
  // Step 3: instantiate a new Twilio Rest Client
  $client = new Services_Twilio($AccountSid, $AuthToken);
  #################################################
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  while($row = mysqli_fetch_assoc($result)){
    $cislo = $row['ID'];
    $TelCislo = $row['Kontakt'];
    if(strlen($TelCislo) < 1) continue;
    $meno = $row['Name'];
    echo "{$cislo}\t\t{$TelCislo}\t";
    #######################################################
    $sms = $client->account->messages->sendMessage("MCBabaKlub", $TelCislo, "Mila predajkyna, burza jesenneho a zimneho detskeho oblecenia sa zacina, blizsie info v emaili. Zastavenie tychto sms mozne mailom babaklub@babaklub.sk");
    // Display a confirmation message on the screen
    echo "SENT!\n";
    #######################################################
    die("\n\n\nKOKOT!!!!!!!\n\n\n");
  }
  echo "\n\nHOTOVO\n\n";
?>
