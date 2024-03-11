<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kalkulator Kredytowy</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_x">Kwota kredytu: </label>
	<input id="id_x" type="text" name="x" value="<?php (isset($x)) ? print($x) : $x=''; ?>" /><br />
	<label for="id_op">Oprocentowanie: </label>
    <input id="id_op" type="text" name="op" value="<?php (isset($oprocentowanie)) ? print($oprocentowanie) : $oprocentowanie='' ?>" style="margin: 5px 0"/><br />
	<label for="id_y">Ile lat: </label>
	<input id="id_y" type="text" name="y" value="<?php (isset($y)) ? print($y) : $y='' ?>" /><br />
	<input type="submit" value="Oblicz Miesięczna Ratę" style="margin-top: 5px"/>
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
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Miesięczna rata wynosi: '.round($result, 2). ' zł'; ?>
</div>
<?php } ?>

</body>
</html>