<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>{$Nadpis} - Pravidlá</title>

    <!-- Bootstrap Core CSS -->
    <link href="/content/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/content/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="/content/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/content/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="/content/css/plugins/morris.css" rel="stylesheet">

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

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/Dashboard">{$Organizacia} - Burza - Pravidlá</a>
            </div>
            <!-- /.navbar-header -->

        </nav>

        <div id="page-wrapper">
					<div class="row">
                <div class="col-lg-12">
											&nbsp;
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-body">
                        <!-- /.panel-heading -->
													<h1>{$Nadpis}</h1>
													<p class="lead">{$Podstata}</p>
													<h1>Pravidlá burzy</h1><p class="lead" >
                          <ul class="lead">
														<li>Predávajúci sú povinní uviesť všetky predávané veci v zozname prostredníctvom webového formulára. V termíne určenom na zber sa predávajúci zaväzujú fyzicky priniesť veci zaradené do predaja. Akékoľvek poškodenia či obmedzenia používateľnosti predávaných vecí je nutné uviesť v popise predávanej veci, inak bude takáto poškodená vec z predaja vyradená 
Všetky hračky a veci s cenou nad 15 eur sa nepredávajú fyzicky (do herne ich počas zberu nie je nutné priniesť), predávajúci ich môžu ponúkať prostredníctvom vytlačeného inzerátu s fotkou, cenou a číslom predávajúceho na nástenke v priestoroch herne</li>
				<li>Súpravy a sady pozostávajúce z viacerých položiek musia byť pevne spojené (zošité, zasicherkované, alebo v neporušiteľnom obale)</li>
        <li>Na burze je možné ponúkať oblečenie len podľa uvedenej sezóny</li>
				<li>Organizátorky si vyhradzujú právo nezaradiť položky do predaja podľa vlastného uváženia</li>
														<li>Burza sa striktne riadi harmonogramom</li>
														<li>{$Organizacia} sa zaväzuje vytlačiť štítky a zabezpečiť predaj a propagáciu burzy, zároveň si však vyhradzuje právo z pádnych dôvodov prinesené veci neprevziať a do burzy  nezaradiť</li>
														<li>Peniaze z predaja budú v termíne určenom na výplatu vyplatené predávajúcemu, predávajúci sa zaväzuje darovať 15% z tejto čiastky {$Organizacia}</li>
														<li>{$Organizacia} za predávaný tovar a prípadné straty NERUČÍ. V prípade neprevzatia sa nepredané oblečenie a peniaze dňom {$LikvidaciaDatum} stávajú majetkom {$Organizacia}</li>
													</ul>
                          <br>
                          <h1>Harmonogram burzy</h1>
														<div class="table-responsive">
															{include file="Slices/Harmonogram.tpl"}
														</div>
                            <p><br><a class="btn btn-info btn-lg" href="/">Späť</a></p>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
        
{include file="Slices/Footer.tpl"}
