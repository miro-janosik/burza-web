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

	setlocale(LC_TIME, "en_US.UTF-8");
	
	if(@$_SESSION["LoggedIn"]['ID'] != 0){
		header('Location: http://piv.pivpiv.dk/');
		die();
	}
	
?>
<h3>Pridanie</h3>
<form role="form" action="/Linky" method="post">
	Meno: <input name="Meno" maxlength="40" type="text"><br>
	eMail: <input name="Mail" maxlength="255" type="text"><br>
	Tel. c.: <input name="Tel" maxlength="40" type="text"><br>
	Provizia: <input type="radio" name="provizia" value="1" checked>ANO <input type="radio" name="provizia" value="0">NIE<br>
	<br>
	<input name="pridaj" type="submit" value="pridaj">
</form>


<?php
	
	#Prv pridame...
	if(@$_POST['pridaj']){
		
		if(strlen(@$_POST['Meno']) < 2){
			die("NEBOLO VYPLNENE <b>MENO</b>! Mozes stlacit BACK v browsery...");
		}
		
		if (!filter_var(@$_POST['Mail'], FILTER_VALIDATE_EMAIL)) {
			die("ZLE ZADANY <b>MAIL</b>! Mozes stlacit BACK v browsery...");
		}
		
		if(@$_POST['provizia'] != '1' && @$_POST['provizia'] != '0'){
			die("Vsetko v poriadku?!");
		}
		
		#Tu sme ok
		
		$Meno = htmlspecialchars($_POST['Meno']);
		$Mail = htmlspecialchars($_POST['Mail']);
		$Tel = htmlspecialchars(@$_POST['Tel']);
		$Provizia = $_POST['provizia'];
		#
		$LoginStr = substr(hash('sha512', "rnd" . rand(0, 9999) . "mtime" . microtime(true) . "time" . time()), 0 , 100);
		#
		//echo "Meno: $Meno<br>Mail: $Mail<br>Tel: $Tel<br>Provizia: $Provizia<Br><Br>";
		#		
		$query = "INSERT INTO `Users` SET `LoginStr` = ?, `Name` = ?, `Mail` = ?, `Kontakt` = ?, `Provizia` = ?";
		$stmt = mysqli_stmt_init($link);
		if(!mysqli_stmt_prepare($stmt, $query)){
			die("moj ty kokot2!\n");
		}
		mysqli_stmt_bind_param($stmt, "ssssi", $LoginStr, $Meno, $Mail, $Tel, $Provizia);
		mysqli_stmt_execute($stmt);
		$ID = mysqli_stmt_insert_id($stmt);
		#die("<b>ID: $ID</b>");
		$LoginStr = $my_web."/Login/".$LoginStr;
		

		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		// Additional headers
		$headers .= 'From: '.$my_name.' - Burza <'.$my_mail.'>' . "\r\n";
		$headers .= 'Bcc: '.$my_mail."\r\n";
		#
		$to      = $Mail;
		#
		$subject = 'Registrácia na burzu';
		#
		$message = '
<html>
  <head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
  </head>
  <body text="#000000" bgcolor="#FFFFFF">
    Dobrý deň,<br>
    <br>
    Vaše registračné číslo je <b>'.$ID.'</b>, pravidlá burzy sú k nahliadnutiu na stránke a k podpísaniu u nás.
Zoznam máme online, stačí kliknúť na uvedenú linku a môžte začať
zadávať jednotlivé položky pomocou zeleného tlačítka "Pridaj".
K zoznamu sa môžte kedykoľvek prostredníctvom linky vrátiť, položky tam zostanú,
nie je nutné zoznam spísať na jedno posedenie. V prípade akýchkoľvek nejasností ma neváhajte kontaktovať.<br>
    <br>
Veci potom môžte fyzicky priniesť v na to určenom týždni v čase herne, my pre Vás už budeme mať vytlačené štítky,
ktorými si predávané vecičky označíte. Nezabudnite o burze povedať aj Vašim známym, zvýšite tým pravdepodobnosť
úspešného predaja Vašich vecičiek.<br><br>
    Pre vyplnenie zoznamu predávaných vecičiek kliknite sem:
		<a href="'.$LoginStr.'">'.$LoginStr.'</a>
		<br>
    <br>
    <br>
    S pozdravom<br>
    <br>
    <div class="moz-signature">-- <br>
      <style type="text/css">
	<!--
		p { color: #000000 }
		pre { color: #000000 }
		pre.cjk { font-family: "Droid Sans Fallback", monospace }
	-->
	</style>
<pre class="western"><?php echo $my_contact; ?></pre>
<pre class="western" style="margin-bottom: 0.2in"></pre>
    </div>
  </body>
</html>';
		mail($to, $subject, $message, $headers);
		
		#
		header('Location: '.$HostnamePort.'Linky');
		die();

	}
	
	$query = "SELECT * FROM `Users` WHERE CHAR_LENGTH(`Name`) > 1 ORDER BY `ID` DESC";
  $stmt = mysqli_stmt_init($link);
  if(!mysqli_stmt_prepare($stmt, $query)){
    die("Nieeeeeeeeeeeee...");
  }else{
    mysqli_stmt_execute($stmt);
		$rows = dbGetAllRowsArrayOfArrays($stmt);
		echo '<table border="0" cellspacing="10"><tr><th>ID</th><th>Name</th><th>Mail</th><th>Tel</th><th>Provizia</th><th>Login</th><th>Zoznam</th>';
		foreach($rows AS $row) {
			echo "<tr><td>";
			echo $row['ID'];
			echo "</td><td>";
			echo $row['Name'];
			echo "</td><td>";
			echo $row['Mail'];
			echo "</td><td>";
			echo $row['Kontakt'];
			echo "</td><td>";
			echo $row['Provizia'];
			echo "</td><td>";
			echo '<a href="http://burza.babaklub.sk/Login/'.$row['LoginStr'].'">http://burza.babaklub.sk/Login/'.$row['LoginStr'].'</a>';
			echo "</td><td>";
			echo '<a href="http://burza.babaklub.sk/Zoznam/'.$row['ID'].'">ZOZNAM</a>';
			echo "</td></tr>";
    }
		echo "</table>";
  }
?>
