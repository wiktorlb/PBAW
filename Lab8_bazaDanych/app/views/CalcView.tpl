{extends file="main.tpl"}


{block name=content}

<div id="main" class="alt">

<div class="inner">
	<header class="title">
		<h1>Kalkulator Kredytowy</h1>
	</header>



<!-- Form -->
<div class="">
	<form method="post" action="{$conf->action_root}CalcProcess" class="pure-form pure-form-aligned bottom-margin">
		<div class="pure-control-group">
			<label for="kwota">Kwota Kredytu</label>
			<input type="text" name="kwota" id="kwota" value="{$form->kwota}" placeholder="Kwota Kredytu" />
		</div>
		<div class="pure-control-group">
			<label for="oprocentowanie">Oprocentowanie</label>
			<input type="text" name="oprocentowanie" id="oprocentowanie" value="{$form->oprocentowanie}" placeholder="Oprocentowanie" />
		</div>
		<div class="pure-control-group">
			<label for="dlugosc">Długość Kredytu</label>
			<input type="text" name="dlugosc" id="dlugosc" value="{$form->dlugosc}" placeholder="Długość" />
		</div>
		<div class="pure-controls">
			<input type="submit" value="Oblicz" class="pure-button pure-button-primary" />
		</div>
	</form>
</div>


<div class="l-box-lrg pure-u-1 pure-u-med-3-5">
{* wyświeltenie listy błędów, jeśli istnieją *} {if
$msgs->isError()}
	<h4>Wystąpiły błędy:</h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err} {strip}
	<li>{$err}</li> {/strip} {/foreach}
	</ol>
{/if} {* wyświeltenie listy informacji, jeśli istnieją *} {if
$msgs->isInfo()}
	<h4>Informacje:</h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf} {strip}
	<li>{$inf}</li> {/strip} {/foreach}
	</ol>
{/if}
{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">{$res->result}</p>
{/if}

</div>

</div>

{/block}

