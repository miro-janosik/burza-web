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
            <div class="row">
                <div class="col-lg-12">
									{include file="Slices/Informacie.tpl"}
									</div>
                </div>
                <!-- /.col-lg-12 -->
            </div>


			<!-- Zoznam poloziek -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
													<b>Zoznam položiek</b>
                        </div>
                        
                        <!-- legenda -->
                        Legenda: červené = nepredané. zelené = predané.
                        
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            {if isset($Polozky)}
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Číslo</th>
                                            <th>Cena</th>
                                            <th>Veľkosť</th>
                                            <th>Popis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
          {foreach from=$Polozky key=k item=v}
            <tr class="odd gradeX {if $v['Predane'] === 1}success{else}{if $v['Naskladnene'] !== 1}danger{/if}{/if}">
				<td>{$v['Cislo']}</td>
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

            <!-- statistika -->
						 <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<b>Štatistika pridaných položiek</b>
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
															<div>{$PocetDokopy} veci za celkovo</div>
															<div class="huge">{$VsetkyCelkom} €</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- 
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
										--> 
									</div>
									<!-- /.panel-body -->
								</div>
								<!-- /.panel -->
							</div>
							<!-- /.col-lg-12 -->
            </div>
                                  
			<!-- Legenda -->
			<!-- 
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
                <!-- /.col-lg-12 - ->
            </div>
            <!-- /.row - ->
			-->

        </div>
        <!-- /#page-wrapper -->
        
{include file="Slices/Footer.tpl"}
