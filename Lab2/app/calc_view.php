<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Kalkulator Kredytowy</title>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>
<body>

<div style="width:90%; margin: 2em auto;">
	<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
	<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post" class="pure-form pure-form-stacked">
	<legend>Kalkulator Kredytowy</legend>
	<fieldset>
		<label for="id_x">Kwota kredytu: </label>
		<input id="id_x" type="text" name="x" value="<?php out($x) ?>" />
		<label for="id_op">Oprocentowanie: </label>
		<input id="id_op" type="text" name="op" value="<?php out($oprocentowanie) ?>"/>
		<label for="id_y">Ile lat: </label>
		<input id="id_y" type="text" name="y" value="<?php out($y) ?>" />
	</fieldset>
	<input type="submit" value="Oblicz Miesięczną Ratę" class="pure-button pure-button-primary"/>
</form>

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 50px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin-top: 1em; padding: 1em; border-radius: 0.5em; background-color: #ff0; width:25em;">
<?php echo 'Miesięczna rata wynosi: '.round($result, 2). ' zł'; ?>
</div>
<?php } ?>

</body>
</html>