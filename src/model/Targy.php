<?php namespace App\Model;
	class Targy {
		private $nev = null;
		private $tipus = null;
		private $eredmeny = 0;

		public function _nev() {
			return $this->nev;
		}

		public function _tipus() {
			return $this->tipus;
		}

		public function _eredmeny() {
			return $this->eredmeny;
		}

		public function NEMH() {
			return $this->eredmeny >= 20;
		}

		public function __construct($nev, $tipus, $eredmeny) {
			$this->nev = $nev;
			$this->tipus = $tipus;
			$this->eredmeny = intval(str_replace('%', '', $eredmeny));
		}
	}
?>