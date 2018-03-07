{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}
{include file="Slices/Sidebar.tpl"}

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMTP GET Checks</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">&nbsp</div>
                                    <div>&nbsp;</div>
                                </div>
                            </div>
                        </div>
                        <a href="/SMTP/AddCheck">
                            <div class="panel-footer">
                                <span class="pull-left">Add new</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{$OK}</div>
                                    <div>Services OK</div>
                                </div>
                            </div>
                        </div>
                        <a href="/SMTP/OK">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">{$CRIT}</div>
                                    <div>Services Critical</div>
                                </div>
                            </div>
                        </div>
                        <a href="/SMTP/CRITICAL">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
             <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            SMTP Check
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <p>
                                Host: <b>{$Checks1[0]['SMTPCheckURL']}</b><br />
                                Timeout: <b>{$Checks1[0]['SMTPCheckTimeOut']} s</b><br />
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Last 30 states
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>status</th>
                                            <th>At</th>
                                            <th>Problems</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
        {if isset($Checks1)}
          {foreach from=$Checks1 key=k item=v}
            <tr class="odd gradeX">
                <td><b>{if $v['SMTPStatesStatus'] eq ''}--{else}{$v['SMTPStatesStatus']}{/if}</b></td>
                <td>{if $v['Time'] eq ''}--{else}{$v['Time']|date_format:"%d.%m.%Y %T"}{/if}</td>
                <td>{if $v['SMTPStatesProblems'] === NULL}--{else}{$v['SMTPStatesProblems']}{/if}</td>
            </tr>  
          {/foreach}
        {/if}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Last 100 SMTP GET results
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>At</th>
                                            <th>error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
        {if isset($Checks2)}
          {foreach from=$Checks2 key=k item=v}
            <tr class="odd gradeX">
                <td>{if $v['Time'] eq ''}--{else}{$v['Time']|date_format:"%d.%m.%Y %T"}{/if}</td>
                <td>{if $v['Error'] === NULL}--{else}{$v['Error']}{/if}</td>
            </tr>  
          {/foreach}
        {/if}
                                    </tbody>
                                </table>
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
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        
{include file="Slices/Footer.tpl"}