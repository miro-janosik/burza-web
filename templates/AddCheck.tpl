{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}
{include file="Slices/Sidebar.tpl"}

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">ICMP Ping Checks</h1>
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
                        <a href="#">
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
                                    <div class="huge">16</div>
                                    <div>Services OK</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
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
                                    <div class="huge">1</div>
                                    <div>Services Critical</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
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
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Add a new ICMP Ping Check
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="/ICMP/AddCheck" method="post">
                                        <div class="form-group">
                                            <label>Host Address</label>
                                            <input name='host' class="form-control" placeholder="Hostname or IP address">
                                        </div>
                                        <div class="form-group">
                                            <label>Timeout (in seconds)</label>
                                            <input name='timeout' class="form-control" placeholder="30">
                                        </div>
                                        <div class="form-group">
                                            <label>Packet size (in bytes)</label>
                                            <input name="packetsize" class="form-control" placeholder="64">
                                        </div>
                                        <div class="form-group">
                                            <label>Packet count</label>
                                            <input name='packetcount' class="form-control" placeholder="5">
                                        </div>
                                        <div class="form-group">
                                            <label>Check interval</label>
                                            <select name="interval" class="form-control">
                                                <option value="1">5 seconds</option>
                                                <option value="2">10 seconds</option>
                                                <option value="3">30 seconds</option>
                                                <option value="4">1 minute</option>
                                                <option value="5">5 minutes</option>
                                                <option value="6">10 minutes</option>
                                                <option value="7">15 minutes</option>
                                                <option value="8">30 minutes</option>
                                            </select>
                                        </div>
                                        <button name="Save" type="submit" value="Save" class="btn btn-default">Submit</button>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
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