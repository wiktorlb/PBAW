<?php //góra strony z szablonu
include _ROOT_PATH.'/templates/top.php';
?>

<h3>Kalkulator Kredytowy</h2>

<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<fieldset>
		<label for="id_kwota">Kwota kredytu: </label>
		<input id="id_kwota" type="text" name="kwota" value="<?php out($form['kwota']) ?>" />
		<label for="id_op">Oprocentowanie: </label>
		<input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php out($form['oprocentowanie']) ?>"/>
		<label for="id_dlugosc">Ile lat: </label>
		<input id="id_dlugosc" type="text" name="dlugosc" value="<?php out($form['dlugosc']) ?>" />
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>

<div class="messages">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print($result); ?>
	</p>
<?php } ?>

</div>

<?php //dół strony z szablonu
include _ROOT_PATH.'/templates/bottom.php';
?>