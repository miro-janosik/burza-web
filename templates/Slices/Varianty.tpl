
        {if isset($VariantOutputMsg)}
        <div class="alert alert-info">{$VariantOutputMsg}</div> <!--  fade in -->
        {/if}

        <div class="panel-group" id="variant_accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#variant_accordion" href="#variant_collapse"><b>Aktívny variant: {$Variant}</b></a>
                    </h4>
                </div>
                <div id="variant_collapse" class="panel-collapse collapse">
                    <div class="panel-body"> 
                        <form action="/VariantChange" method="post">
                            <label for="change_to_variant" class="form-label">Zmeniť na variant:</label>
                            <select id="change_to_variant" name="change_to_variant" class="form-select">
                                {foreach from=$VariantNames key=k item=v}
                                    <option value="{htmlspecialchars($v)}" {if $v == $Variant}selected{/if}>{htmlspecialchars($v)}</option>
                                {/foreach}
                            </select>
                            <button type="submit" class="btn btn-primary">Zmeň</button>
                        </form>
                    </div> 
                    
                    <div class="panel-body"> 
                        <b>Vytvoriť variant:</b> <br/>
                        Vytvorí samostatnú kópiu aktuálneho zoznamu položiek s novým menom variantu.<br/>
                        
                        <form action="/VariantCreate" method="post" class="form-inline">
                            <label for="variant_name" class="form-label">Meno</label>
                            <input type="text" class="form-control" id="variant_name" name="variant_name" readonly value="Jar">
                            <button type="submit" class="btn btn-primary">Vytvor</button>
                        </form>
                    </div>


                    <div class="panel-body"> 
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#variant_collapse" href="#popis_collapse"><b>Čo sú to varianty</b></a>
                            </h4>
                        </div>
                        <div id="popis_collapse" class="panel-collapse collapse">
                            <div class="panel-body">
                            Varianty sú viaceré zoznamy jedného predajcu, a všetky majú rovnaký kód.<br/>
                            Využitie majú vtedy, ak niektoré veci predávam na jar aj na jeseň, niektoré veci mám rovnaké, nechcem 
                            zmazať celý zoznam, ale chcem si premieňať medzi jarným a jesenným zoznamom.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
