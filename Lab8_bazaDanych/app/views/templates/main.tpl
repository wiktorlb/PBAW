<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">

<head>
	<meta charset="utf-8"/>
	<title>Aplikacja bazodanowa</title>
	<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"
		integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
	<link rel="stylesheet" href="{$conf->app_url}/css/style.css">
</head>

<body style="margin: 20px;">

<div class="pure-menu pure-menu-horizontal bottom-margin">
{if count($conf->roles)>0}
	<a href="{$conf->action_root}logout" class="pure-menu-heading pure-menu-link">Wyloguj</a>
	<a href="{$conf->action_root}CalcCtrl" class="pure-menu-heading pure-menu-link">Kalkulator Kredytowy</a>
{else}
	<a href="{$conf->action_root}loginShow" class="pure-menu-heading pure-menu-link">Zaloguj</a>
{/if}
</div>

{block name=login} {/block}
{block name=content} {/block}


</body>

</html>