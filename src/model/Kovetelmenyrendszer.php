<?php namespace App\Model;
	class Kovetelmenyrendszer {
		private $egyetem = "";
		private $kar = "";
		private $szak = "";

		private $kotelezo_targy = array();
		private $kotelezoen_valaszthato_targy = array();

		public function _egyetem() {
			return $this->egyetem;
		}

		public function _kar() {
			return $this->kar;
		}

		public function _szak() {
			return $this->szak;
		}

		public function description() {
			return ($this->egyetem ." ". $this->kar ." - ". $this->szak);
		}

		public function Kotelezo_targy($kotelezo_targy = array()) {
			$this->kotelezo_targy = $kotelezo_targy;
			return $this;
		}

		public function _kotelezo_targy() {
			return $this->kotelezo_targy;
		}

		public function Kotelezoen_valaszthato_targy($kotelezoen_valaszthato_targy = array()) {
			$this->kotelezoen_valaszthato_targy = $kotelezoen_valaszthato_targy;
			return $this;
		}

		public function _kotelezoen_valaszthato_targy() {
			return $this->kotelezoen_valaszthato_targy;
		}

		public function __construct($egyetem, $kar, $szak) {
			$this->egyetem = $egyetem;
			$this->kar = $kar;
			$this->szak =$szak;
		}
	}
?>