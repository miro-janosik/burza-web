<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$Nadpis}</title>

    <!-- Bootstrap Core CSS -->
    <link href="/content/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/content/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/content/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/content/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-danger">
                    <div class="panel-heading">
                        <h3 class="panel-title">
													{$Nadpis}
												</h3>
                    </div>
                    <div class="panel-body">
												<p>
													Naozaj chcete zmazať všetky položky zo svojho zoznamu ({$PoloziekNaZmazanie}) ?<br /><br/>
{if isset($ZmazanieNespraveSlovo)}
													<b>Nesprávne ste opísali slovo na zmazanie, skúste to znova...</b>
{else}
													Opíšte slovo do políčka a potvrďte zmazanie všetkých vecí na predaj.
{/if}
												</p>
												<br />
												<p>
                        <form action="/ConfirmDeleteItems/" method="post">
													<center>
														Napíšte sem <b>
														zmazat
														</b> a potvrďte: 
														<input type="text" name="MazacieSlovo" placeholder="" />
														<input type="submit" value="Zmazať všetky položky" />
													</center>
                        </form>
                        </p>
                        <br /><br />
                        <p>Návrat <a href="/Dashboard/">späť na zoznam</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="/content/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/content/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/content/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/content/js/sb-admin-2.js"></script>

</body>

</html>
