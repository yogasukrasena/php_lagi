<?php	
session_start();
include_once("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
//$tabel=$_POST['namatabel'];
//$field1=$_POST['field1'];
//$field2=$_POST['field2'];
//$field1_value=$_POST['code'];
//$field2_value=$_POST['desc'];

function searching($tabel, $field1, $field2, $field1_value, $field2_value){
	//$aReturn = array();
	If ((($field1 == '') || ($field1 == null))&& (($field2 == '') || ($field2 == null))){
		$query="select * from $tabel";
	}
	elseIf ((($field1 !== '') || ($field1 !== null))&& (($field2 == '') || ($field2 == null))){
		$query="select * from $tabel where $field1 = $field1_value";
	}
	elseif ((($field2 !== '') || ($field2 !== null))&&(($field1 == '') || ($field1 == null))){
		$query="select * from $tabel where $field2 LIKE '%$field2_value%'";
	}
	elseif ((($field1 !== '') || ($field1 !== null))&&(($field2 !== '') || ($field2 !== null))){
		$query="select * from $tabel where $field1 = $field1_value AND $field2 = $field2_value";
	}
	$jalanquery=mysql_query($query);
	//$hasilquery=mysql_fetch_array($jalanquery);
	//$jumlahquery=mysql_num_rows($query);
	//$aReturn['jumlah']=$jumlahquery;
	//$aReturn['hasil']=$hasilquery;
	
	return $jalanquery;
}
?>
