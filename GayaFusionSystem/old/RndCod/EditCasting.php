<?php	
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<HTML>
<BODY>
<?PHP
//$tabel = $_POST['tabel'];
	//	print_r($_POST);

	$id = $_POST['ID'];
	$UploadDir = "../UploadImg";
	$PicPrefixName = date("Y").date("m").date("j").date("H").date("i").date("s");
	$CastingDate = $_POST['DateField'];
	$CastingNotes    = $_POST['CastingNotes'];
	
	If (!$_FILES['TechDraw']['name'] == null){
		$TechDraw = $PicPrefixName."-".basename($_FILES['TechDraw']['name']);	
		move_uploaded_file($_FILES['TechDraw']['tmp_name'],$UploadDir."/$TechDraw");
		$Update = "UPDATE tblCasting SET tblCasting.CastingTechDraw = '$TechDraw' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo1']['name'] == null){
		$Photo1 = $PicPrefixName."-".basename($_FILES['Photo1']['name']);
		move_uploaded_file($_FILES['Photo1']['tmp_name'],$UploadDir."/$Photo1");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto1 = '$Photo1' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo2']['name'] == null){
		$Photo2 = $PicPrefixName."-".basename($_FILES['Photo2']['name']);
		move_uploaded_file($_FILES['Photo2']['tmp_name'],$UploadDir."/$Photo2");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto2 = '$Photo2' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo3']['name'] == null){
		$Photo3 = $PicPrefixName."-".basename($_FILES['Photo3']['name']);
		move_uploaded_file($_FILES['Photo3']['tmp_name'],$UploadDir."/$Photo3");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto3 = '$Photo3' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo4']['name'] == null){
		$Photo4 = $PicPrefixName."-".basename($_FILES['Photo4']['name']);
		move_uploaded_file($_FILES['Photo4']['tmp_name'],$UploadDir."/$Photo4");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto4 = '$Photo4' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}


	If (!$_POST['DelTechDraw']== null){
		$nama = $_POST["DelTechDraw"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblCasting SET tblCasting.CastingTechDraw = '' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto1']== null){
		$nama = $_POST["DelPhoto1"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto1 = '' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto2']== null){
		$nama = $_POST["DelPhoto2"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto2 = '' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto3']== null){
		$nama = $_POST["DelPhoto3"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto3 = '' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto4']== null){
		$nama = $_POST["DelPhoto4"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblCasting SET tblCasting.CastingPhoto4 = '' where tblCasting.ID = '$id';";
		mysql_query($Update);
	}
	
	
$_rs ="UPDATE tblCasting 
		SET 
		tblCasting.CastingDate = '$CastingDate',  
		tblCasting.CastingNotes    = '$CastingNotes'
	 	WHERE tblCasting.ID = '$id';";
	
	$query=mysql_query($_rs);
	
	if ($query)
	{
		echo "<p>record has been updated click </p> <a href=\"view_rndCasting.php\"> here </a> to continue";
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