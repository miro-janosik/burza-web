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
										<b>Štatistika pridaných položiek</b>
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<div class="col-lg-3 col-md-6">
											<div class="panel panel-danger">
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
										<div class="col-lg-3 col-md-6">
												<div class="panel panel-danger">
														<div class="panel-heading">
																<div class="row">
																		<div class="col-xs-3">
																				<i class="fa fa-eur fa-5x"></i>
																		</div>
																		<div class="col-xs-9 text-right">
																				<div>Potenciálna provízia (15%)</div>
																				<div class="huge">{$MoznaProvizia} €</div>
																		</div>
																</div>
														</div>
												</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="panel panel-danger">
													<div class="panel-heading">
															<div class="row">
																	<div class="col-xs-3">
																			<i class="fa fa-eur fa-5x"></i>
																	</div>
																	<div class="col-xs-9 text-right">
																			<div>Potenciálny zisk</div>
																			<div class="huge">{$MoznyZisk} €</div>
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
						
            <!-- PRIDAJ POLOZKU -->
						{if $Pridaj}
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pridaj položku do burzy
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <form role="form" action="{if isset($EditID)}/Edit/{$EditID}{else}/Dashboard{/if}" method="post">
                                        <div class="form-group{if isset($ERRVELKOST)} has-error{/if}">
                                            <label>Veľkosť</label>
                                            <select name="velkost" class="form-control">
						<option value="x" style="font-weight:bold">Vyber veľkosť</option>
                                                <option {if isset($Velkost) && $Velkost == 38}selected{/if} value="38">50, predčasniatko</option>
                                                <option {if isset($Velkost) && $Velkost == 39}selected{/if} value="39">56, novorodenec</option>
                                                <option {if isset($Velkost) && $Velkost == 40}selected{/if} value="40">62, 3 mesiace</option>
                                                <option {if isset($Velkost) && $Velkost == 41}selected{/if} value="41">68, 6 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 42}selected{/if} value="42">74, 6 až 9 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 43}selected{/if} value="43">S</option>
                                                <option {if isset($Velkost) && $Velkost == 44}selected{/if} value="44">M</option>
                                                <option {if isset($Velkost) && $Velkost == 45}selected{/if} value="45">L</option>
                                                <option {if isset($Velkost) && $Velkost == 46}selected{/if} value="46">XL</option>
                                                <option {if isset($Velkost) && $Velkost == 47}selected{/if} value="47">bez veľkosti</option>
                                            </select>
																						{if isset($ERRVELKOST)}<div class="alert alert-danger"><b>Musíte vybrať veľkosť!</b></div>{/if}
                                        </div>
                                        <div class="form-group{if isset($ERRCENA)} has-error{/if}">
                                            <label>Cena</label>
                                            <input {if isset($Cena)}value="{$Cena}"{/if} name="cena" maxlength="6" type="text" class="form-control" placeholder="Napríklad 4,45">
																						{if isset($ERRCENA)}<div class="alert alert-danger"><b>Chybne zadaná cena!</b></div>{/if}
                                        </div>
                                        <div class="form-group{if isset($ERRPOPIS)} has-error{/if}">
                                            <label>Popis (max. 80 znakov)</label>
                                            <textarea name="popis" maxlength="80" class="form-control" rows="5">{if isset($Popis)}{$Popis}{/if}</textarea>
																						{if isset($ERRPOPIS)}<div class="alert alert-danger"><b>Chybne vyplnený popis!</b></div>{/if}
                                        </div>
																				{if isset($EditID)}
																				<button name="SaveEdit" type="submit" value="SaveEdit" class="btn btn-warning">Zmeň položku</button>
																				{else}
                                        <button name="Save" type="submit" value="Save" class="btn btn-success">Pridaj položku</button>
																				<a href="/Skry" class="btn btn-warning">Zavri tento formulár bez pridania</a>
																				{/if}
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
						{else}
            <!-- PRIDAJ POLOZKU KONIEC -->
            <!-- /.row -->
            <div class="row">
							
							
							<a href="/Pridaj" class="abbk">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-shopping-cart fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">Pridaj</div>
                                        <div>Položku do burzy</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
{/if}
							
							
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
                                            <th>Akcia</th>
                                            <th>Cena</th>
                                            <th>Veľkosť</th>
                                            <th>Popis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
          {foreach from=$Polozky key=k item=v}
            <tr class="odd gradeX">
							<td>{if $ID === 0}(ID Predajkine: {$v['UserID']})<b>{$v['Cislo']}</b> &nbsp; &nbsp; {if $v['Predane'] === 1}<b>PREDANÉ</b>{else}<a href="/Predane/{$v['ID']}" class="btn btn-danger btn-xs">Predane</a>{/if}{else}{if $v['Predane'] === 1}<b>{$v['Cislo']} PREDANÉ</b>{else}{$v['Cislo']} <a href="/Delete/{$v['ID']}" class="btn btn-danger btn-xs">Zmazať</a> <a href="/Edit/{$v['ID']}" class="btn btn-warning btn-xs">Upraviť</a>{/if}{/if}</td>
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
