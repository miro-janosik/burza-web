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
					{include file="Slices/Informacie.tpl"}
				</div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
{if isset($PrihlasenieZlyhalo)}
                <div class="login-panel panel panel-danger">
{else}
                <div class="login-panel panel panel-default">
{/if}
                    <div class="panel-heading">
                        <h3 class="panel-title">
{if isset($PrihlasenieZlyhalo)}
													Prihlásenie zlyhalo, pravdepodobne nesprávny kód...
{else}
													Prihlasenie nutne!
{/if}
												</h3>
                    </div>
                    <div class="panel-body">
                        <p><b>{$Nadpis}</b><br /><br />

                        <!-- Na prihlasenie sa pouzite poskytnutu prihlasovaciu linku! -->
                        
                        <form action="/LoginCode/">
                            Prihlasovací kód: <input type="text" name="code" placeholder="AB-CDE" />
                            <center><input type="submit" value="Prihlásiť" /></center>
                        
                        </form>
                        <br /><br />
                        </p>
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
