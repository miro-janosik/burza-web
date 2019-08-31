<?php

  $my_domain = 'mcsrdiecko.sk';
  $my_web = 'http://burza.mcsrdiecko.sk';
  $my_name = 'MC Srdiecko';
  $my_mail = 'burza@'.$my_domain;
  $my_contact = 'Miro Jánošík
MC Srdiečko
Trenčín
<a class="moz-txt-link-abbreviated" href="mailto:'.$my_mail.'">'.$my_mail.'</a>
M +421 908 184 747';

  $Nadpis = "MC Srdiečko - Jesenná burza 2019";
  @$smarty->assign('TypBurzy', "Jesenno-zimná burza");
  @$smarty->assign('TypOsatenia', "jesenno-zimné ošatenie");

  #$Podstata = "Na burze sa predáva jarné a letné detské oblečenie do veľkosti 164 (vrátane), športové a iné potreby.";
  $Podstata = "";
  $Prihadzovanie = "1.9. - 26.9. 20:00";
  $Zber = "28.9. 8:00 - 12:00";
  $Predaj = "28.9. 15:00 - 19:00 a <br/>29.9. 9:00 - 12:00";
  $Vyzdvihnutie = "29.9. 15:00 - 18:00";
  $Likvidacia = "29.9. po 18:00";

  $text_DatabaseProblem = "Problém s databázou...";
  $text_DatabaseProblemPrepare = "Problém s databázou... (prepare)";
  $text_DatabaseProblem_InsertUser = "Vloženie užívateľa do databázy neúspešné!";

  @$smarty->assign('Nadpis', $Nadpis);
  @$smarty->assign('PrihadzovanieDatumy', $Prihadzovanie);
  @$smarty->assign('ZberDatumy', $Zber);
  @$smarty->assign('PredajDatumy', $Predaj);
  @$smarty->assign('VyzdvihnutieDatumy', $Vyzdvihnutie);
  @$smarty->assign('LikvidaciaDatum', $Likvidacia);
  @$smarty->assign('Podstata', $Podstata);
  
  @$smarty->assign('Organizacia', $my_name);

  $Text_GDPR = "
V zmysle Nariadenia Európskeho parlamentu a Rady (EÚ) 2016/679 z 27.04.2016 o ochrane fyzických osôb 
v súvislosti so spracúvaním osobných údajov a o voľnom pohybe týchto údajov a o zrušení smernice 95/46/ES 
a zákona č. 18/2018 Z. z. o ochrane osobných údajov a o zmene a doplnení niektorých zákonov, dávam občianskemu 
združeniu Materské centrum Srdiečko, so sídlom Hviezdoslavova 6, 911 01 Trenčín, IČO: 361 293 48 súhlas 
na spracovanie osobnych udajov. Súhlasím, aby toto združenie spracúvalo takto poskytnuté osobné údaje 
/meno, priezvisko, e-mail, telefónne číslo/, ktoré bližšie charakterizujú moju osobu v súlade s ustanovením 
§ 2 zákona č. 18/2018 Z. z./ v jeho vlastnej evidencii pre účel evidencie predajcov detskej burzy 
oblečenia a obuvy a ich informovanie o burze.";

  @$smarty->assign('GDPR', $Text_GDPR);

?>
