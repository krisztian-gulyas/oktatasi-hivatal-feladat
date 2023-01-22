<?php namespace App\Feladat;
	class Felvetelizo {
		private $kovetelmeny = null;
		private $erettsegi_targyak = array();
		private $tobbletpontok = array();
		private $kotelezo_erettsegi_vizsga_targyak = array();

		public function Kovetelmeny($kovetelmeny) {
			$this->kovetelmeny = $kovetelmeny;
			return $this;
		}

		public function _kovetelmeny() {
			return $this->kovetelmeny;
		}

		public function Erettsegi_targyak($index, $erettsegi_targy) {
			$this->erettsegi_targyak[$index] = $erettsegi_targy;
		}

		public function Tobbletpontok($index, $tobbletpont) {
			$this->tobbletpontok[$index] = $tobbletpont;
		}
	}
?>