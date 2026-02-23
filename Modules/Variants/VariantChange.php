<?php
    # Volane z Varianty.tpl
    # Form na /VariantChange odosiela id [change_to_variant]

	$id = htmlspecialchars($_SESSION["LoggedIn"]['ID']);
	if (empty($id))
	{
		die("SaveUser: nie je LoggedIn ID");
	}

    # Idem pre uzivatela zmenit Variant
    # Existuje viacero rovnakych uzivatelov (rovnake meno a kod)
    #  s rozdielnym UserID a VariantName, a iba jeden je VariantActive=True
    # Preto zmenim uzivatelov s tymto kodom tak aby bol aktivny ten spravny

    if (empty($_POST['change_to_variant'])) {
        die("VariantChange Parameter nenastaveny!");
    }

    $variant_name = $_POST['change_to_variant'];
    
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
        die($text_DatabaseProblem);
    }

    $next_user_row = null;
    mysqli_stmt_bind_param($stmt, "s", $loginstr);
    if (!mysqli_stmt_execute($stmt))
    {
        die("DB Error: select users for variants!");
    }

    $variantNames = array();
    $rows = dbGetAllRowsArrayOfArrays($stmt);
    foreach($rows AS $row) {
        if($row['VariantName'] == $variant_name) {
            $next_user_row = $row;
            echo "Variant: ". htmlspecialchars($row['VariantName']) . " (ID: " . $row['ID'] . ")<br>";
        }

        array_push($variantNames, $row['VariantName']);
    }

    if ($next_user_row == null) {
        die("Nenajdeny variant '" . htmlspecialchars($variant_name) . "'");
    }

    ##############################################################################
    echo "Zmena varianty... na '". htmlspecialchars($variant_name) ."'<br><br>";
    
    $query = "UPDATE `Users` SET `VariantActive` = CASE WHEN `VariantName` = ? THEN TRUE ELSE FALSE END WHERE `LoginStr` = ?";

    $stmt = mysqli_stmt_init($link);
    if(!mysqli_stmt_prepare($stmt, $query)){
        die("mysqli_stmt_prepare error oprava.1...");
    }
    mysqli_stmt_bind_param($stmt, "ss", $variant_name, $loginstr);
    if (!mysqli_stmt_execute($stmt))
    {
        die("DB Error: change variants!");
    }

    $_SESSION["LoggedIn"] = $next_user_row;
    $_SESSION["LoggedIn"]["VariantNames"] = $variantNames;
    $_SESSION["Pridaj"] = false;

    $_SESSION["LoggedIn"]["VariantOutputMsg"] = "Zmenený variant na ".htmlspecialchars($variant_name);	

	# now load Dashboard just as if nothing happened
	require_once 'Modules/Dashboard/Dashboard.php';
	header('Location: '.$HostnamePort.'Dashboard');
	die();
?>
