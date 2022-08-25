<?php	
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<HTML>
<head>
<META HTTP-EQUIV="refresh" content="1;URL=view_rndSupplier.php">
</head>
<BODY>
<?PHP
//$tabel = $_POST['tabel'];
	//	print_r($_POST);

	$id = $_POST['ID'];
	$SupCompany = $_POST['SupCompany'];
	$SupContact    = $_POST['SupContact'];
	$SupAddress = $_POST['SupAddress'];
	$SupHP    = $_POST['SupHP'];
	$SupOffice = $_POST['SupOffice'];
	$SupFax    = $_POST['SupFax'];
	$SupEmail = $_POST['SupEmail'];
	$SupItems    = $_POST['SupItems'];
	$SupOtherInfo = $_POST['SupOtherInfo'];

$_rs ="UPDATE tblSupplier 
		SET 
		tblSupplier.SupCompany = '$SupCompany',  
		tblSupplier.SupContact    = '$SupContact', 
		tblSupplier.SupAddress = '$SupAddress',  
		tblSupplier.SupHP    = '$SupHP',
		tblSupplier.SupOffice = '$SupOffice',  
		tblSupplier.SupFax    = '$SupFax',
		tblSupplier.SupEmail = '$SupEmail',  
		tblSupplier.SupItems    = '$SupItems',
		tblSupplier.SupOtherInfo    = '$SupOtherInfo'
	 	WHERE tblSupplier.ID = '$id';";
	
	$query=mysql_query($_rs);
	
	if ($query)
	{
		echo "<p>Record Successfuly Updated</p>";
	}
	else
	{
		$sala=mysql_error();
		echo $sala;
	}
	//header("Location:index.php");

?>
</BODY>
</HTML>