{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}
{include file="Slices/Sidebar.tpl"}

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">HTTP Get Checks</h1>
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
                        <a href="/HTTP/AddCheck">
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
                        <a href="/HTTP/OK">
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
                        <a href="/HTTP/CRITICAL">
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
                            Defined HTTP Get Checks
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Action</th>
                                            <th>URL</th>
                                            <th>Check Period</th>
                                            <th>Timeout</th>
                                            <th>Desired Response Code</th>
                                            <th>Search for string</th>
                                            <th>Last status</th>
                                            <th>Changed at</th>
                                            <th>Dest. IP</th>
                                            <th>response code</th>
                                            <th>request took</th>
                                            <th>errors</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {if isset($Checks)}
          {foreach from=$Checks key=k item=v}
            <tr class="odd gradeX">
                <td><a href="/HTTP/Delete/{$v['HTTPCheckID']}" class="btn btn-danger btn-xs">DEL</a></td>
                <td><a href="/HTTP/View/{$v['HTTPCheckID']}">{$v['HTTPCheckURL']}</a></td>
                <td>{$v['HTTPCheckPeriod']} s</td>
                <td>{$v['HTTPCheckTimeOut']} s</td>
                <td>{if $v['HTTPCheckDRC'] === NULL}--{else}{$v['HTTPCheckDRC']}{/if}</td>
                <td>{if $v['HTTPSearchString'] === NULL}--{else}{$v['HTTPSearchString']}{/if}</td>
                <td>{if $v['HTTPStatesStatus'] eq ''}--{else}{$v['HTTPStatesStatus']}{/if}</td>
                <td>{if $v['Time'] eq ''}--{else}{$v['Time']|date_format:"%d.%m.%Y %T"}{/if}</td>
                <td>{if $v['LastFrom'] eq ''}--{else}{$v['LastFrom']}{/if}</td>
                <td>{if $v['ResponseCode'] === NULL}--{else}{$v['ResponseCode']}{/if}</td>
                <td>{if $v['RequestTook'] === NULL}--{else}{$v['RequestTook']} s{/if}</td>
                <td>{if $v['HTTPStatesProblems'] === NULL}--{else}{$v['HTTPStatesProblems']}{/if}</td>
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