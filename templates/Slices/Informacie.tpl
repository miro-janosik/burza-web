<div class="panel-group" id="accordion">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><b>Pre informácie a pravidlá burzy klikni sem.</b></a>
			</h4>
		</div>
		<div id="collapseTwo" class="panel-collapse collapse">
			<div class="panel-body">
				<p class="lead">Prosím prihláste sa so svojim kódom. <br/>
					Vyplňte svoje meno a priezvisko a kontakt na vás.<br/>
					Pridajte vaše veci na predaj.<br/>
					Netreba nič odosielať e-mailom, stačí to čo vyplníte na tejto stránke.<br/>
					<br/>
					Miesto: {$Miesto}<br/>
					<br/>
					<b>Harmonogram burzy</b></p>
				<div class="table-responsive">
				{include file="Slices/Harmonogram.tpl"}
			</div>
			<p><a class="btn btn-info btn-lg" href="/Rules">Pravidlá burzy</a></p>
		</div>
	</div>
</div>
