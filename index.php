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
	foreach ($list as $k => $v) {
		$felvetelizok[$k] = new App\Feladat\Felvetelizo($v);
		print($felvetelizok[$k]);
	}
	/*\ END MAIN \*/
?>