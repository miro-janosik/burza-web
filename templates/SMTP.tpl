{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}
{include file="Slices/Sidebar.tpl"}

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">SMTP Get Checks</h1>
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
                            Defined SMTP Get Checks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>Host</th>
                                            <th>Check Period</th>
                                            <th>Timeout</th>
                                            <th>User Name</th>
                                            <th>Mail From</th>
                                            <th>Mail To</th>
                                            <th>Last status</th>
                                            <th>Changed at</th>
                                            <th>errors</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {if isset($Checks)}
          {foreach from=$Checks key=k item=v}
            <tr class="odd gradeX">
                <td><a href="/SMTP/Delete/{$v['SMTPCheckID']}" class="btn btn-danger btn-xs">DEL</a></td>
                <td><a href="/SMTP/View/{$v['SMTPCheckID']}">{$v['SMTPCheckURL']}:{$v['Port']}</a></td>
                <td>{$v['SMTPCheckPeriod']} s</td>
                <td>{$v['SMTPCheckTimeOut']} s</td>
                <td>{$v['UserName']}</td>
                <td>{$v['MailFrom']}</td>
                <td>{$v['MailTo']}</td>
                <td>{if $v['SMTPStatesStatus'] eq ''}--{else}{$v['SMTPStatesStatus']}{/if}</td>
                <td>{if $v['Time'] eq ''}--{else}{$v['Time']|date_format:"%d.%m.%Y %T"}{/if}</td>
                <td>{if $v['SMTPStatesProblems'] eq ""}--{else}{$v['SMTPStatesProblems']}{/if}</td>
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