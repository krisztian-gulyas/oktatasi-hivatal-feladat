<?php namespace App\Model;
	class Tobbletpont {
		private $kategoria;
		private $tiups;
		private $nyelv;

		public function _kategoria() {
			return $this->kategoria;
		}

		public function _tipus() {
			return $this->tipus;
		}

		public function _nyelv() {
			return $this->nyelv;
		}

		public function __construct($kategoria, $tipus, $nyelv) {
			$this->kategoria = $kategoria;
			$this->tipus = $tipus;
			$this->nyelv = $nyelv;
		}
	}
?>