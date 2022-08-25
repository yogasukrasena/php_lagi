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
$tabel = $_POST['tabel'];
	//	print_r($_POST);

	$sid = $_POST['sID'];
	$ClientCode = $_POST['ClientCode'];
	$ClientDesc = $_POST['ClientDesc'];
	$SampleDate = $_POST['DateField'];
	$TechDraw    = $_POST['TechDraw'];
	$Photo1   = $_POST['Photo1'];
	$Photo2 = $_POST['Photo2'];
	$Photo3 = $_POST['Photo3'];
	$Reference = $_POST['Reference'];
	$ReferenceNote    = $_POST['RefNote'];
	$Clay   = $_POST['Clay'];
	$ClayKG = $_POST['ClayKG'];
	$ClayNote = $_POST['ClayNote'];
	$BuildTech = $_POST['BuildTech'];
	$BuildTechNote    = $_POST['BuildTechNote'];
	$Rim   = $_POST['rim'];
	$Feet = $_POST['feet'];
	$Casting1 = $_POST['casting1'];
	$Casting2 = $_POST['casting2'];
	$Casting3    = $_POST['casting3'];
	$Casting4   = $_POST['casting4'];
	$CastingNote = $_POST['castingnote'];
	$Estruder1 = $_POST['estruder1'];
	$Estruder2 = $_POST['estruder2'];
	$Estruder3    = $_POST['estruder3'];
	$Estruder4   = $_POST['estruder4'];
	$EstruderNote = $_POST['estrudernote'];
	$Texture1 = $_POST['texture1'];
	$Texture2 = $_POST['texture2'];
	$Texture3    = $_POST['texture3'];
	$Texture4   = $_POST['texture4'];
	$TextureNote = $_POST['texturenote'];
	$Tools1 = $_POST['tools1'];
	$Tools2 = $_POST['tools2'];
	$Tools3    = $_POST['tools3'];
	$Tools4   = $_POST['tools4'];
	$ToolsNote = $_POST['toolsnote'];
	$Engobe1 = $_POST['engobe1'];
	$Engobe2 = $_POST['engobe2'];
	$Engobe3    = $_POST['engobe3'];
	$Engobe4   = $_POST['engobe4'];
	$EngobeNote = $_POST['engobenote'];
	$BisqueTemp = $_POST['bisquetemp'];
	$StainOxide1 = $_POST['stainoxide1'];
	$StainOxide2    = $_POST['stainoxide2'];
	$StainOxide3   = $_POST['stainoxide3'];
	$StainOxide4 = $_POST['stainoxide4'];
	$StainOxideNote = $_POST['stainoxidenote'];
	$Glaze1 = $_POST['glaze1'];
	$Glaze2    = $_POST['glaze2'];
	$Glaze3   = $_POST['glaze3'];
	$Glaze4 = $_POST['glaze4'];
	$GlazeDensity1 = $_POST['glazedensity1'];
	$GlazeDensity2    = $_POST['glazedensity2'];
	$GlazeDensity3   = $_POST['glazedensity3'];
	$GlazeDensity4    = $_POST['glazedensity4'];
	$GlazeNote   = $_POST['glazenote'];
	$GlazeTemp = $_POST['glazetemp'];
	$Firing = $_POST['firing'];
	$FiringNote = $_POST['firingnote'];
	$Width    = $_POST['width'];
	$Height   = $_POST['height'];
	$Lenght = $_POST['lenght'];
	$Diameter = $_POST['diameter'];
	$SampCeramicVolume = $_POST['sampceramicvolume'];
	$FinalSizeNote    = $_POST['finalsizenote'];
	$OtherMat1   = $_POST['othermat1'];
	$OtherMat2 = $_POST['othermat2'];
	$OtherMat3 = $_POST['othermat3'];
	$OtherMat4 = $_POST['othermat4'];
	$OtherMatQty1    = $_POST['othermatqty1'];
	$OtherMatQty2   = $_POST['othermatqty2'];
	$OtherMatQty3 = $_POST['othermatqty3'];
	$OtherMatQty4 = $_POST['othermatqty4'];
	$OtherMatNote = $_POST['othermatnote'];
	$History    = $_POST['history'];
	
