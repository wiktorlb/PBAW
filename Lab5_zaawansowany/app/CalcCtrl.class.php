<?php
// W skrypcie definicji kontrolera nie trzeba dołączać problematycznego skryptu config.php,
// ponieważ będzie on użyty w miejscach, gdzie config.php zostanie już wywołany.

require_once $conf->root_path.'/lib/smarty/Smarty.class.php';
require_once $conf->root_path.'/lib/Messages.class.php';
require_once $conf->root_path.'/app/CalcForm.class.php';
require_once $conf->root_path.'/app/CalcResult.class.php';

/** Kontroler kalkulatora */
class CalcCtrl {

	private $msgs;   //wiadomości dla widoku
	private $form;   //dane formularza (do obliczeń i dla widoku)
	private $result; //inne dane dla widoku
	private $hide_intro; //zmienna informująca o tym czy schować intro

	/**
	 * Konstruktor - inicjalizacja właściwości
	 */
	public function __construct(){
		//stworzenie potrzebnych obiektów
		$this->msgs = new Messages();
		$this->form = new CalcForm();
		$this->result = new CalcResult();
		$this->hide_intro = false;
	}

	/**
	 * Pobranie parametrów
	 */
	public function getParams(){
		$this->form->price = isset($_REQUEST ['price']) ? $_REQUEST ['price'] : null;
		$this->form->length = isset($_REQUEST ['length']) ? $_REQUEST ['length'] : null;
		$this->form->percentage = isset($_REQUEST ['percentage']) ? $_REQUEST ['percentage'] : null;
	}

	/**
	 * Walidacja parametrów
	 * @return true jeśli brak błedów, false w przeciwnym wypadku
	 */
	public function validate() {
		// sprawdzenie, czy parametry zostały przekazane
		if (! (isset ( $this->form->price ) && isset ( $this->form->length ) && isset ( $this->form->percentage ))) {
			// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
			return false; //zakończ walidację z błędem
		} else {
			$this->hide_intro = true; //przyszły pola formularza, więc - schowaj wstęp
		}

		// sprawdzenie, czy potrzebne wartości zostały przekazane
		if ($this->form->price == "") {
			$this->msgs->addError('Nie podano kwoty kredytu');
		}
		if ($this->form->length == "") {
			$this->msgs->addError('Nie podano długości kredytu');
		}
		if ($this->form->percentage == "") {
			$this->msgs->addError('Nie podano oprocentowania');
		}

		// nie ma sensu walidować dalej gdy brak parametrów
		if (! $this->msgs->isError()) {
			// sprawdzenie, czy parametry są liczbami całkowitymi
			if (! is_numeric ( $this->form->price )) {
				$this->msgs->addError('Kwota kredytu nie jest liczbą');
			}
			if (! is_numeric ( $this->form->length )) {
				$this->msgs->addError('Długość kredytu nie jest liczbą');
			}
			if (! is_numeric ( $this->form->percentage )) {
				$this->msgs->addError('Oprocentowanie nie jest liczbą');
			}
		}

		return ! $this->msgs->isError();
	}

	/**
	 * Pobranie wartości, walidacja, obliczenie i wyświetlenie
	 */
	public function process(){

		$this->getparams();

		if ($this->validate()) {

			//konwersja parametrów na int
			$this->form->price = intval($this->form->price);
			$this->form->length = intval($this->form->length);
			$this->form->percentage = intval($this->form->percentage);
			$this->msgs->addInfo('Parametry poprawne.');

			//Obliczenia
			$this->result->result=($this->form->price + ($this->form->price * $this->form->percentage/100))/($this->form->length * 12);
			$this->msgs->addInfo('Wykonano obliczenia.');

		}

		$this->generateView();
	}


	/**
	 * Wygenerowanie widoku
	 */
	public function generateView(){
		global $conf;

		$smarty = new Smarty();
		$smarty->assign('conf',$conf);

		$smarty->assign('hide_intro',$this->hide_intro);

		$smarty->assign('page_title','Przykład 05');
		$smarty->assign('page_description','Obiektowość. Funkcjonalność aplikacji zamknięta w metodach różnych obiektów. Pełen model MVC.');
		$smarty->assign('page_header','Obiekty w PHP');

		$smarty->assign('msgs',$this->msgs);
		$smarty->assign('form',$this->form);
		$smarty->assign('res',$this->result);

		$smarty->display($conf->root_path.'/app/CalcView.html');
	}
}
