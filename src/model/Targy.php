<?php namespace App\Model;
	class Targy {
		private $nev = null;
		private $tipus = null;
		private $eredmeny = 0;

		public function Nev($nev) {
			$this->nev = $nev;
		}

		public function nev() {
			return $this->nev;
		}

		public function Tiups($tipus) {
			$this->tipus = $tipus;
			return $this;
		}

		public function tipus() {
			return $this->tipus;
		}

		public function Eredmeny($eredmeny) {
			$this->eredmeny = intval(str_replace('%', '', $eredmeny));
		}

		public function eredmeny() {
			return $this->eredmeny;
		}
	}
?>