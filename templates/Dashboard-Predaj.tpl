{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}

        <div id="page-wrapper">
						<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    &nbsp;
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
						<!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
									<div class="panel-group" id="accordion">
											<div class="panel panel-default">
													<div class="panel-heading">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><b>Pre informácie a pravidlá burzy klikni sem.</b></a>
															</h4>
													</div>
													<div id="collapseTwo" class="panel-collapse collapse">
														<div class="panel-body">
                              <p class="lead">My Vám zoznam aj štítky vytlačíme, <b>netreba nič tlačiť ani označovať.</b><br>
                              Do burzy nebude možné dodatočne pridať položky, ktoré nie sú vo Vašom zozname.<br><br>
                              <b>Harmonogram burzy</b></p>
                            <div class="table-responsive">
															{include file="Slices/Harmonogram.tpl"}
														</div>
														<p><a class="btn btn-info btn-lg" href="/Rules">Pravidlá burzy</a></p>
														</div>
													</div>
											</div>
									</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
						
						 <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<b>Štatistika už predaných položiek</b>
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<div class="col-lg-3 col-md-6">
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-3">
															<i class="fa fa-eur fa-5x"></i>
														</div>
														<div class="col-xs-9 text-right">
															<div>Aktuálne predaných {$PocetPredanych} vecí za</div>
															<div class="huge">{$PredaneCelkom} €</div>
                              <div>Zatiaľ nepredaných {$PocetNepredanych} za {$NepredaneCelkom} €</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
												<div class="panel panel-default">
														<div class="panel-heading">
																<div class="row">
																		<div class="col-xs-3">
																				<i class="fa fa-eur fa-5x"></i>
																		</div>
																		<div class="col-xs-9 text-right">
																				<div>Aktuálna provízia (15%) pre MC</div>
																				<div class="huge">{$Provizia} €</div>
                                        <div>Z max. možnej {$MoznaProvizia} €</div>
																		</div>
																</div>
														</div>
												</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="panel panel-green">
													<div class="panel-heading">
															<div class="row">
																	<div class="col-xs-3">
																			<i class="fa fa-eur fa-5x"></i>
																	</div>
																	<div class="col-xs-9 text-right">
																			<div>Aktuálny zisk</div>
																			<div class="huge">{$Zisk} €</div>
                                      <div>Z max. možného {$MoznyZisk} €</div>
																	</div>
															</div>
													</div>
											</div>
										</div>
									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-12 -->
            </div>
                                  
            <div class="row">
                <div class="col-lg-12">
									<div class="panel-group" id="accordion">
											<div class="panel panel-default">
													<div class="panel-heading">
															<h4 class="panel-title">
																<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Legenda k tabuľke</a>
															</h4>
													</div>
													<div id="collapseThree" class="panel-collapse collapse">
														<div class="panel-body">
															<table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Farby</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <tr class="odd gradeX">
                                          <td>Položka v predaji</td>
                                      </tr>
                                      <tr class="odd gradeX success">
                                          <td>Predaná položka</td>
                                      </tr>
                                      <tr class="odd gradeX danger">
                                          <td>Zatiaľ nedodaná položka</td>
                                      </tr>
                                    </tbody>
                                </table>
														</div>
													</div>
											</div>
									</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
													<b>Zoznam položiek</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            {if isset($Polozky)}
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Cena</th>
                                            <th>Veľkosť</th>
                                            <th>Popis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
          {foreach from=$Polozky key=k item=v}
            <tr class="odd gradeX {if $v['Predane'] === 1}success{else}{if $v['Naskladnene'] !== 1}danger{/if}{/if}">
                <td>{$v['Cena']} €</td>
                <td>{$v['Velkost']}</td>
                <td>{$v['Popis']}</td>
            </tr>  
          {/foreach}
                                    </tbody>
                                </table>
                            </div>
                            {else}<p><b>Zatial ziadne</b></p>{/if}
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
        
{include file="Slices/Footer.tpl"}
