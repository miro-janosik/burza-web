{assign var="SiteTitle" value="Terminal"}

{include file="Slices/Header-Terminal.tpl"}

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
                    <div class="panel panel-default">
                        <div class="panel-heading">
													<b>Chýbajúce položky! (Zobrazujem {$Zobrazujem} z {$PocetChybajucich} celkovo chybajucich.)</b>
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
            <tr class="odd gradeX">
                <td>{$v['Cena']} €</td>
                <td>{$v['Velkost']}</td>
                <td>{$v['Popis']}</td>
            </tr>  
          {/foreach}
                                    </tbody>
                                </table>
                            </div>
                            {else}<p><b>CHYBA!!!!!!!!!!</b></p>{/if}
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           						 <div class="row">
							<div class="col-lg-12">
								<div class="panel panel-default">
									<div class="panel-heading">
										<b>MoŽné akcie</b>
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
                    <div class="col-lg-3 col-md-6">
											<div class="panel panel-green">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">1 DOPLNIŤ</div>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="panel panel-warning">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">2 POTVRDIŤ</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                    <div class="col-lg-3 col-md-6">
											<div class="panel panel-danger">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">3 ZRUSIŤ</div>
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
						
            <!-- /.row -->
            
        </div>
        <!-- /#page-wrapper -->
        
{include file="Slices/Footer.tpl"}