$_rs ="UPDATE sampleceramic 
			SET sampleceramic.ClientCode = '$ClientCode',
			sampleceramic.ClientDesc = '$ClientDesc',
			sampleceramic.SampleDate = '$SampleDate',
			sampleceramic.TechDraw   = '$TechDraw',
	sampleceramic.Photo1   = '$Photo1',
	sampleceramic.Photo2 = '$Photo2',
	sampleceramic.Photo3 = '$Photo3',
	sampleceramic.Reference = '$Reference',
	sampleceramic.ReferenceNote    = '$ReferenceNote',
	sampleceramic.Clay   = '$Clay',
	sampleceramic.ClayKG = '$ClayKG',
	sampleceramic.ClayNote = '$ClayNote',
	sampleceramic.BuildTech = '$BuildTech',
	sampleceramic.BuildTechNote    = '$BuildTechNote',
	sampleceramic.Rim   = '$Rim',
	sampleceramic.Feet = '$feet',
	sampleceramic.Casting1 = '$Casting1',
	sampleceramic.Casting2 = '$Casting2',
	sampleceramic.Casting3    = '$Casting3',
	sampleceramic.Casting4   = '$Casting4',
	sampleceramic.CastingNote = '$Castingnote',
	sampleceramic.Estruder1 = '$estruder1',
	sampleceramic.Estruder2 = '$Estruder2',
	sampleceramic.Estruder3    = '$Estruder3',
	sampleceramic.Estruder4   = '$Estruder4',
	sampleceramic.EstruderNote = '$Estrudernote',
	sampleceramic.Texture1 = '$Texture1',
	sampleceramic.Texture2 = '$Texture2',
	sampleceramic.Texture3    = '$Texture3',
	sampleceramic.Texture4   = '$Texture4',
	sampleceramic.TextureNote = '$Texturenote',
	sampleceramic.Tools1 = '$Tools1',
	sampleceramic.Tools2 = '$Tools2',
	sampleceramic.Tools3    = '$Tools3',
	sampleceramic.Tools4   = '$Tools4',
	sampleceramic.ToolsNote = '$Toolsnote',
	sampleceramic.Engobe1 = '$Engobe1',
	sampleceramic.Engobe2 = '$Engobe2',
	sampleceramic.Engobe3    = '$Engobe3',
	sampleceramic.Engobe4   = '$Engobe4',
	sampleceramic.EngobeNote = '$Engobenote',
	sampleceramic.BisqueTemp = '$Bisquetemp',
	sampleceramic.StainOxide1 = '$Stainoxide1',
	sampleceramic.StainOxide2    = '$Stainoxide2;
	sampleceramic.StainOxide3   = '$Stainoxide3',
	sampleceramic.StainOxide4 = '$Stainoxide4',
	sampleceramic.StainOxideNote = '$Stainoxidenote',
	sampleceramic.Glaze1 = '$Glaze1',
	sampleceramic.Glaze2    = '$Glaze2',
	sampleceramic.Glaze3   = '$Glaze3',
	sampleceramic.Glaze4 = '$Glaze4',
	sampleceramic.GlazeDensity1 = '$Glazedensity1',
	sampleceramic.GlazeDensity2    = '$Glazedensity2',
	sampleceramic.GlazeDensity3   = '$Glazedensity3',
	sampleceramic.GlazeDensity4    = '$Glazedensity4',
	sampleceramic.GlazeNote   = '$Glazenote',
	sampleceramic.GlazeTemp = '$Glazetemp',
	sampleceramic.Firing = '$Firing',
	sampleceramic.FiringNote = '$Firingnote',
	sampleceramic.Width    = '$Width',
	sampleceramic.Height   = '$Height',
	sampleceramic.Lenght = '$Lenght',
	sampleceramic.Diameter = '$Diameter',
	sampleceramic.SampCeramicVolume = '$Sampceramicvolume',
	sampleceramic.FinalSizeNote    = '$Finalsizenote',
	sampleceramic.OtherMat1   = '$Othermat1',
	sampleceramic.OtherMat2 = '$Othermat2',
	sampleceramic.OtherMat3 = '$Othermat3',
	sampleceramic.OtherMat4 = '$Othermat4',
	sampleceramic.OtherMatQty1    = '$Othermatqty1',
	sampleceramic.OtherMatQty2   = '$Othermatqty2',
	sampleceramic.OtherMatQty3 = '$Othermatqty3',
	sampleceramic.OtherMatQty4 = '$Othermatqty4',
	sampleceramic.OtherMatNote = '$Othermatnote',
	sampleceramic.History    = '$History',
	 WHERE sampleceramic.sID = '$sid';";

	$query=mysql_query($_rs);
	echo "<p>record has been updated click </p> <a href=\"rnd_home.php?page=rndsampCeramic.html\"> here </a> to continue";
	//header("Location:index.php");

?>
</BODY>
</HTML>