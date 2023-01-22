<?php namespace App\Feladat;
	/**
	 * Felvetelizo
	 * 	Főfolyamatokat elvégző osztály
	 * 
	 * 	Tárolja:
	 *  	- 'kovetelmeny': Kovetelmenyrendszer
	 * 		- 'erettsegi_targyak': array(Targy)
	 * 		- 'tobbletpontok': array(Tobbletpont)
	 * 		- 'kotelezo_erettsegi_vizsga_targyak': array(string)
	 * 
	 * 	Function:
	 * 		- Setter
	 *
	 * 		- Talalhato_e__kotelezo_targy: int
	 * 			Végig halad az érettségi tárgyakon és megvizsgélja, hogy megtalálható-e a keresett elem.
	 * 			Ha igen akkor vissza adja az eredményét
	 *
	 * 		- Talalalhato_e__kotelezoen_valaszthato_targy: array
	 * 			Végig halad az érettségi tárgyakon és megvizsgélja, hogy megtalálható-e a keresett elem.
	 * 			Ezen elememeket kirakja egy 'temp' listába és visszatér vele.
	 * 		
	 *		- Talalalhato_e__kotelezo_erettsegi_vizsga_targy: bool
	 * 			Végig halad az érettségi tárgyakon és megvizsgélja, hogy megtalálható-e a keresett elem.
	 * 
	 * 		- validErettsegiEredmeny: array(bool, string) | array(bool)
	 * 			A kötelező érettségi vizsga tárgyakon végig haladva ellenörzi, hogy a minimum követelmények megfelel-e az eredmeny.
	 * 			Ha igen, akkor egy array(bool: true|false) értékkel tér vissza.
	 * 			Minden más esetben array(bool: true|false, string: targy_neve) érték jön vissza.
	 * 
	 * 		- Tobbletpont_szamitas(): int
	 * 			Kiszámolja a többletpont értékét.
	 * 			Elsőként a nyelveket vizsgálom meg, hogy van e közöttük azonos: 
	 * 				- ha nincs, akkor mind két értéket felvezem.
	 * 				- ha van, akkor további vizsgálat jön:
	 * 					- megnézem, hogy azonos-e a két nyelv tipusa (C1 vagy B2):
	 * 						- egyszer kerül felvitelre, ha azonos
	 * 						- ha nem, akkor 'i' és az 'o' indexen lévő nyelvet levizsgálom, hogy melyik a 'C1'.
	 * 						  Bár melyik is a 'C1', akkor a 40-et adja meg.
	 * 			
	 * 			Több tipus esetén bővíteni kell e function-t.
	 * 
	 * 		- Pont: void
	 * 			A tényleges pontszámítás itt történik.
	 * 			Levizsgálja:
	 * 				, hogy az vizsga 'eredmény' 'x>=20', ha nem, akkor visszaadja a tárgy nevét, ami nem érte el a min szintet.
	 * 				, hogy a 'kötelező érettségi vizsgatárgyak' meg vannak-e, ha nincs, akkor visszatér a hiba üzenettel.
	 * 				, hogy a 'kötelező tárgy' és a 'kötelezően választhato tárgy' fellelhető-e a listán, ha vannak ilyenek, 
	 * 					akkor visszatér az eredményeikkel.
	 *			Ha minden feltétel jó, akkor kiszámolja a pontszámot, majd visszatér egy string-gel.
	 */
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

			if (!$this->Talalalhato_e__kotelezo_erettsegi_vizsgatargy()) {
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
			foreach ($this->kovetelmeny->_kotelezo_targy() as $key => $kt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					if ($this->kovetelmeny->description() == "PPKE BTK - Anglisztika") {
						if ($kt == str_replace(' nyelv', '', $et->_nev()) && $et->_tipus() == "emelt") {
							return $et->_eredmeny(); 
						}
					} else {
						if ($kt == $et->_nev()) { 
							return $et->_eredmeny(); 
						}
					}
				}
			}
			return -1;
		}

		private function Talalhato_e__kotelezoen_valaszthato_targy() {
			$tempInt = array(-1);
			$i = 0;

			foreach ($this->kovetelmeny->_kotelezoen_valaszthato_targy() as $key => $kvt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					if ($kvt == $et->_nev()) { 
						$tempInt[$i++] = $et->_eredmeny(); 
					}
				}
			}
			return max($tempInt);
		}

		private function Talalalhato_e__kotelezo_erettsegi_vizsgatargy() {
			$o = 0;
			foreach ($this->kotelezo_erettsegi_vizsga_targyak as $key => $kevt) {
				foreach ($this->erettsegi_targyak as $key => $et) {
					$o += ($et->_nev() == $kevt ? 1 : 0);
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
							if ($this->tobbletpontok[$i]->_nyelv() == $this->tobbletpontok[$o]->_nyelv()) {
								if ($this->tobbletpontok[$i]->_tipus() == $this->tobbletpontok[$o]->_tipus()) {
									$arrayNyelv[$g++] = ($this->tobbletpontok[$o]->_tipus() == "C1" ? 40 : 28);
								} else {
									$arrayNyelv[$g++] = (
										(($this->tobbletpontok[$o]->_tipus() == "C1" || $this->tobbletpontok[$i]->_tipus() == "C1") ? 40 : 28)
									);
								}
							} else {
								$arrayNyelv[$g++] = ($this->tobbletpontok[$o]->_tipus() == "C1" ? 40 : 28);
							}
						}
					}
				}
			} elseif ($tpLength == 1) {
				$arrayNyelv[0] = ($this->tobbletpontok[0]->_tipus() == "C1" ? 40 : 28);
			}

			$c = 0;
			foreach ($this->erettsegi_targyak as $key => $value) {
				if ($value->_tipus() == "emelt") {
					$c++;
				}
			}

			$sum = (array_sum($arrayNyelv) + (50 * $c));

			return $sum > 100 ? 100 : $sum;
		}

		private function validErettsegiEredmeny() {
			foreach ($this->erettsegi_targyak as $key => $et) {
				if (!$et->NEMH()) {
					return array(false, $et->_nev());
				}
			}
			return array(true);
		}

		public function __construct($kotelezo_erettsegi_vizsga_targyak) {
			$this->kotelezo_erettsegi_vizsga_targyak = $kotelezo_erettsegi_vizsga_targyak;
		}
	}
?>