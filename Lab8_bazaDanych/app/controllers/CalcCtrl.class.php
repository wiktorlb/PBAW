<?php

namespace app\controllers;

use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl {

    private $form;
    private $msgs;
    private $result;

    public function __construct(){

        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function getParams(){
        $this->form->kwota = isset($_REQUEST ['kwota']) ? $_REQUEST ['kwota'] : null;
        $this->form->oprocentowanie = isset($_REQUEST ['oprocentowanie']) ? $_REQUEST ['oprocentowanie'] : null;
        $this->form->dlugosc = isset($_REQUEST ['dlugosc']) ? $_REQUEST ['dlugosc'] : null;
    }
    public function validate() {
        // sprawdzenie, czy parametry zostały przekazane
        if (! (isset ( $this->form->kwota ) && isset ( $this->form->oprocentowanie ) && isset ( $this->form->dlugosc ))) {
            // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
            return false;
        }

        // sprawdzenie, czy potrzebne wartości zostały przekazane
        if ($this->form->kwota == "") {
            getMessages()->addError('Nie podano kwoty');
        }
        if ($this->form->oprocentowanie == "") {
            getMessages()->addError('Nie podano oprocentowania');
        }
        if ($this->form->dlugosc == "") {
            getMessages()->addError('Nie podano dlugosci');
        }



        if (! getMessages()->isError()) {


            if (! is_numeric ( $this->form->kwota )) {
                getMessages()->addError('Kwota nie jest liczbą całkowitą');
            }

            if (! is_numeric ( $this->form->oprocentowanie )) {
                getMessages()->addError('Oprocentowanie nie jest liczbą całkowitą');
            }
            if (! is_numeric ( $this->form->dlugosc )) {
                getMessages()->addError('Długość nie jest liczbą całkowitą');
            }
        }

        return ! getMessages()->isError();
    }
    public function action_CalcProcess(){

        $this->getparams();

        if ($this->validate()) {

            //konwersja parametrów na int
            $this->form->kwota = intval($this->form->kwota);
            $this->form->oprocentowanie = intval($this->form->oprocentowanie);
            $this->form->dlugosc = intval($this->form->dlugosc);
            getMessages()->addInfo('Parametry poprawne.');

            //obliczanie
            $this->result->result = ($this->form->kwota + $this->form->kwota * ($this->form->oprocentowanie /100)) / ($this->form->dlugosc * 12);

            getMessages()->addInfo('Wykonano obliczenia.');
        }
        $this->generateView();
    }
    public function action_CalcCtrl(){
        $this->generateView();
    }
    public function generateView(){
        getSmarty()->assign('form',$this->form);
        getSmarty()->assign('res',$this->result);

        getSmarty()->display('CalcView.tpl');
    }
}