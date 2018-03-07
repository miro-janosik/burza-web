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
													<b>Počet položiek</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          {if $ERR}<b>{$ERR}</b>{/if}
                            <h1>{$POCET}</h1>
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
                    {if $POCET < 1}
                    <div class="col-lg-3 col-md-6">
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">1 NIČ</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                    {else}
                    <div class="col-lg-3 col-md-6">
											<div class="panel panel-green">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">1 POTVRDIŤ</div>
														</div>
													</div>
												</div>
											</div>
										</div>
                    {/if}
                    <div class="col-lg-3 col-md-6">
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">2 NIČ</div>
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
