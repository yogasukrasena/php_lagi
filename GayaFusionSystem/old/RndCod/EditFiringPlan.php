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
	$FiringPlanDate = $_POST['DateField'];
	$FiringPlanNotes    = $_POST['FiringPlanNotes'];
	
	If (!$_FILES['TechDraw']['name'] == null){
		$TechDraw = $PicPrefixName."-".basename($_FILES['TechDraw']['name']);	
		move_uploaded_file($_FILES['TechDraw']['tmp_name'],$UploadDir."/$TechDraw");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanTechDraw = '$TechDraw' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo1']['name'] == null){
		$Photo1 = $PicPrefixName."-".basename($_FILES['Photo1']['name']);
		move_uploaded_file($_FILES['Photo1']['tmp_name'],$UploadDir."/$Photo1");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto1 = '$Photo1' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo2']['name'] == null){
		$Photo2 = $PicPrefixName."-".basename($_FILES['Photo2']['name']);
		move_uploaded_file($_FILES['Photo2']['tmp_name'],$UploadDir."/$Photo2");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto2 = '$Photo2' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo3']['name'] == null){
		$Photo3 = $PicPrefixName."-".basename($_FILES['Photo3']['name']);
		move_uploaded_file($_FILES['Photo3']['tmp_name'],$UploadDir."/$Photo3");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto3 = '$Photo3' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo4']['name'] == null){
		$Photo4 = $PicPrefixName."-".basename($_FILES['Photo4']['name']);
		move_uploaded_file($_FILES['Photo4']['tmp_name'],$UploadDir."/$Photo4");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto4 = '$Photo4' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}


	If (!$_POST['DelTechDraw']== null){
		$nama = $_POST["DelTechDraw"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanTechDraw = '' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto1']== null){
		$nama = $_POST["DelPhoto1"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto1 = '' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto2']== null){
		$nama = $_POST["DelPhoto2"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto2 = '' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto3']== null){
		$nama = $_POST["DelPhoto3"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto3 = '' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto4']== null){
		$nama = $_POST["DelPhoto4"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE tblFiringPlan SET tblFiringPlan.FiringPlanPhoto4 = '' where tblFiringPlan.ID = '$id';";
		mysql_query($Update);
	}
	
$_rs ="UPDATE tblFiringPlan 
			SET 
			tblFiringPlan.FiringPlanDate = '$FiringPlanDate',  
	tblFiringPlan.FiringPlanNotes    = '$FiringPlanNotes'
	 WHERE tblFiringPlan.ID = '$id';";
	
	$query=mysql_query($_rs);
	
	if ($query)
	{
		echo "<p>record has been updated click </p> <a href=\"view_rndFiringPlan.php\"> here </a> to continue";
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