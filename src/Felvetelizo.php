<?php namespace App\Feladat;
	class Felvetelizo {
		private Kovetelmenyrendszer $kovetelmeny;
		private $erettsegi_targyak = array();
		private $tobbletpontok = array();
		private $kotelezo_erettsegi_vizsga_targyak = array();

		public function Kovetelmeny($kovetelmeny) {
			$this->kovetelmeny = $kovetelmeny;
			return $this;
		}

		public function Erettsegi_targyak($erettsegi_targyak) {
			$this->erettsegi_targyak = $erettsegi_targyak;
			return $this;
		}

		public function Tobbletpontok($tobbletpontok) {
			$this->tobbletpontok = $tobbletpontok;
			return $this;
		}
	}
?>