<?php
// W skrypcie definicji kontrolera nie trzeba dołączać żadnego skryptu inicjalizacji.
// Konfiguracja, Messages i Smarty są dostępne za pomocą odpowiednich funkcji.
// Kontroler ładuje tylko to z czego sam korzysta.

require_once 'CalcForm.class.php';
require_once 'CalcResult.class.php';

/** Kontroler kalkulatora
 * @author Przemysław Kudłacik
 *
 */
class CalcCtrl {

	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku

	/**
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->form = new CalcForm();
		$this->result = new CalcResult();
	}

	/**
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->price = getFromRequest('price');
		$this->form->length = getFromRequest('length');
		$this->form->percentage = getFromRequest('percentage');
	}

	/**
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->price ) && isset ( $this->form->length ) && isset ( $this->form->percentage ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false;
		}

		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->price == "") {
			getMessages()->addError('Nie podano kwoty kredytu');
		}
		if ($this->form->percentage == "") {
			getMessages()->addError('Nie podano oprocentowania kredytu');
		}
		if ($this->form->length == "") {
			getMessages()->addError('Nie podano długości kredytu');
		}

		// nie ma sensu walidować dalej gdy brak parametrów
		if (! getMessages()->isError()) {

			// sprawdzenie, czy $x i $y są liczbami całkowitymi
			if (! is_numeric ( $this->form->price )) {
				getMessages()->addError('Kwota kredytu nie jest liczbą');
			}
			if (! is_numeric ( $this->form->percentage )) {
				getMessages()->addError('Oprocentowanie nie jest liczbą');
			}
			if (! is_numeric ( $this->form->length )) {
				getMessages()->addError('Długość kredytu nie jest liczbą');
			}
		}

		return ! getMessages()->isError();
	}

	/**
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getParams();

		if ($this->validate()) {

			//konwersja parametrów na int
			$this->form->price = doubleval($this->form->price);
			$this->form->length = doubleval($this->form->length);
			$this->form->percentage = doubleval($this->form->percentage);
			getMessages()->addInfo('Parametry poprawne.');

			//obliczenia
			$this->result->result=($this->form->price + ($this->form->price * $this->form->percentage/100))/($this->form->length * 12);
			getMessages()->addInfo('Wykonano obliczenia.');

		}

		$this->generateView();
	}


	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		//nie trzeba już tworzyć Smarty i przekazywać mu konfiguracji i messages
		// - wszystko załatwia funkcja getSmarty()

		getSmarty()->assign('page_title','Przykład 06a');
		getSmarty()->assign('page_description','Aplikacja z jednym "punktem wejścia". Zmiana w postaci nowej struktury foderów, skryptu inicjalizacji oraz pomocniczych funkcji.');
		getSmarty()->assign('page_header','Kontroler główny');

		getSmarty()->assign('form',$this->form);
		getSmarty()->assign('res',$this->result);

		getSmarty()->display('CalcView.html'); // już nie podajemy pełnej ścieżki - foldery widoków są zdefiniowane przy ładowaniu Smarty
	}
}
