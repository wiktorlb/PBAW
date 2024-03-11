<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów

$x = $_REQUEST ['x'];
$y = $_REQUEST ['y'];
$oprocentowanie = $_REQUEST ['op'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( ! (isset($x) && isset($y) && isset($oprocentowanie))) {
	//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
	$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
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
if (empty( $messages )) {
	
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

}

// 3. wykonaj zadanie jeśli wszystko w porządku

if (empty ( $messages )) { // gdy brak błędów
	
	//konwersja parametrów na double
	$x = doubleval($x);
	$y = doubleval($y);
    $oprocentowanie = doubleval($oprocentowanie);

    //obliczanie
    $result = ($x + ($x * $oprocentowanie/100))/($y * 12);

}



// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$oprocentowanie,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';