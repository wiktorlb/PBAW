<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera
include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów
function getParams(&$x, &$y, &$oprocentowanie) {
	$x = isset($_REQUEST['x']) ? $_REQUEST['x'] : null;
	$y = isset($_REQUEST['y']) ? $_REQUEST['y'] : null;
	$oprocentowanie = isset($_REQUEST['op']) ? $_REQUEST['op'] : null;
}


// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$x, &$y, &$oprocentowanie, &$messages){
// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($x) && isset($y) && isset($oprocentowanie))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $x == "") {
		$messages [] = 'Nie podano kwoty kredytu';
	}
	if ( $y == "") {
		$messages [] = 'Nie podano dlugości kredytu';
	}
	if ( $oprocentowanie == "") {
		$messages [] = 'Nie podano oprocentowania';
	}

//nie ma sensu walidować dalej gdy brak parametrów
	if (count ($messages ) != 0) return false;

    //sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $x ) && ! is_double( $x )) {
		$messages [] = 'Kwota kredytu nie jest liczbą';
	}

	if (! is_numeric( $y ) && ! is_double( $y )) {
		$messages [] = 'Ilość lat nie jest liczbą';
	}

    if (! is_numeric( $oprocentowanie ) && ! is_double( $oprocentowanie )) {
        $messages [] = 'Oprocentowanie nie jest liczbą';
    }

	//if (empty ($messages )) return false;
	if (count ($messages ) != 0) return false;
	else return true;
}

// 3. wykonaj zadanie jeśli wszystko w porządku

function process(&$x, &$y, &$oprocentowanie, &$messages, &$result) {
	global $role;

	//konwersja parametrów na double
	$x = doubleval($x);
	$y = doubleval($y);
    $oprocentowanie = doubleval($oprocentowanie);


	if($role == 'admin') {
		//obliczanie
		$result = ($x + ($x * $oprocentowanie/100))/($y * 12);
	} else {
		$messages [] = 'Tylko admin może obliczyć miesięczną ratę';
	}
}

//Definicja zmiennych
$x = null;
$y = null;
$oprocentowanie = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj
getParams($x, $y, $oprocentowanie);
if(validate($x, $y, $oprocentowanie, $messages)) {
	process($x, $y, $oprocentowanie, $messages, $result);
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$oprocentowanie,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';