{assign var="SiteTitle" value="Dashboard"}

{include file="Slices/Header.tpl"}

{if isset($debug)}
	<!-- Debug: 
 Pridaj: {if isset($Pridaj)} {$Pridaj} {/if}
 EditID: {if isset($EditID)} {$EditID} {/if}
 ID: {if isset($ID)} {$ID} {/if}
 Name: {if isset($Name)} {$Name} {/if}
 Mail: {if isset($Mail)} {$Mail} {/if}
 Kontakt: {if isset($Kontakt)} {$Kontakt} {/if}
 MoznyZisk: {if isset($MoznyZisk)} {$MoznyZisk} {/if}
 MoznaProvizia: {if isset($MoznaProvizia)} {$MoznaProvizia} {/if}
 VsetkyCelkom: {if isset($VsetkyCelkom)} {$VsetkyCelkom} {/if}
 Popis: {if isset($Popis)} {$Popis} {/if}
 ERRPOPIS: {if isset($ERRPOPIS)} {$ERRPOPIS} {/if}
 Cena: {if isset($Cena)} {$Cena} {/if}
 ERRCENA: {if isset($ERRCENA)} {$ERRCENA} {/if}
 Velkost: {if isset($Velkost)} {$Velkost} {/if}
 ERRVELKOST: {if isset($ERRVELKOST)} {$ERRVELKOST} {/if}
 Cislo: {if isset($Cislo)} {$Cislo} {/if}
 ERRCISLO: {if isset($ERRCISLO)} {$ERRCISLO} {/if}
	-->
{/if}

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
									{include file="Slices/Informacie.tpl"}
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
						
						<!-- Uzivatelske data -->
						<div class="row" id="UserData">
							<div class="col-lg-12">
								
								
								<div class="panel-group" id="accordion">
									<div class="panel 
									{if (empty($Name)) || (empty($Mail)) || (empty($Kontakt))} panel-danger {else} panel-default {/if}
									">
										<div class="panel-heading">
											<h4 class="panel-title">
												<a data-toggle="collapse" data-parent="#accordion" href="#collapseUserData"><b>
												{if (empty($Name)) || (empty($Mail)) || (empty($Kontakt))}!! Prosím vyplňťe !! - kliknite sem - {/if}
												Moje údaje</b></a>
											</h4>
										</div>
										<div id="collapseUserData" class="panel-collapse collapse">
											<div class="panel-body">
												
												<form role="form" action="SaveUser/#UserData" method="post" class="form-horizontal" >
														<div class="form-group">
																<label class="control-label col-sm-2">Meno</label>
																<div class="col-sm-10"><input value="{$Name}" name="Name" maxlength="80" type="text" class="form-control" placeholder="Vaše meno a priezvisko"></div>
																{if empty($Name)}<div class="alert alert-danger"><b>Nevyplnené políčko!</b></div>{/if}
														</div>
														
														<div class="form-group">
																<label class="control-label col-sm-2">Kontakt</label>
																<div class="col-sm-10"><input value="{$Kontakt}" name="Kontakt" maxlength="80" type="text" class="form-control" placeholder="Váš telefón alebo iný kontakt"></div>
																{if empty($Kontakt)}<div class="alert alert-danger"><b>Nevyplnené políčko!</b></div>{/if}
														</div>
														
														<div class="form-group">
																<label class="control-label col-sm-2">E-Mail</label>
																<div class="col-sm-10"><input value="{$Mail}" name="Email" maxlength="80" type="text" class="form-control" placeholder="meno@niekde.sk"></div>
																{if empty($Mail)}<div class="alert alert-danger"><b>Nevyplnené políčko!</b></div>{/if}
														</div>
														
														<div class="form-group">
															<div class="col-sm-offset-2 col-sm-10">
																<button name="Save" type="submit" value="Save" class="btn btn-success">Ulož</button>
															</div>
														</div>
													</form>
											
											
											</div>
										</div>
									</div>
								</div>
								
							</div><!-- /.col-lg-12 -->
						</div>
            <!-- /Uzivatelske data -->            
						
            <!-- PRIDAJ POLOZKU -->
						{if $Pridaj}
            <div class="row" id="pridaj">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pridaj položku do burzy
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-8">
                                    <form role="form" action="{if isset($EditID)}/Edit/{$EditID}/#pridaj{else}/Dashboard/#pridaj{/if}" method="post">
                                        <div class="form-group{if isset($ERRCISLO)} has-error{/if}">
                                            <label>Číslo</label>
                                            <input {if isset($Cislo)}value="{$Cislo}"{/if} name="cislo" maxlength="6" type="text" class="form-control" placeholder="Napríklad 1">
																						{if isset($ERRCISLO)}<div class="alert alert-danger"><b>Chybne zadané číslo!</b></div>{/if}
                                        </div>
                                        <div class="form-group{if isset($ERRVELKOST)} has-error{/if}">
                                            <label>Veľkosť</label>
                                            <select name="velkost" class="form-control">
																								<option value="x" style="font-weight:bold">Vyber veľkosť</option>
																								<option {if isset($Velkost) && $Velkost == 1}selected{/if} value="1">Textil: 50 - 56, novorodenec</option>
                                                <option {if isset($Velkost) && $Velkost == 2}selected{/if} value="2">Textil: 62 - 68, 3 - 6 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 3}selected{/if} value="3">Textil: 74, 6 - 9 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 4}selected{/if} value="4">Textil: 80, 9 - 12 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 5}selected{/if} value="5">Textil: 86, 12 - 18 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 6}selected{/if} value="6">Textil: 92, 18 - 24 mesiacov</option>
                                                <option {if isset($Velkost) && $Velkost == 7}selected{/if} value="7">Textil: 98, 2 - 3 roky</option>
                                                <option {if isset($Velkost) && $Velkost == 8}selected{/if} value="8">Textil: 104, 3 - 4 roky</option>
                                                <option {if isset($Velkost) && $Velkost == 9}selected{/if} value="9">Textil: 110, 4 - 5 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 10}selected{/if} value="10">Textil: 116, 5 - 6 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 11}selected{/if} value="11">Textil: 122, 6 - 7 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 12}selected{/if} value="12">Textil: 128, 7 - 8 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 13}selected{/if} value="13">Textil: 134, 8 - 9 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 14}selected{/if} value="14">Textil: 140, 9 - 10 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 15}selected{/if} value="15">Textil: 146, 10 - 11 rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 16}selected{/if} value="16">Textil: 152 a viac, 11 a viac rokov</option>
                                                <option {if isset($Velkost) && $Velkost == 17}selected{/if} value="17">Textil: Univerzálna veľkosť</option>
																								<option {if isset($Velkost) && $Velkost == 18}selected{/if} value="18">Topánky: Novorodenecké</option>
																								<option {if isset($Velkost) && $Velkost == 19}selected{/if} value="19">Topánky: 18 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 20}selected{/if} value="20">Topánky: 19 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 21}selected{/if} value="21">Topánky: 20 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 22}selected{/if} value="22">Topánky: 21 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 23}selected{/if} value="23">Topánky: 22 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 24}selected{/if} value="24">Topánky: 23 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 25}selected{/if} value="25">Topánky: 24 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 26}selected{/if} value="26">Topánky: 25 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 27}selected{/if} value="27">Topánky: 26 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 28}selected{/if} value="28">Topánky: 27 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 29}selected{/if} value="29">Topánky: 28 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 30}selected{/if} value="30">Topánky: 29 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 31}selected{/if} value="31">Topánky: 30 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 32}selected{/if} value="32">Topánky: 31 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 33}selected{/if} value="33">Topánky: 32 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 34}selected{/if} value="34">Topánky: 33 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 35}selected{/if} value="35">Topánky: 34 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 36}selected{/if} value="36">Topánky: 35 (EU)</option>
																								<option {if isset($Velkost) && $Velkost == 37}selected{/if} value="37">Topánky: 36 (EU)</option>
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
																				<a href="/Skry#zoznam" class="btn btn-warning">Zavri tento formulár bez pridania</a>
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
							
							
							<a href="/Pridaj#pridaj" class="abbk">
                    <div class="col-lg-3">
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
							
							
                <div class="col-lg-9">
                    <div class="panel panel-default">
                        <div class="panel-heading" id="zoznam">
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
                                            <th>Číslo</th>
                                            <th>Cena</th>
                                            <th>Veľkosť</th>
                                            <th>Popis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
          {foreach from=$Polozky key=k item=v}
            <tr class="odd gradeX">
							<td>
						{if $ID === 0}
							(ID Predajkine: {$v['UserID']})<b>{$v['Cislo']}</b> &nbsp; &nbsp; 
							{if $v['Predane'] === 1}
								<b>PREDANÉ</b>
							{else}
								{$v['Cislo']} <a href="/Predane/{$v['ID']}" class="btn btn-danger btn-xs">Predane</a>
							{/if}
						{else}
							{if $v['Predane'] === 1}
								<b>PREDANÉ</b>
							{else}
								<a href="/Delete/{$v['ID']}" class="btn btn-danger btn-xs">Zmazať</a> &nbsp; &nbsp;
								<a href="/Edit/{$v['ID']}/#pridaj" class="btn btn-warning btn-xs">Upraviť</a>
							{/if}
						{/if}</td>
								<td>{$v['Cislo']} </td>
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
