<?php namespace App\Model;
	class Kovetelmenyrendszer {
		private $egyetem = "";
		private $kar = "";
		private $szak = "";

		private $kotelezo_targy = array();
		private $kotelezoen_valaszthato_targy = array();

		public function Egyetem($egyetem) {
			$this->egyetem = $egyetem;
			return $this;
		}

		public function egyetem() {
			return $this->egyetem;
		}

		public function Kar($kar) {
			$this->kar = $kar;
			return $this;
		}

		public function kar() {
			return $this->kar;
		}

		public function Szak($szak) {
			$this->szak = $szak;
			return $this;
		}

		public function szak() {
			return $this->szak;
		}

		public function description() {
			return ($this->egyetem ." ". $this->kar ." - ". $this->szak);
		}

		public function Kotelezo_targy($kotelezo_targy = array()) {
			$this->kotelezo_targy = $kotelezo_targy;
			return $this;
		}

		public function kotelezo_targy() {
			return $this->kotelezo_targy;
		}

		public function Kotelezoen_valaszthato_targy($kotelezoen_valaszthato_targy = array()) {
			$this->kotelezoen_valaszthato_targy = $kotelezoen_valaszthato_targy;
			return $this;
		}

		public function kotelezoen_valaszthato_targy() {
			return $this->kotelezoen_valaszthato_targy;
		}
	}
?>