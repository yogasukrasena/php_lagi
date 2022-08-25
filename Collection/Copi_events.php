<?php
//BindEvents Method @1-74E47DDB
function BindEvents()
{
    global $copy;
    $copy->CCSEvents["BeforeShow"] = "copy_BeforeShow";
}
//End BindEvents Method

//copy_BeforeShow @5-5F83154E
function copy_BeforeShow(& $sender)
{
    $copy_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $copy; //Compatibility
//End copy_BeforeShow

//Custom Code @9-2A29BDB7
	global $copy;
	$DB = new clsDBGayaFusionAll;
	$sID = CCGetFromGet("sID",0);
	$CollectID = CCGetFromGet("ID",0);
	
		$Update = "UPDATE tblCollect_Master set ClientCode = (SELECT ClientCode FROM sampleceramic WHERE sID = $sID),
		ClientDescription = (SELECT ClientDescription FROM sampleceramic WHERE sID = $sID),
  		CollectDate = (SELECT SampleDate FROM sampleceramic WHERE sID = $sID),
  		TechDraw = (SELECT TechDraw FROM sampleceramic WHERE sID = $sID),
  		Photo1 = (SELECT Photo1 FROM sampleceramic WHERE sID = $sID),
  		Photo2 = (SELECT Photo2 FROM sampleceramic WHERE sID = $sID),
  		Photo3 = (SELECT Photo3 FROM sampleceramic WHERE sID = $sID),
  		Photo4 = (SELECT Photo4 FROM sampleceramic WHERE sID = $sID),
  		Clay = (SELECT Clay FROM sampleceramic WHERE sID = $sID),
  		ClayKG = (SELECT ClayKG FROM sampleceramic WHERE sID = $sID),
  		ClayNote = (SELECT ClayNote FROM sampleceramic WHERE sID = $sID),
  		BuildTech = (SELECT BuildTech FROM sampleceramic WHERE sID = $sID),
  		BuildTechNote = (SELECT BuildTechNote FROM sampleceramic WHERE sID = $sID),
  		Rim = (SELECT Rim FROM sampleceramic WHERE sID = $sID),
  		Feet = (SELECT Feet FROM sampleceramic WHERE sID = $sID),
  		Casting1 = (SELECT Casting1 FROM sampleceramic WHERE sID = $sID),
  		Casting2 = (SELECT Casting2 FROM sampleceramic WHERE sID = $sID),
  		Casting3 = (SELECT Casting3 FROM sampleceramic WHERE sID = $sID),
  		Casting4 = (SELECT Casting4 FROM sampleceramic WHERE sID = $sID),
  		CastingNote = (SELECT CastingNote FROM sampleceramic WHERE sID = $sID),
  		Estruder1 = (SELECT Estruder1 FROM sampleceramic WHERE sID = $sID),
  		Estruder2 = (SELECT Estruder2 FROM sampleceramic WHERE sID = $sID),
  		Estruder3 = (SELECT Estruder3 FROM sampleceramic WHERE sID = $sID),
  		Estruder4 = (SELECT Estruder4 FROM sampleceramic WHERE sID = $sID),
  		EstruderNote = (SELECT EstruderNote FROM sampleceramic WHERE sID = $sID),
  		Texture1 = (SELECT Texture1 FROM sampleceramic WHERE sID = $sID),
  		Texture2 = (SELECT Texture2 FROM sampleceramic WHERE sID = $sID),
  		Texture3 = (SELECT Texture3 FROM sampleceramic WHERE sID = $sID),
  		Texture4 = (SELECT Texture4 FROM sampleceramic WHERE sID = $sID),
  		TextureNote = (SELECT TextureNote FROM sampleceramic WHERE sID = $sID),
  		Tools1 = (SELECT Tools1 FROM sampleceramic WHERE sID = $sID),
  		Tools2 = (SELECT Tools2 FROM sampleceramic WHERE sID = $sID),
  		Tools3 = (SELECT Tools3 FROM sampleceramic WHERE sID = $sID),
  		Tools4 = (SELECT Tools4 FROM sampleceramic WHERE sID = $sID),
  		ToolsNote = (SELECT ToolsNote FROM sampleceramic WHERE sID = $sID),
  		Engobe1 = (SELECT Engobe1 FROM sampleceramic WHERE sID = $sID),
  		Engobe2 = (SELECT Engobe2 FROM sampleceramic WHERE sID = $sID),
  		Engobe3 = (SELECT Engobe3 FROM sampleceramic WHERE sID = $sID),
  		Engobe4 = (SELECT Engobe4 FROM sampleceramic WHERE sID = $sID),
  		EngobeNote = (SELECT EngobeNote FROM sampleceramic WHERE sID = $sID),
  		BisqueTemp = (SELECT BisqueTemp FROM sampleceramic WHERE sID = $sID),
  		StainOxide1 = (SELECT StainOxide1 FROM sampleceramic WHERE sID = $sID),
  		StainOxide2 = (SELECT StainOxide2 FROM sampleceramic WHERE sID = $sID),
  		StainOxide3 = (SELECT StainOxide3 FROM sampleceramic WHERE sID = $sID),
  		StainOxide4 = (SELECT StainOxide4 FROM sampleceramic WHERE sID = $sID),
  		StainOxideNote = (SELECT StainOxideNote FROM sampleceramic WHERE sID = $sID),
  		Glaze1 = (SELECT Glaze1 FROM sampleceramic WHERE sID = $sID),
  		Glaze2 = (SELECT Glaze2 FROM sampleceramic WHERE sID = $sID),
  		Glaze3 = (SELECT Glaze3 FROM sampleceramic WHERE sID = $sID),
  		Glaze4 = (SELECT Glaze4 FROM sampleceramic WHERE sID = $sID),
  		GlazeDensity1 = (SELECT GlazeDensity1 FROM sampleceramic WHERE sID = $sID),
  		GlazeDensity2 = (SELECT GlazeDensity2 FROM sampleceramic WHERE sID = $sID),
  		GlazeDensity3 = (SELECT GlazeDensity3 FROM sampleceramic WHERE sID = $sID),
  		GlazeDensity4 = (SELECT GlazeDensity4 FROM sampleceramic WHERE sID = $sID),
  		GlazeNote = (SELECT GlazeNote FROM sampleceramic WHERE sID = $sID),
  		GlazeTemp = (SELECT GlazeTemp FROM sampleceramic WHERE sID = $sID),
  		Firing = (SELECT Firing FROM sampleceramic WHERE sID = $sID),
  		FiringNote = (SELECT FiringNote FROM sampleceramic WHERE sID = $sID),
  		Width = (SELECT Width FROM sampleceramic WHERE sID = $sID),
  		Height = (SELECT Height FROM sampleceramic WHERE sID = $sID),
  		Length = (SELECT `Length` FROM sampleceramic WHERE sID = $sID),
  		Diameter = (SELECT Diameter FROM sampleceramic WHERE sID = $sID),
  		FinalSizeNote = (SELECT FinalSizeNote FROM sampleceramic WHERE sID = $sID),
  DesignMat1 = (SELECT DesignMat1 FROM sampleceramic WHERE sID = $sID),
  DesignMat2 = (SELECT DesignMat2 FROM sampleceramic WHERE sID = $sID),
  DesignMat3 = (SELECT DesignMat3 FROM sampleceramic WHERE sID = $sID),
  DesignMat4 = (SELECT DesignMat4 FROM sampleceramic WHERE sID = $sID),
  DesignMatQty1 = (SELECT DesignMatQty1 FROM sampleceramic WHERE sID = $sID),
  DesignMatQty2 = (SELECT DesignMatQty2 FROM sampleceramic WHERE sID = $sID),
  DesignMatQty3 = (SELECT DesignMatQty3 FROM sampleceramic WHERE sID = $sID),
  DesignMatQty4 = (SELECT DesignMatQty4 FROM sampleceramic WHERE sID = $sID),
  DesignMatNote = (SELECT DesignMatNote FROM sampleceramic WHERE sID = $sID),
  History = (SELECT History FROM sampleceramic WHERE sID = $sID),
  ClayType = (SELECT ClayType FROM sampleceramic WHERE sID = $sID),
  ClayPreparationMinute = (SELECT ClayPreparationMinute FROM sampleceramic WHERE sID = $sID),
  WheelMinute = (SELECT WheelMinute FROM sampleceramic WHERE sID = $sID),
  SlabMinute = (SELECT SlabMinute FROM sampleceramic WHERE sID = $sID),
  CastingMinute = (SELECT CastingMinute FROM sampleceramic WHERE sID = $sID),
  FinishingMinute = (SELECT FinishingMinute FROM sampleceramic WHERE sID = $sID),
  GlazingMinute = (SELECT GlazingMinute FROM sampleceramic WHERE sID = $sID),
  StandardBisqueLoading = (SELECT StandardBisqueLoading FROM sampleceramic WHERE sID = $sID),
  StandardGlazeLoading = (SELECT StandardGlazeLoading FROM sampleceramic WHERE sID = $sID),
  RakuBisqueLoading = (SELECT RakuBisqueLoading FROM sampleceramic WHERE sID = $sID),
  RakuGlazeLoading = (SELECT RakuGlazeLoading FROM sampleceramic WHERE sID = $sID),
  MovementMinute = (SELECT MovementMinute FROM sampleceramic WHERE sID = $sID),
  PackagingWorkMinute = (SELECT PackagingWorkMinute FROM sampleceramic WHERE sID = $sID),
  ClayPreparationPPH = (SELECT ClayPreparationPPH FROM sampleceramic WHERE sID = $sID),
  WheelPPH = (SELECT WheelPPH FROM sampleceramic WHERE sID = $sID),
  SlabPPH = (SELECT SlabPPH FROM sampleceramic WHERE sID = $sID),
  CastingPPH = (SELECT CastingPPH FROM sampleceramic WHERE sID = $sID),
  FinishingPPH = (SELECT FinishingPPH FROM sampleceramic WHERE sID = $sID),
  GlazingPPH = (SELECT GlazingPPH FROM sampleceramic WHERE sID = $sID),
  MovementPPH = (SELECT MovementPPH FROM sampleceramic WHERE sID = $sID),
  PackagingWorkPPH = (SELECT PackagingWorkPPH FROM sampleceramic WHERE sID = $sID),
  RealSellingPrice = (SELECT RealSellingPrice FROM sampleceramic WHERE sID = $sID) WHERE ID = $CollectID ";
	$result = $DB->query($Update);
		if($result){
			$CekRefDulu = "SELECT CollectID FROM tblReference WHERE CollectID = $CollectID";
			$DB->query($CekRefDulu);
			$hasil = $DB->next_record();
			if(!$hasil){
				$RefCode = date("Y").date("m").date("j").date("H").date("i").date("s");
				$insert = "INSERT INTO tblReference (RefCode, sID, CollectID) VALUES ($RefCode, $sID, $CollectID)";
				$DB->query($insert);
				$RefID = mysql_insert_id();
				$Update = "UPDATE tblCollect_Master SET RefID = $RefID WHERE ID = $CollectID";
				$DB->query($Update);
				//$Update = "UPDATE sampleceramic SET RefID = $RefID WHERE sID = $sID";
				//$DB->query($Update);
			}else{
				$insert = "UPDATE tblReference SET sID = $sID WHERE CollectID = $CollectID";
				$DB->query($insert);
			}
			
			$copy->Sukses->SetValue("All Data Copied");
			//$copy->RefID->SetValue($RefID);
		}else{
			$eror = mysql_error();
			$copy->Sukses->SetValue($eror);
		}
	$DB->close();
	// sampleceramic.Reference,
  //sampleceramic.ReferenceNote,
//End Custom Code

//Close copy_BeforeShow @5-920C0B71
    return $copy_BeforeShow;
}
//End Close copy_BeforeShow


?>
