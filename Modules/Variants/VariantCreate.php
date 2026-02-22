<?php
    # Volane z Varianty.tpl
    # Form na /VariantCreate odosiela id [change_to_variant]

	$id = htmlspecialchars($_SESSION["LoggedIn"]['ID']);
	if (empty($id))
	{
		die("SaveUser: nie je LoggedIn ID");
	}

    # Idem pre uzivatela zmenit Variant
    # Existuje viacero rovnakych uzivatelov (rovnake meno a kod)
    #  s rozdielnym UserID a VariantName, a iba jeden je VariantActive=True
    # Preto zmenim uzivatelov s tymto kodom tak aby bol aktivny ten spravny

    if (empty($_POST['variant_name'])) {
        die("VariantCreate Parameter nenastaveny!");
    }

    $variant_name = $_POST['variant_name'];
    
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

    ##############################################################################
    echo "Zistujem varianty uzivatela<br><br>";

    $loginstr = $_SESSION["LoggedIn"]['LoginStr'];
    $query = "SELECT * FROM Users WHERE `LoginStr` = ?";

    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query))
    {
        die("Problem s DB: select users variant create");
    }

    mysqli_stmt_bind_param($stmt, "s", $loginstr);
    if(!mysqli_stmt_execute($stmt))
    {
        die("Problem s DB: select users variant create");
    }
    $rows = dbGetAllRowsArrayOfArrays($stmt);
    foreach($rows AS $row) {
        if($row['VariantName'] == $variant_name) {

            @$smarty->assign('VariantOutputMsg', "Variant '" . htmlspecialchars($variant_name) . "' uz existuje!");
            require_once 'Modules/Dashboard/Dashboard.php';
            header('Location: '.$HostnamePort.'Dashboard');
            die();
        }
    }

    ##############################################################################
    echo "Vytvaram variant... '". htmlspecialchars($variant_name) ."'<br><br>";

    # It is a copy of the user, with new VariantName, and VariantActive = FALSE, so that it does not interfere with the current session
    $query = "INSERT INTO `Users`(`LoginStr`, `Name`, `Mail`, `Kontakt`, `info`, `VariantName`, `VariantActive`) ".
             "SELECT `LoginStr`, `Name`, `Mail`, `Kontakt`, `info`, ?, FALSE FROM `Users` WHERE `LoginStr` = ?";

    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
        die("mysqli_stmt_prepare error vytvorenie variantu...");
    }
    
    mysqli_stmt_bind_param($stmt, "ss", $variant_name, $loginstr);
    if(!mysqli_stmt_execute($stmt))
    {
        die("Problem s DB: variant create - insert user");
    }
    $new_user_id = mysqli_insert_id($link);

    # Copy all items from the current user to the new variant
    $query = "INSERT INTO `Polozky` ( `UserID`, `Cislo`, `Cena`, `Druh`, `Popis`, `Velkost`, `IDBurzy`, `Predane`, `Pridane`) ".
             "SELECT ?, `Cislo`, `Cena`, `Druh`, `Popis`, `Velkost`, `IDBurzy`, `Predane`, `Pridane` FROM `Polozky` WHERE `UserID` = ?";

    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
        die("mysqli_stmt_prepare error kopirovanie poloziek...");
    }
    mysqli_stmt_bind_param($stmt, "ii", $new_user_id, $_SESSION["LoggedIn"]['ID']);
    if(!mysqli_stmt_execute($stmt))
    {
        die("Problem s DB: variant create - copy items");
    }

    echo "Variant vytvoreny, prekopirovane!<br><br>";

    ##############################################################################
    # aby som mohol pouzit VariantChange.php a nemusim menit kod
    $_POST['change_to_variant'] = $variant_name; 
    require_once 'Modules/Variants/VariantChange.php';

?>
