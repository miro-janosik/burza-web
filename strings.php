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

  #$Nadpis = "Burza jarného a letného detského oblečenia 2017";
  $Nadpis = "MC Srdiečko - Jarná burza 2018";

  #$Nadpis = "Burza jesenného a zimného detského oblečenia 2017";
  #$Podstata = "Na burze sa predáva jarné a letné detské oblečenie do veľkosti 164 (vrátane), športové a iné potreby.";
  #$Podstata = "Na burze sa predáva tehotenské a novorodenecké oblečenie do veľkosti 74 (vrátane), potreby s tým súvisiace.";
  #$Podstata = "Na burze sa predáva jesenné a zimné detské oblečenie do veľkosti 164 (vrátane), športové a iné potreby.";
  $Podstata = "";
  $Prihadzovanie = "5.3. - 14.3. 20:00";
  $Zber = "17.3. 8:00 - 12:00";
  $Predaj = "17.3. 15:00 - 19:00 a <br/>18.3. 9:00 - 12:00";
  $Vyzdvihnutie = "18.3. 15:00 - 18:00";
  $Likvidacia = "18.3.2018";

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

?>
