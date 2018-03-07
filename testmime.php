<?php
	ini_set("mbstring.language", "Neutral");
	ini_set("mbstring.internal_encoding", "UTF-8");
	ini_set("mbstring.encoding_translation", "On");
	ini_set("mbstring.http_input", "auto");
	ini_set("mbstring.http_output", "UTF-8");
	ini_set("mbstring.detect_order", "auto");
	ini_set("mbstring.substitute_character", "none");
	ini_set("default_charset", "UTF-8");
	ini_set("mbstring.func_overload", 7);
  #
	setlocale(LC_TIME, "en_US.UTF-8");
  #
  $link = mysqli_connect('localhost', 'xxxxx', 'xxxxx', 'bbk_burza');
	if (!mysqli_set_charset($link, "utf8")) {
		printf("Error loading character set utf8: %s\n", mysqli_error($link));
	}
  //overim, ci boli zadane hodnoty do oboch policok
  if(!$link){
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
  }
  ##############################################################################
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
  #########################################################################################################
  $query = "SELECT * FROM `Users`";
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
		mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $i = 0;
    while($row = mysqli_fetch_assoc($result)){
      $i++;
      $link = 'http://burza.babaklub.sk/Login/'.$row['LoginStr'];
      $cislo = $row['ID'];
      $mail = $row['Mail'];
      $meno = $row['Name'];
      echo "$i, {$mail}, {$cislo}\n";
      $linka = "<a href=\"".$link."\">LINKA</a>";
      $subject = $Nadpis;
      #######################################################
$headers  = 'From: <burza@babaklub.sk>'."\n";
$headers .= 'Reply-To: <burza@babaklub.sk>'."\n";
$headers .= 'MIME-Version: 1.0
In-Reply-To: <0378099B-A14C-4C24-8FC1-A1A473E34C1D@Szabados.sk>
Content-Type: multipart/alternative;
 boundary="------------040709010107000502070402"

This is a multi-part message in MIME format.
--------------040709010107000502070402
Content-Type: text/plain; charset=utf-8; format=flowed
Content-Transfer-Encoding: 8bit

Milá *'.$meno.'*,

opäť tu máme novú burzu, už sa viac netreba 
registrovať, registrácia zostáva z minulej burzy, rovnako ako Vaše číslo 
*'.$cislo.'* a linka na zoznam predávaných vecí *'.$link.'*. Stačí sa pustiť do 
vypĺňania, pridávať do zoznamu bude možné *'.$Prihadzovanie.' (vrátane)*, resp. do 
momentu zablokovania. *'.$Zber.'* nám vecičky prinesiete a 
olepíte ich nami vytlačenými štítkami.

Ešte pripomíname a prosíme o dodržanie sezóny a pri opätovnej ponuke 
kúskov z minulého roka o prehodnotenie ceny, pretože čo sa nepredalo 
vtedy, nepredá sa ani teraz. Preto ani recyklovanie štítkov nepripadá do 
úvahy, s nepredaným tovarom máme totiž v skutočnosti najviac práce.

Nakupovať sa bude dať v čase herne *'.$Predaj.'*, ak by ste mali 
záujem prispieť rukou k dielu a zúčastniť sa predpredaja počas príprav 
burzy, ozvite sa nám.

Nezabudnite o našej burze povedať aj Vašim známym, podporíte tým 
úspešnosť predaja Vašich vecičiek.


S pozdravom tím dobrovoľníčok

MC Baba klub

--------------040709010107000502070402
Content-Type: multipart/related;
 boundary="------------020509030109040709090202"


--------------020509030109040709090202
Content-Type: text/html; charset=utf-8
Content-Transfer-Encoding: 8bit

<html>
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
  </head>
  <body text="#000000" bgcolor="#FFFFFF">
    <div align="justify">Milá '.$meno.', <br>
      <br>
      opäť tu máme novú burzu, už sa viac netreba
      registrovať, registrácia zostáva z minulej burzy, rovnako ako Vaše
      číslo <b>'.$cislo.'</b> a <b>'.$linka.'</b> na zoznam predávaných vecí.
      Stačí sa pustiť do vypĺňania, pridávať do zoznamu bude možné <b>'.$Prihadzovanie.' (vrátane)</b>,
      resp. do momentu zablokovania. <b>'.$Zber.'</b> nám vecičky prinesiete a olepíte ich nami vytlačenými
      štítkami.<br>
      <br>
      Ešte pripomíname a prosíme o dodržanie sezóny a pri opätovnej
      ponuke kúskov z minulého roka o prehodnotenie ceny, pretože čo sa
      nepredalo vtedy, nepredá sa ani teraz. Preto ani recyklovanie
      štítkov nepripadá do úvahy, s nepredaným tovarom máme totiž v
      skutočnosti najviac práce.<br>
      <br>
      Nakupovať sa bude dať v čase herne <b>'.$Predaj.'</b>, ak
      by ste mali záujem prispieť rukou k dielu a zúčastniť sa
      predpredaja počas príprav burzy, ozvite sa nám.<br>
      <br>
      Nezabudnite o našej burze povedať aj Vašim známym, podporíte tým
      úspešnosť
      predaja Vašich vecičiek.<br>
      <br>
      <br>
      S pozdravom tím dobrovoľníčok<br>
    </div>
    <div class="moz-forward-container">
      <br>
    </div>
    <img alt="MC Baba klub"
      src="cid:part1.00010407.04010004@BabaKlub.sk" height="49"
      width="225">
  </body>
</html>

--------------020509030109040709090202
Content-Type: image/png;
 name="babalogo3.png"
Content-Transfer-Encoding: base64
Content-ID: <part1.00010407.04010004@BabaKlub.sk>
Content-Disposition: inline;
 filename="babalogo3.png"

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
3t9VZf5J5f//4rPoISFbIfEAAAAASUVORK5CYII=
--------------020509030109040709090202--

--------------040709010107000502070402--
';
      #mail($mail, $subject, '', $headers);
      #######################################################
    }
    mail("rs@lomnido.com", $subject, '', $headers);
    echo "\nHOTOVO\n";
	}
