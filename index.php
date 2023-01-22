<?php
	require './homework_input.php';

	require './src/model/Targy.php';
	require './src/model/Tobbletpont.php';
	require './src/model/Kovetelmenyrendszer.php';
	require './src/Felvetelizo.php';

	/*\ START MAIN \*/
	$list = array(
		$exampleData, $exampleData1, $exampleData2, $exampleData3, // ELTE
		$my_exampleData, $my_exampleData1, $my_exampleData2, $my_exampleData3 // PPKE
	);

	$felvetelizok = array();
	print("\$exampleDatas:<br>");
	/*\ START INIT \*/
	foreach ($list as $k => $v) {
		$felvetelizok[$k] = (
			(new App\Feladat\Felvetelizo(array("magyar nyelv és irodalom", "történelem", "matematika")))->Kovetelmeny(
				new App\Model\Kovetelmenyrendszer($v['valasztott-szak']['egyetem'], $v['valasztott-szak']['kar'], $v['valasztott-szak']['szak'])
			));
		
		($felvetelizok[$k]->_kovetelmeny()
			->Kotelezo_targy((
				$felvetelizok[$k]->_kovetelmeny()->description() == "ELTE IK - Programtervező informatikus" ?
				array("matematika") : array("angol")
			))
			->Kotelezoen_valaszthato_targy((
				$felvetelizok[$k]->_kovetelmeny()->description() == "ELTE IK - Programtervező informatikus" ?
				array("biológia", "fizika", "informatika", "kémia") : array("francia", "német", "olasz", "orosz", "spanyol", "történelem")
			)));

		if (count($v['erettsegi-eredmenyek']) > 0) {
			foreach ($v['erettsegi-eredmenyek'] as $vk => $vv) {
				$felvetelizok[$k]->Erettsegi_targyak($vk, 
					new App\Model\Targy($vv['nev'], $vv['tipus'], $vv['eredmeny'])
				);
			}
		}

		if (count($v['tobbletpontok']) > 0) {
			foreach ($v['tobbletpontok'] as $vk => $vv) {
				$felvetelizok[$k]->Tobbletpontok($vk, 
					new App\Model\Tobbletpont($vv['kategoria'], $vv['tipus'], $vv['nyelv'])
				);
			}
		}

		print(($k == 3 ? "<br>\$my_exampleDatas:<br>" : "").$felvetelizok[$k]->Pont());
	}
	/*\ END INIT \*/
	/*\ END MAIN \*/
?>