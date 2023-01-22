<?php namespace App\Model;
	class Tobbletpont {
		private $kategoria;
		private $tiups;
		private $nyelv;

		public function Kategoria($kategoria) {
			$this->kategoria = $kategoria;
			return $this;
		}

		public function kategoria() {
			return $this->kategoria;
		}

		public function Tiups($tipus) {
			$this->tipus = $tipus;
			return $this;
		}

		public function tpus() {
			return $this->tipus;
		}

		public function Nyelv($nyelv) {
			$this->nyelv = $nyelv;
			return $this;
		}

		public function nyelv() {
			return $this->nyelv;
		}
	}
?>