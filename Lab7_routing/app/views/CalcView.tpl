{extends file="main.tpl"}

{block name=content}

<div class="pure-menu pure-menu-horizontal bottom-margin">
	<a href="{$conf->action_url}logout"  class="pure-menu-heading pure-menu-link">wyloguj</a>
	<span style="float:right;">użytkownik: {$user->login}, rola: {$user->role}</span>
</div>

<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
<legend> Kalkulator Kredytowy - role </legend>
	<fieldset>
		<label for="price">Kwota kredytu</label>
		<input id="price" type="text" placeholder="Kwota kredytu" name="price" value="{$form->price}">

		<label for="perc">Oprocentowanie</label>
		<input id="perc" type="text" placeholder="Oprocentowanie" name="perc" value="{$form->perc}">

		<label for="len">Długość kredytu</label>
		<input id="len" type="text" placeholder="Długość kredytu" name="len" value="{$form->len}">
	</fieldset>
	{if $user->role == "admin"}
	<button type="submit" class="pure-button pure-button-primary">Oblicz miesięczną ratę</button>
	{/if}
</form>

{include file='messages.tpl'}

{if isset($res->result)}
<div class="messages info">
	Wynik: {$res->result}
</div>
{/if}

{/block}