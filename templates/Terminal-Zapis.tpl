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
													<b>Informácia</b>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <h1>Celkovo donesenych {$Donesenych}</h1>
                          <h1>Celkovo nedonesenych {$NEDonesenych}</h1>
                          {if $Duplicita}<h1>Celkovo duplicitne naskladnenych {$Duplicita}</h1>{/if}
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
															<div class="huge">1 KONIEC</div>
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
