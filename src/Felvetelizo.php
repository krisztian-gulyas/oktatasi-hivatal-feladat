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

		public function Pont() {
			$vee = $this->validErettsegiEredmeny();

			if (!$vee[0]) {
				print("Hiba, nem lehetséges a pontszámítás a '".$vee[1]."' tárgyból elért 20% alatti eredmény miatt."."<br>");
				return;
			}

			if (!$this->Talalalhato_e__kotelezo_erettsegi_vizsga_targy()) {
				print("Hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt."."<br>");
				return;
			}

			$kotelezo_targy_pont = $this->Talalhato_e__kotelezo_targy();
			$kotelezoen_valaszthato_targy_pont = $this->Talalhato_e__kotelezoen_valaszthato_targy();

			if ($kotelezo_targy_pont < 0 || $kotelezoen_valaszthato_targy_pont < 0) {
				print("Hiba, nem lehetséges a pontszámítás, mivel a kötelező tárgy, vagy a kötelezően választható tárgy(ak) hiánya miatt."."<br>");
				return;
			}

			$alappont = ($kotelezo_targy_pont + $kotelezoen_valaszthato_targy_pont) * 2;
			$tobbletpont = $this->Tobbletpont_szamitas();
			$sum = $alappont + $tobbletpont;

			print($sum ." (". $alappont ." alappont + ". $tobbletpont ." többletpont)<br>");
		}

		private function Talalhato_e__kotelezo_targy() {
			foreach ($this->kovetelmeny->Kotelezo_targy() as $key => $kt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					if ($this->kovetelmeny->Description() == "PPKE BTK - Anglisztika") {
						if ($kt == str_replace(' nyelv', '', $et->Nev()) && $et->Tipus() == "emelt") {
							return $et->Eredmeny(); 
						}
					} else {
						if ($kt == $et->Nev()) { 
							return $et->Eredmeny(); 
						}
					}
				}
			}
			return -1;
		}

		private function Talalhato_e__kotelezoen_valaszthato_targy() {
			$tempInt = array(-1);
			$i = 0;

			foreach ($this->kovetelmeny->Kotelezoen_valaszthato_targy() as $key => $kvt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					if ($kvt == $et->Nev()) { 
						$tempInt[$i++] = $et->Eredmeny(); 
					}
				}
			}
			return max($tempInt);
		}

		private function Talalalhato_e__kotelezo_erettsegi_vizsga_targy() {
			$o = 0;
			foreach ($this->kotelezo_erettsegi_vizsga_targyak as $key => $kevt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					$o += ($et->Nev() == $kevt ? 1 : 0);
				}
			}
			return (count($this->kotelezo_erettsegi_vizsga_targyak) == $o);
		}

		private function Tobbletpont_szamitas() {
			$arrayNyelv = array();
			$tpLength = count($this->tobbletpontok);

			if ($tpLength > 1) {
				$g = 0;
				for ($i = 0; $i < $tpLength; $i++) { 
					for ($o = 0; $o < $tpLength; $o++) { 
						if ($i != $o) {
							if ($this->tobbletpontok[$i]->Nyelv() == $this->tobbletpontok[$o]->Nyelv()) {
								if ($this->tobbletpontok[$i]->NyelvTipus() == $this->tobbletpontok[$o]->NyelvTipus()) {
									$arrayNyelv[$g++] = ($this->tobbletpontok[$o]->NyelvTipus() == "C1" ? 40 : 28);
								} else {
									$arrayNyelv[$g++] = (
										(($this->tobbletpontok[$o]->NyelvTipus() == "C1" || $this->tobbletpontok[$i]->NyelvTipus() == "C1") ? 40 : 28)
									);
								}
							} else {
								$arrayNyelv[$g++] = ($this->tobbletpontok[$o]->NyelvTipus() == "C1" ? 40 : 28);
							}
						}
					}
				}
			} elseif ($tpLength == 1) {
				$arrayNyelv[0] = ($this->tobbletpontok[0]->NyelvTipus() == "C1" ? 40 : 28);
			}

			$c = 0;
			foreach ($this->erettsegi_targyak as $key => $value) {
				if ($value->Tipus() == "emelt") {
					$c++;
				}
			}

			$sum = (array_sum($arrayNyelv) + (50 * $c));

			return $sum > 100 ? 100 : $sum;
		}

		private function validErettsegiEredmeny() {
			foreach ($this->erettsegi_targyak as $key => $et) {
				if (!$et->NEMH()) {
					return array(false, $et->Nev());
				}
			}
			return array(true);
		}

		public function __construct($kotelezo_erettsegi_vizsga_targyak) {
			$this->kotelezo_erettsegi_vizsga_targyak = $kotelezo_erettsegi_vizsga_targyak;
		}
	}
?>