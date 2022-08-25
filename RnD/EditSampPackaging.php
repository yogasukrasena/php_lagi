<?php	
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
?>
<HTML>
<head>
<META HTTP-EQUIV="refresh" content="1;URL=view_rndsampPackaging.php">
</head>
<BODY>
<?PHP
	$id = $_POST['ID'];
	//$id = 1;
	$UploadDir = "../UploadImg";
	$PicPrefixName = date("Y").date("m").date("j").date("H").date("i").date("s");
	$SampleDate = $_POST['DateField'];
	$DesMat1 = $_POST['DesMat1'];
	$DesMat2 = $_POST['DesMat2'];
	$DesMat3 = $_POST['DesMat3'];
	$DesMat4 = $_POST['DesMat4'];
	$DesMat5 = $_POST['DesMat5'];
	$QtyDesMat1 = $_POST['QtyDesMat1'];
	$QtyDesMat2    = $_POST['QtyDesMat2'];
	$QtyDesMat3   = $_POST['QtyDesMat3'];
	$QtyDesMat4 = $_POST['QtyDesMat4'];
	$QtyDesMat5 = $_POST['QtyDesMat5'];
	//$DesMatUnit1 = $_POST['DesMatUnit1']; kalo ini jadi var, rada bingung di total price,krn, jg tgantng unit price
	$TotalDesMat1 = $_POST['TotalDesMat1'];
	$TotalDesMat2    = $_POST['TotalDesMat2'];
	$TotalDesMat3   = $_POST['TotalDesMat3'];
	$TotalDesMat4 = $_POST['TotalDesMat4'];
	$TotalDesMat5 = $_POST['TotalDesMat5'];
	$Supplier1 = $_POST['Supplier1'];
	$Supplier2 = $_POST['Supplier2'];
	$Supplier3 = $_POST['Supplier3'];
	$Supplier4 = $_POST['Supplier4'];
	$Supplier5 = $_POST['Supplier5'];
	$Material1 = $_POST['Material1'];
	$Material2 = $_POST['Material2'];
	$Material3 = $_POST['Material3'];
	$Material4 = $_POST['Material4'];
	$Material5 = $_POST['Material5'];
	$Color1 = $_POST['Color1'];
	$Color2 = $_POST['Color2'];
	$Color3 = $_POST['Color3'];
	$Color4 = $_POST['Color4'];
	$Color5 = $_POST['Color5'];
	$CostPrice1 = $_POST['CostPrice1'];
	$CostPrice2 = $_POST['CostPrice2'];
	$CostPrice3 = $_POST['CostPrice3'];
	$CostPrice4 = $_POST['CostPrice4'];
	$CostPrice5 = $_POST['CostPrice5'];
	$TotalDesMat = $TotalDesMat1 + $TotalDesMat2 + $TotalDesMat3 + $TotalDesMat4 + $TotalDesMat5 ;
	$TotalCostPrice = $CostPrice1 + $CostPrice2 + $CostPrice3 + $CostPrice4 + $CostPrice5 ;
	$TotalCost = $TotalDesMat + $TotalCostPrice;
	$InnerQty = $_POST['InnerQty'];
	$Width  = $_POST['Width'];
	$Height = $_POST['Height'];
	$Length = $_POST['Length'];
	$Diameter = $_POST['Diameter'];
	//$Volume
	If ((!$Diameter == NULL) || (!$Diameter == 0) ){
		$Volume=(3.14 * 2 * $Diameter);
	}elseif (((!$Width == NULL) || (!$Width == 0)) && ((!$Height == NULL) || (!$Height == 0)) && ((!$Length == NULL) || (!$Length == 0))){
		$Volume=$Width*$Height*$Length;
	}
	$Weight = $_POST['Weight'];
	$Notes    = $_POST['Notes'];
	
	If (!$_FILES['TechDraw']['name'] == null){
		$TechDraw = $PicPrefixName."-".basename($_FILES['TechDraw']['name']);	
		move_uploaded_file($_FILES['TechDraw']['tmp_name'],$UploadDir."/$TechDraw");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.TechDraw = '$TechDraw' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo1']['name'] == null){
		$Photo1 = $PicPrefixName."-".basename($_FILES['Photo1']['name']);
		move_uploaded_file($_FILES['Photo1']['tmp_name'],$UploadDir."/$Photo1");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo1 = '$Photo1' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo2']['name'] == null){
		$Photo2 = $PicPrefixName."-".basename($_FILES['Photo2']['name']);
		move_uploaded_file($_FILES['Photo2']['tmp_name'],$UploadDir."/$Photo2");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo2 = '$Photo2' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo3']['name'] == null){
		$Photo3 = $PicPrefixName."-".basename($_FILES['Photo3']['name']);
		move_uploaded_file($_FILES['Photo3']['tmp_name'],$UploadDir."/$Photo3");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo3 = '$Photo3' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo4']['name'] == null){
		$Photo4 = $PicPrefixName."-".basename($_FILES['Photo4']['name']);
		move_uploaded_file($_FILES['Photo4']['tmp_name'],$UploadDir."/$Photo4");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo4 = '$Photo4' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}


	If (!$_POST['DelTechDraw']== null){
		$nama = $_POST["DelTechDraw"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.TechDraw = '' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto1']== null){
		$nama = $_POST["DelPhoto1"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo1 = '' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto2']== null){
		$nama = $_POST["DelPhoto2"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo2 = '' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto3']== null){
		$nama = $_POST["DelPhoto3"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo3 = '' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto4']== null){
		$nama = $_POST["DelPhoto4"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SamplePackaging SET SamplePackaging.Photo4 = '' where SamplePackaging.ID = '$id';";
		mysql_query($Update);
	}
	If (!$_POST['DelDesMat1']== null){
		$DesMat1 = '';
		$QtyDesMat1 = '';
		$TotalDesMat1 = '';
	}
	If (!$_POST['DelDesMat2']== null){
		$DesMat2 = '';
		$QtyDesMat2 = '';
		$TotalDesMat2 = '';
	}
	If (!$_POST['DelDesMat3']== null){
		$DesMat3 = '';
		$QtyDesMat3 = '';
		$TotalDesMat3 = '';
	}
	If (!$_POST['DelDesMat4']== null){
		$DesMat4 = '';
		$QtyDesMat4 = '';
		$TotalDesMat4 = '';
	}
	If (!$_POST['DelDesMat5']== null){
		$DesMat5 = '';
		$QtyDesMat5 = '';
		$TotalDesMat5 = '';
	}
	If (!$_POST['DelSupplier1']== null){
		$Supplier1= '';
		$Material1 = '';
		$Color1 = '';
		$CostPrice1 = '';
	}
	If (!$_POST['DelSupplier2']== null){
		$Supplier2= '';
		$Material2 = '';
		$Color2 = '';
		$CostPrice2 = '';
	}
	If (!$_POST['DelSupplier3']== null){
		$Supplier3= '';
		$Material3 = '';
		$Color3 = '';
		$CostPrice3 = '';
	}
	If (!$_POST['DelSupplier4']== null){
		$Supplier4= '';
		$Material4 = '';
		$Color4 = '';
		$CostPrice4 = '';
	}
	If (!$_POST['DelSupplier5']== null){
		$Supplier5= '';
		$Material5 = '';
		$Color5 = '';
		$CostPrice5 = '';
	}					
$_rs ="UPDATE SamplePackaging 
		SET 
		SamplePackaging.SampleDate = '$SampleDate',  
	SamplePackaging.DesMat1 = '$DesMat1', 
	SamplePackaging.DesMat2    = '$DesMat2', 
	SamplePackaging.DesMat3   = '$DesMat3', 
	SamplePackaging.DesMat4= '$DesMat4', 
	SamplePackaging.DesMat5 = '$DesMat5', 
	SamplePackaging.QtyDesMat1 = '$QtyDesMat1', 
	SamplePackaging.QtyDesMat2    = '$QtyDesMat2', 
	SamplePackaging.QtyDesMat3   = '$QtyDesMat3', 
	SamplePackaging.QtyDesMat4 = '$QtyDesMat4', 
	SamplePackaging.QtyDesMat5 = '$QtyDesMat5', 
	SamplePackaging.TotalDesMat1 = '$TotalDesMat1', 
	SamplePackaging.TotalDesMat2    = '$TotalDesMat2', 
	SamplePackaging.TotalDesMat3   = '$TotalDesMat3', 
	SamplePackaging.TotalDesMat4 = '$TotalDesMat4', 
	SamplePackaging.TotalDesMat5 = '$TotalDesMat5', 
	SamplePackaging.Supplier1 = '$Supplier1', 
	SamplePackaging.Supplier2    = '$Supplier2', 
	SamplePackaging.Supplier3   = '$Supplier3', 
	SamplePackaging.Supplier4 = '$Supplier4', 
	SamplePackaging.Supplier5 = '$Supplier5', 
	SamplePackaging.Material1 = '$Material1', 
	SamplePackaging.Material2 = '$Material2', 
	SamplePackaging.Material3 = '$Material3', 
	SamplePackaging.Material4 = '$Material4', 
	SamplePackaging.Material5 = '$Material5', 
	SamplePackaging.Color1 = '$Color1', 
	SamplePackaging.Color2 = '$Color2', 
	SamplePackaging.Color3 = '$Color3', 
	SamplePackaging.Color4 = '$Color4', 
	SamplePackaging.Color5 = '$Color5', 
	SamplePackaging.CostPrice1 = '$CostPrice1', 
	SamplePackaging.CostPrice2 = '$CostPrice2', 
	SamplePackaging.CostPrice3 = '$CostPrice3', 
	SamplePackaging.CostPrice4 = '$CostPrice4', 
	SamplePackaging.CostPrice5 = '$CostPrice5', 
	SamplePackaging.TotalDesMat = '$TotalDesMat', 
	SamplePackaging.TotalCostPrice = '$TotalCostPrice', 
	SamplePackaging.TotalCost = '$TotalCost', 
	SamplePackaging.InnerQty = '$InnerQty', 
	SamplePackaging.Width    = '$Width', 
	SamplePackaging.Height   = '$Height', 
	SamplePackaging.Length = '$Length', 
	SamplePackaging.Diameter = '$Diameter', 
	SamplePackaging.Volume = '$Volume', 
	SamplePackaging.Weight    = '$Weight', 
	SamplePackaging.Notes    = '$Notes' 
	 WHERE SamplePackaging.ID = '$id';";
	
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