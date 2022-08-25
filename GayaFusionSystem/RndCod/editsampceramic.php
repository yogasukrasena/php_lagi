<?php
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	//header("location: ../index.php");
	die;
}	
?>
<HTML>
<head>
<META HTTP-EQUIV="refresh" content="1;URL=view_rndsampceramic.php">
</head>
<BODY>
<?PHP
	$sid = $_POST['sID'];
	$UploadDir = "../UploadImg";
	$PicPrefixName = date("Y").date("m").date("j").date("H").date("i").date("s");
	
	$ClientCode = $_POST['ClientCode'];
	$ClientDesc = $_POST['ClientDescription'];
	$SampleDate = $_POST['DateField'];
	$Reference = $_POST['Reference'];
	$ReferenceNotes    = $_POST['RefNotes'];
	$Clay   = $_POST['Clay'];
	$ClayKG = $_POST['ClayKG'];
	$ClayNotes = $_POST['ClayNote'];
	$BuildTech = $_POST['BuildTech'];
	$BuildTechNotes    = $_POST['BuildTechNotes'];
	$Rim   = $_POST['Rim'];
	$Feet = $_POST['Feet'];
	$Casting1 = $_POST['Casting1'];
	$Casting2 = $_POST['Casting2'];
	$Casting3 = $_POST['Casting3'];
	$Casting4 = $_POST['Casting4'];
	$CastingNotes = $_POST['CastingNotes'];
	$Estruder1 = $_POST['Estruder1'];
	$Estruder2 = $_POST['Estruder2'];
	$Estruder3 = $_POST['Estruder3'];
	$Estruder4 = $_POST['Estruder4'];
	$EstruderNotes = $_POST['EstruderNotes'];
	$Texture1 = $_POST['Texture1'];
	$Texture2 = $_POST['Texture2'];
	$Texture3 = $_POST['Texture3'];
	$Texture4 = $_POST['Texture4'];
	$TextureNotes = $_POST['TextureNotes'];
	$Tools1 = $_POST['Tools1'];
	$Tools2 = $_POST['Tools2'];
	$Tools3    = $_POST['Tools3'];
	$Tools4   = $_POST['Tools4'];
	$ToolsNotes = $_POST['ToolsNotes'];
	$Engobe1 = $_POST['Engobe1'];
	$Engobe2 = $_POST['Engobe2'];
	$Engobe3 = $_POST['Engobe3'];
	$Engobe4 = $_POST['Engobe4'];
	$EngobeNotes = $_POST['EngobeNotes'];
	$BisqueTemp = $_POST['BisqueTemp'];
	$StainOxide1 = $_POST['StainOxide1'];
	$StainOxide2 = $_POST['StainOxide2'];
	$StainOxide3 = $_POST['StainOxide3'];
	$StainOxide4 = $_POST['StainOxide4'];
	$StainOxideNotes = $_POST['StainOxideNotes'];
	$Glaze1 = $_POST['Glaze1'];
	$Glaze2 = $_POST['Glaze2'];
	$Glaze3 = $_POST['Glaze3'];
	$Glaze4 = $_POST['Glaze4'];
	$GlazeDensity1 = $_POST['GlazeDensity1'];
	$GlazeDensity2 = $_POST['GlazeDensity2'];
	$GlazeDensity3 = $_POST['GlazeDensity3'];
	$GlazeDensity4 = $_POST['GlazeDensity4'];
	$GlazeNotes  = $_POST['GlazeNotes'];
	$GlazeTemp = $_POST['GlazeTemp'];
	$Firing = $_POST['Firing'];
	$FiringNotes = $_POST['FiringNotes'];
	$Width    = $_POST['Width'];
	$Height   = $_POST['Height'];
	$Length = $_POST['Length'];
	$Diameter = $_POST['Diameter'];
	//$SampCeramicVolume=> && ((!$Height == NULL) || (!$Height == 0)) 
	If ((!$Diameter == NULL) || (!$Diameter == 0) ){
		$SampCeramicVolume=(3.14 * 2 * $Diameter);
	}elseif (((!$Width == NULL) || (!$Width == 0)) && ((!$Length == NULL) || (!$Length == 0))){
		$SampCeramicVolume=$Width*$Height*$Length;
	}
	$FinalSizeNotes    = $_POST['FinalSizeNotes'];
	$DesignMat1 = $_POST['DesignMat1'];
	$DesignMat2 = $_POST['DesignMat2'];
	$DesignMat3 = $_POST['DesignMat3'];
	$DesignMat4 = $_POST['DesignMat4'];
	$DesignMatQty1 = $_POST['DesignMatQty1'];
	$DesignMatQty2 = $_POST['DesignMatQty2'];
	$DesignMatQty3 = $_POST['DesignMatQty3'];
	$DesignMatQty4 = $_POST['DesignMatQty4'];
	$DesignMatNotes = $_POST['DesignMatNotes'];
	$History    = $_POST['History'];
	
	If (!$_FILES['TechDraw']['name'] == null){
		$TechDraw = $PicPrefixName."-".basename($_FILES['TechDraw']['name']);	
		move_uploaded_file($_FILES['TechDraw']['tmp_name'],$UploadDir."/$TechDraw");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.TechDraw = '$TechDraw' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo1']['name'] == null){
		$Photo1 = $PicPrefixName."-".basename($_FILES['Photo1']['name']);
		move_uploaded_file($_FILES['Photo1']['tmp_name'],$UploadDir."/$Photo1");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo1 = '$Photo1' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo2']['name'] == null){
		$Photo2 = $PicPrefixName."-".basename($_FILES['Photo2']['name']);
		move_uploaded_file($_FILES['Photo2']['tmp_name'],$UploadDir."/$Photo2");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo2 = '$Photo2' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo3']['name'] == null){
		$Photo3 = $PicPrefixName."-".basename($_FILES['Photo3']['name']);
		move_uploaded_file($_FILES['Photo3']['tmp_name'],$UploadDir."/$Photo3");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo3 = '$Photo3' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_FILES['Photo4']['name'] == null){
		$Photo4 = $PicPrefixName."-".basename($_FILES['Photo4']['name']);
		move_uploaded_file($_FILES['Photo4']['tmp_name'],$UploadDir."/$Photo4");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo4 = '$Photo4' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}


	If (!$_POST['DelTechDraw']== null){
		$nama = $_POST["DelTechDraw"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.TechDraw = '' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto1']== null){
		$nama = $_POST["DelPhoto1"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo1 = '' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto2']== null){
		$nama = $_POST["DelPhoto2"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo2 = '' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto3']== null){
		$nama = $_POST["DelPhoto3"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo3 = '' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	If (!$_POST['DelPhoto4']== null){
		$nama = $_POST["DelPhoto4"];
		unlink($UploadDir."/$nama");
		$Update = "UPDATE SampleCeramic SET SampleCeramic.Photo4 = '' where SampleCeramic.sID = '$sid';";
		mysql_query($Update);
	}
	
	If (!$_POST['DelClay']== null){
		$Clay = '';
	}
	If (!$_POST['DelCasting1']== null){
		$Casting1 = '';
	}
	If (!$_POST['DelCasting2']== null){
		$Casting2 = '';
	} 
	If (!$_POST['DelCasting3']== null){
		$Casting3 = '';
	} 
	If (!$_POST['DelCasting4']== null){
		$Casting4 = '';
	}
	If (!$_POST['DelEstruder1']== null){
		$Estruder1 = '';
	}
	If (!$_POST['DelEstruder2']== null){
		$Estruder2 = '';
	}
	If (!$_POST['DelEstruder3']== null){
		$Estruder3 = '';
	}
	If (!$_POST['DelEstruder4']== null){
		$Estruder4 = '';
	}
	If (!$_POST['DelTexture1']== null){
		$Texture1 = '';
	}
	If (!$_POST['DelTexture2']== null){
		$Texture2 = '';
	}
	If (!$_POST['DelTexture3']== null){
		$Texture3 = '';
	}
	If (!$_POST['DelTexture4']== null){
		$Texture4 = '';
	}		
	If (!$_POST['DelTools1']== null){
		$Tools1 = '';
	} 
	If (!$_POST['DelTools2']== null){
		$Tools2 = '';
	} 
	If (!$_POST['DelTools3']== null){
		$Tools3 = '';
	} 			
	If (!$_POST['DelTools4']== null){
		$Tools4 = '';
	} 
	If (!$_POST['DelEngobe1']== null){
		$Engobe1 = '';
	}
	If (!$_POST['DelEngobe2']== null){
		$Engobe2 = '';
	}
	If (!$_POST['DelEngobe3']== null){
		$Engobe3 = '';
	}
	If (!$_POST['DelEngobe4']== null){
		$Engobe4 = '';
	}				
	If (!$_POST['DelStainOxide1']== null){
		$StainOxide1 = '';
	}
	If (!$_POST['DelStainOxide2']== null){
		$StainOxide2 = '';
	}
	If (!$_POST['DelStainOxide3']== null){
		$StainOxide3 = '';
	}
	If (!$_POST['DelStainOxide4']== null){
		$StainOxide4 = '';
	}				
	If (!$_POST['DelGlaze1']== null){
		$Glaze1 = '';
	}
	If (!$_POST['DelGlaze2']== null){
		$Glaze2 = '';
	}
	If (!$_POST['DelGlaze3']== null){
		$Glaze3 = '';
	}
	If (!$_POST['DelGlaze4']== null){
		$Glaze4 = '';
	}
	If (!$_POST['DelDesignMat1']== null){
		$DesignMat1 = '';
	}
	If (!$_POST['DelDesignMat2']== null){
		$DesignMat2 = '';
	}
	If (!$_POST['DelDesignMat3']== null){
		$DesignMat3 = '';
	}
	If (!$_POST['DelDesignMat4']== null){
		$DesignMat4 = '';
	}
	
$_rs ="UPDATE sampleceramic 
			SET 
			sampleceramic.ClientCode = '$ClientCode', 
			sampleceramic.ClientDescription = '$ClientDesc', 
			sampleceramic.SampleDate = '$SampleDate',  
	sampleceramic.Reference = '$Reference', 
	sampleceramic.ReferenceNote    = '$ReferenceNotes', 
	sampleceramic.Clay   = '$Clay', 
	sampleceramic.ClayKG = '$ClayKG', 
	sampleceramic.ClayNote = '$ClayNotes', 
	sampleceramic.BuildTech = '$BuildTech', 
	sampleceramic.BuildTechNote    = '$BuildTechNotes', 
	sampleceramic.Rim   = '$Rim', 
	sampleceramic.Feet = '$Feet', 
	sampleceramic.Casting1 = '$Casting1', 
	sampleceramic.Casting2 = '$Casting2', 
	sampleceramic.Casting3    = '$Casting3', 
	sampleceramic.Casting4   = '$Casting4', 
	sampleceramic.CastingNote = '$CastingNotes', 
	sampleceramic.Estruder1 = '$Estruder1', 
	sampleceramic.Estruder2 = '$Estruder2', 
	sampleceramic.Estruder3    = '$Estruder3', 
	sampleceramic.Estruder4   = '$Estruder4', 
	sampleceramic.EstruderNote = '$EstruderNotes', 
	sampleceramic.Texture1 = '$Texture1', 
	sampleceramic.Texture2 = '$Texture2', 
	sampleceramic.Texture3    = '$Texture3', 
	sampleceramic.Texture4   = '$Texture4', 
	sampleceramic.TextureNote = '$TextureNotes', 
	sampleceramic.Tools1 = '$Tools1', 
	sampleceramic.Tools2 = '$Tools2', 
	sampleceramic.Tools3    = '$Tools3', 
	sampleceramic.Tools4   = '$Tools4', 
	sampleceramic.ToolsNote = '$ToolsNotes', 
	sampleceramic.Engobe1 = '$Engobe1', 
	sampleceramic.Engobe2 = '$Engobe2', 
	sampleceramic.Engobe3    = '$Engobe3', 
	sampleceramic.Engobe4   = '$Engobe4', 
	sampleceramic.EngobeNote = '$EngobeNotes', 
	sampleceramic.BisqueTemp = '$BisqueTemp', 
	sampleceramic.StainOxide1 = '$StainOxide1', 
	sampleceramic.StainOxide2    = '$StainOxide2', 
	sampleceramic.StainOxide3   = '$StainOxide3', 
	sampleceramic.StainOxide4 = '$StainOxide4', 
	sampleceramic.StainOxideNote = '$StainOxideNotes', 
	sampleceramic.Glaze1 = '$Glaze1', 
	sampleceramic.Glaze2 = '$Glaze2', 
	sampleceramic.Glaze3 = '$Glaze3', 
	sampleceramic.Glaze4 = '$Glaze4', 
	sampleceramic.GlazeDensity1 = '$GlazeDensity1', 
	sampleceramic.GlazeDensity2 = '$GlazeDensity2', 
	sampleceramic.GlazeDensity3 = '$GlazeDensity3', 
	sampleceramic.GlazeDensity4 = '$GlazeDensity4', 
	sampleceramic.GlazeNote   = '$GlazeNotes', 
	sampleceramic.GlazeTemp = '$GlazeTemp', 
	sampleceramic.Firing = '$Firing', 
	sampleceramic.FiringNote = '$FiringNotes', 
	sampleceramic.Width    = '$Width', 
	sampleceramic.Height   = '$Height', 
	sampleceramic.Length = '$Length', 
	sampleceramic.Diameter = '$Diameter', 
	sampleceramic.SampCeramicVolume = '$SampCeramicVolume', 
	sampleceramic.FinalSizeNote    = '$FinalSizeNotes', 
	sampleceramic.DesignMat1   = '$DesignMat1', 
	sampleceramic.DesignMat2 = '$DesignMat2', 
	sampleceramic.DesignMat3 = '$DesignMat3', 
	sampleceramic.DesignMat4 = '$DesignMat4', 
	sampleceramic.DesignMatQty1    = '$DesignMatQty1', 
	sampleceramic.DesignMatQty2   = '$DesignMatQty2', 
	sampleceramic.DesignMatQty3 = '$DesignMatQty3', 
	sampleceramic.DesignMatQty4 = '$DesignMatQty4', 
	sampleceramic.DesignMatNote = '$DesignMatNotes', 
	sampleceramic.History    = '$History' 
	 WHERE sampleceramic.sID = '$sid';";
	 
	$query=mysql_query($_rs);
	if ($query)

	{
		//$ref = $_SERVER['HTTP_REFERER'];
		//header( 'refresh: 1; url='.$ref);
		//header("Location:view_rndsampceramic.php");
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