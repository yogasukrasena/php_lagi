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

	//$sid = $_POST['sID'];
	$sid = 1;
	//$ClientCode = $_POST['ClientCode'];
	$ClientCode = 'kuraal';
	$ClientDesc = $_POST['ClientDescription'];
	$SampleDate = $_POST['DateField'];
	$TechDraw    = $_POST['TechDraw'];
	$Photo1   = $_POST['Photo1'];
	$Photo2 = $_POST['Photo2'];
	$Photo3 = $_POST['Photo3'];
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
	$Casting3    = $_POST['Casting3'];
	$Casting4   = $_POST['Casting4'];
	$CastingNotes = $_POST['CastingNotes'];
	$Estruder1 = $_POST['Estruder1'];
	$Estruder2 = $_POST['Estruder2'];
	$Estruder3    = $_POST['Estruder3'];
	$Estruder4   = $_POST['Estruder4'];
	$EstruderNotes = $_POST['EstruderNotes'];
	$Texture1 = $_POST['Texture1'];
	$Texture2 = $_POST['Texture2'];
	$Texture3    = $_POST['Texture3'];
	$Texture4   = $_POST['Texture4'];
	$TextureNotes = $_POST['TextureNotes'];
	$Tools1 = $_POST['Tools1'];
	$Tools2 = $_POST['Tools2'];
	$Tools3    = $_POST['Tools3'];
	$Tools4   = $_POST['Tools4'];
	$ToolsNotes = $_POST['ToolsNotes'];
	$Engobe1 = $_POST['Engobe1'];
	$Engobe2 = $_POST['Engobe2'];
	$Engobe3    = $_POST['Engobe3'];
	$Engobe4   = $_POST['Engobe4'];
	$EngobeNotes = $_POST['EngobeNotes'];
	$BisqueTemp = $_POST['BisqueTemp'];
	$StainOxide1 = $_POST['StainOxide1'];
	$StainOxide2    = $_POST['StainOxide2'];
	$StainOxide3   = $_POST['StainOxide3'];
	$StainOxide4 = $_POST['StainOxide4'];
	$StainOxideNotes = $_POST['StainOxideNotes'];
	$Glaze1 = $_POST['Glaze1'];
	$Glaze2    = $_POST['Glaze2'];
	$Glaze3   = $_POST['Glaze3'];
	$Glaze4 = $_POST['Glaze4'];
	$GlazeDensity1 = $_POST['GlazeDensity1'];
	$GlazeDensity2    = $_POST['GlazeDensity2'];
	$GlazeDensity3   = $_POST['GlazeDensity3'];
	$GlazeDensity4    = $_POST['GlazeDensity4'];
	$GlazeNotes   = $_POST['GlazeNotes'];
	$GlazeTemp = $_POST['GlazeTemp'];
	
	
	$_rs ="UPDATE sampleceramic 
			SET 
			sampleceramic.ClientCode = '$ClientCode',
			sampleceramic.ClientDescription = '$ClientDesc', 
			sampleceramic.SampleDate = '$SampleDate', 
			sampleceramic.TechDraw   = '$TechDraw',
			sampleceramic.Photo1   = '$Photo1', 
	sampleceramic.Photo2 = '$Photo2', 
	sampleceramic.Photo3 = '$Photo3', 
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
	sampleceramic.ToolsNote = '$Toolsnotes', 
	sampleceramic.Engobe1 = '$Engobe1', 
	sampleceramic.Engobe2 = '$Engobe2', 
	sampleceramic.Engobe3    = '$Engobe3', 
	sampleceramic.Engobe4   = '$Engobe4', 
	sampleceramic.EngobeNote = '$Engobenotes',
	sampleceramic.BisqueTemp = '$BisqueTemp',
	sampleceramic.StainOxide1 = '$StainOxide1',
	sampleceramic.StainOxide2    = '$StainOxide2', 
	sampleceramic.StainOxide3   = '$StainOxide3', 
	sampleceramic.StainOxide4 = '$StainOxide4', 
	sampleceramic.StainOxideNote = '$StainOxideNotes',
	sampleceramic.Glaze1 = '$Glaze1', 
	sampleceramic.Glaze2    = '$Glaze2', 
	sampleceramic.Glaze3   = '$Glaze3', 
	sampleceramic.Glaze4 = '$Glaze4', 
	sampleceramic.GlazeDensity1 = '$GlazeDensity1', 
	sampleceramic.GlazeDensity2    = '$GlazeDensity2', 
	sampleceramic.GlazeDensity3   = '$GlazeDensity3', 
	sampleceramic.GlazeDensity4    = '$GlazeDensity4', 
	sampleceramic.GlazeNote   = '$Glazenotes', 
	sampleceramic.GlazeTemp = '$Glazetemp'  
				WHERE sampleceramic.sID = '$sid';";
	$query=mysql_query($_rs);
	if ($query)
	{
		echo "<p>record has been updated click </p> <a href=\"view_rndsampCeramic.php\"> here </a> to continue";
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