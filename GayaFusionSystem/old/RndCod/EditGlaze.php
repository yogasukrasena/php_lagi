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
	//$sid = 1;
	$UploadDir = "../UploadImg";
	$PicPrefixName = date("Y").date("m").date("j").date("H").date("i").date("s");
	$GlazeDate = $_POST['DateField'];
	$GlazeNotes    = $_POST['GlazeNotes'];	
	If (!$_FILES['TechDraw']['name'] == null){
		$TechDraw = $PicPrefixName."-".basename($_FILES['TechDraw']['name']);	
		move_uploaded_file($_FILES['TechDraw']['tmp_name'],$UploadDir."/$TechDraw");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazeTechDraw = '$TechDraw' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo1']['name'] == null){
		$Photo1 = $PicPrefixName."-".basename($_FILES['Photo1']['name']);
		move_uploaded_file($_FILES['Photo1']['tmp_name'],$UploadDir."/$Photo1");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto1 = '$Photo1' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo2']['name'] == null){
		$Photo2 = $PicPrefixName."-".basename($_FILES['Photo2']['name']);
		move_uploaded_file($_FILES['Photo2']['tmp_name'],$UploadDir."/$Photo2");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto2 = '$Photo2' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo3']['name'] == null){
		$Photo3 = $PicPrefixName."-".basename($_FILES['Photo3']['name']);
		move_uploaded_file($_FILES['Photo3']['tmp_name'],$UploadDir."/$Photo3");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto3 = '$Photo3' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo4']['name'] == null){
		$Photo4 = $PicPrefixName."-".basename($_FILES['Photo4']['name']);
		move_uploaded_file($_FILES['Photo4']['tmp_name'],$UploadDir."/$Photo4");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto4 = '$Photo4' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}


	If (!$_POST['DelTechDraw']== null){
		$nama = $_POST["DelTechDraw"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazeTechDraw = '' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto1']== null){
		$nama = $_POST["DelPhoto1"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto1 = '' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto2']== null){
		$nama = $_POST["DelPhoto2"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto2 = '' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto3']== null){
		$nama = $_POST["DelPhoto3"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto3 = '' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto4']== null){
		$nama = $_POST["DelPhoto4"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblGlaze SET tblGlaze.GlazePhoto4 = '' where tblGlaze.ID = '$id';";
		mysql_query($Update);
	}
$_rs ="UPDATE tblGlaze 
		SET 
		tblGlaze.GlazeDate = '$GlazeDate',  
		tblGlaze.GlazeNotes    = '$GlazeNotes'
	 	WHERE tblGlaze.ID = '$id';";
	
	$query=mysql_query($_rs);
	
	if ($query)
	{
		echo "<p>record has been updated click </p> <a href=\"view_rndglaze.php\"> here </a> to continue";
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