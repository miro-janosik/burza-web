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
            {if $ERR}
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading panel-danger">
													<b>CHYBA</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body panel-danger">
                          <b>{$ERR}</b>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            {/if}
            
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
											<div class="panel panel-danger">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">1 PREBRAŤ</div>
														</div>
													</div>
												</div>
											</div>
										</div>
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
											<div class="panel panel-default">
												<div class="panel-heading">
													<div class="row">
														<div class="col-xs-11 text-right">
															<div>&nbsp;</div>
															<div class="huge">3 NIČ</div>
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
