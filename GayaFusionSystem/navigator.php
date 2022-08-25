<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php

	function pageNavigator($p_nTotal, $p_nCurrent, $p_nResults, $p_nNavigators, $p_sSeperator) {

		$aReturn = array();

		$nTotal = ((is_numeric($p_nTotal)) ? $p_nTotal : 0);
		$nCurrent = ((is_numeric($p_nCurrent)) ? $p_nCurrent : 1);
		$nResults = ((is_numeric($p_nResults)) ? $p_nResults : $nTotal);
		$sSeperator = ((is_string($p_sSeperator)) ? $p_sSeperator : '...');
		$bPrevious = false;
		$bNext = false;

		//check if number of pages to display is even
		$nNavigators = intval($p_nNavigators);
		$nNavigators = (($nNavigators % 2)?$nNavigators:$nNavigators + 1);

		$nFirstPage = 1;
		$nPages = ceil($p_nTotal / $nResults);
		$nLengthStartEnd = ($nNavigators - 2);
		$nLengthCenter = ($nNavigators - 4);
		$nFirstCenterPosition = floor($nLengthCenter / 2);

		//set previous and next booleans
		if ($nCurrent > $nFirstPage) {
			$aReturn['previous'] = ($nCurrent - 1);
			$aReturn['first'] = $nFirstPage;
		}
		else {
			$aReturn['previous'] = 0;
			$aReturn['first'] = 0;
		}
		if ($nCurrent < $nPages) {
			$aReturn['next'] = ($nCurrent + 1);
			$aReturn['last'] = $nPages;
		}
		else {
			$aReturn['next'] = 0;
			$aReturn['last'] = 0;
		}

		//get current display results
		$aReturn['from'] = (($nCurrent - 1) * $nResults) + 1;
		
		if ($nTotal < ($nCurrent * $nResults)) {
			$aReturn['until'] = $nTotal;
		}
		else {
			$aReturn['until'] = ($nCurrent * $nResults);
		}

		$aReturn['pages'] = array();

		//check if length is lower then number of pages
		if ($nPages <= $nNavigators) {

			for ($nCount = 1; $nCount <= $nPages; $nCount++) {
				$aReturn['pages'][] = $nCount;
			}

		}
		else {

			//create first part of smart navigator
			if ($nCurrent < $nLengthStartEnd) {

				for ($nCount = 1; $nCount <= $nLengthStartEnd; $nCount++) {
					$aReturn['pages'][] = $nCount;
				}
				$aReturn['pages'][] = $sSeperator;
				$aReturn['pages'][] = $nPages;
				
			}

			//create last part of smart navigator
			elseif ($nCurrent > (($nPages - $nLengthStartEnd) + 1)) {

				$aReturn['pages'][] = $nFirstPage;
				$aReturn['pages'][] = $sSeperator;
				for ($nCount = (($nPages - $nLengthStartEnd) + 1); $nCount <= $nPages; $nCount++) {
					$aReturn['pages'][] = $nCount;
				}

			}

			//create second part of smart navigator
			else {

				$aReturn['pages'][] = $nFirstPage;
				$aReturn['pages'][] = $sSeperator;

				for ($nCount = ($nCurrent - $nFirstCenterPosition); $nCount <= ($nCurrent + $nFirstCenterPosition); $nCount++) {
					$aReturn['pages'][] = $nCount;
				}

				$aReturn['pages'][] = $sSeperator;
				$aReturn['pages'][] = $nPages;

			}

		}

		//return result
		return $aReturn;

	}

?>
<?php
$totalpages = $_POST['totalpages'];
	$pagenya = $_POST['pagename'];
	$nPage = 1;
	if (isset($_GET['page'])) {
		$nPage = intval($_GET['page']);
	}
	
	//run the navigator function and return result
	$aNavigator = pageNavigator($totalpages, $nPage, 10, 10, '...');
	
//	echo '<link href="./layout.css" rel="stylesheet" type="text/css" />';
	foreach ($aNavigator['pages'] AS $vKey => $vValue) {

		if (is_numeric($vValue)) {
			if ($vValue == $nPage) {
				echo '<b>'.$vValue.'</b> ';
			}
			else {
				echo '<a href="?page='.$vValue.'">'.$vValue.'</a> ';
			}
		}
		else {
			echo $vValue.' ';
		}
		
	}
?>