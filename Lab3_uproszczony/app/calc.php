<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// Kontroler podzielono na część definicji etapów (funkcje)
// oraz część wykonawczą, która te funkcje odpowiednio wywołuje.
// Na koniec wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy  przez zmienne.

//pobranie parametrów
function getParams(&$form){
	$form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$form['dlugosc'] = isset($_REQUEST['dlugosc']) ? $_REQUEST['dlugosc'] : null;
	$form['oprocentowanie'] = isset($_REQUEST['oprocentowanie']) ? $_REQUEST['oprocentowanie'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['kwota']) && isset($form['dlugosc']) && isset($form['oprocentowanie']) ))	return false;

	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['kwota'] == "") $msgs [] = 'Nie podano kwoty kredytu';
	if ( $form['dlugosc'] == "") $msgs [] = 'Nie podano długości kredytu';
	if ( $form['oprocentowanie'] == "") $msgs [] = 'Nie podano oprocentowania';

	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $form['kwota'] )) $msgs [] = 'Kwota kredytu nie jest liczbą';
		if (! is_numeric( $form['dlugosc'] )) $msgs [] = 'Długość kredytu nie jest liczbą';
		if (! is_numeric( $form['oprocentowanie'] )) $msgs [] = 'Oprocentowanie kredytu nie jest liczbą';
	}

	if (count($msgs)>0) return false;
	else return true;
}

// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';

	//konwersja parametrów na int
	$form['kwota'] = floatval($form['kwota']);
	$form['dlugosc'] = floatval($form['dlugosc']);
	$form['oprocentowanie'] = floatval($form['oprocentowanie']);

	$result = ($form['kwota'] + ($form['kwota'] * $form['oprocentowanie']/100))/($form['dlugosc'] * 12);

}

//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$result = null;
//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

//Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu
$page_title = 'Przykład 03';
$page_description = 'Najprostsze szablonowanie oparte na budowaniu widoku poprzez dołączanie kolejnych części HTML zdefiniowanych w różnych plikach .php';
$page_header = 'Proste szablony';
$page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';

include 'calc_view.php';