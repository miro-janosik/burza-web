<?php

    $code = "";

    if (isset($_GET['code'])) {
        $code = $_GET['code'];
        $code = strtoupper( $code );
    }

    $newURL = "http://burza.mcsrdiecko.sk/Login/" . $code;

    header('Location: '.$newURL);
    die();
?>
