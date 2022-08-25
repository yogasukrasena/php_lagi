
<?php

	//include required file
	require_once('./navigator.php');
	
	
	//previous and next buttons
	echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
	if ($aNavigator['first'] != 0) {
		echo '<a href="?page='.$aNavigator['first'].'">First</a> ';
	}
	if ($aNavigator['previous'] != 0) {
		echo '<a href="?page='.$aNavigator['previous'].'">Previous</a> ';
	}
	if ($aNavigator['next'] != 0) {
		echo '<a href="?page='.$aNavigator['next'].'">Next</a> ';
	}
	if ($aNavigator['last'] != 0) {
		echo '<a href="?page='.$aNavigator['last'].'">Last</a> ';
	}
	
	echo '&nbsp;&nbsp;|&nbsp;&nbsp;';
	echo '<b>'.$aNavigator['from'].'</b> - <b>'.$aNavigator['until'].'</b>';
	
?>