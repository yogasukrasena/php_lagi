<?php
//BindEvents Method @1-39FE9147
function BindEvents()
{
    global $AddSampleCeramic;
    $AddSampleCeramic->ToolsPic1->CCSEvents["BeforeShow"] = "AddSampleCeramic_ToolsPic1_BeforeShow";
    $AddSampleCeramic->ToolsPic2->CCSEvents["BeforeShow"] = "AddSampleCeramic_ToolsPic2_BeforeShow";
    $AddSampleCeramic->ToolsPic3->CCSEvents["BeforeShow"] = "AddSampleCeramic_ToolsPic3_BeforeShow";
    $AddSampleCeramic->ToolsPic4->CCSEvents["BeforeShow"] = "AddSampleCeramic_ToolsPic4_BeforeShow";
    $AddSampleCeramic->Casting1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting1Desc_BeforeShow";
    $AddSampleCeramic->Casting2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting2Desc_BeforeShow";
    $AddSampleCeramic->Casting3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting3Desc_BeforeShow";
    $AddSampleCeramic->Casting4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting4Desc_BeforeShow";
    $AddSampleCeramic->Estruder1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Estruder1Desc_BeforeShow";
    $AddSampleCeramic->Estruder2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Estruder2Desc_BeforeShow";
    $AddSampleCeramic->Estruder3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Estruder3Desc_BeforeShow";
    $AddSampleCeramic->Estruder4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Estruder4Desc_BeforeShow";
    $AddSampleCeramic->Texture1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Texture1Desc_BeforeShow";
    $AddSampleCeramic->Texture2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Texture2Desc_BeforeShow";
    $AddSampleCeramic->Texture3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Texture3Desc_BeforeShow";
    $AddSampleCeramic->Texture4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Texture4Desc_BeforeShow";
    $AddSampleCeramic->Engobe1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Engobe1Desc_BeforeShow";
    $AddSampleCeramic->Engobe2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Engobe2Desc_BeforeShow";
    $AddSampleCeramic->Engobe3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Engobe3Desc_BeforeShow";
    $AddSampleCeramic->Engobe4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Engobe4Desc_BeforeShow";
    $AddSampleCeramic->StainOxide1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_StainOxide1Desc_BeforeShow";
    $AddSampleCeramic->StainOxide2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_StainOxide2Desc_BeforeShow";
    $AddSampleCeramic->StainOxide3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_StainOxide3Desc_BeforeShow";
    $AddSampleCeramic->StainOxide4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_StainOxide4Desc_BeforeShow";
    $AddSampleCeramic->Glaze1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Glaze1Desc_BeforeShow";
    $AddSampleCeramic->Glaze2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Glaze2Desc_BeforeShow";
    $AddSampleCeramic->Glaze3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Glaze3Desc_BeforeShow";
    $AddSampleCeramic->Glaze4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Glaze4Desc_BeforeShow";
    $AddSampleCeramic->DesignMat1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_DesignMat1Desc_BeforeShow";
    $AddSampleCeramic->DesignMat2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_DesignMat2Desc_BeforeShow";
    $AddSampleCeramic->DesignMat3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_DesignMat3Desc_BeforeShow";
    $AddSampleCeramic->DesignMat4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_DesignMat4Desc_BeforeShow";
    $AddSampleCeramic->ClayDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_ClayDesc_BeforeShow";
    $AddSampleCeramic->ClayCode->CCSEvents["BeforeShow"] = "AddSampleCeramic_ClayCode_BeforeShow";
    $AddSampleCeramic->Casting1Code->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting1Code_BeforeShow";
    $AddSampleCeramic->Casting2Code->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting2Code_BeforeShow";
    $AddSampleCeramic->Casting3Code->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting3Code_BeforeShow";
    $AddSampleCeramic->Casting4Code->CCSEvents["BeforeShow"] = "AddSampleCeramic_Casting4Code_BeforeShow";
}
//End BindEvents Method

//AddSampleCeramic_ToolsPic1_BeforeShow @81-4DA6EA4D
function AddSampleCeramic_ToolsPic1_BeforeShow(& $sender)
{
    $AddSampleCeramic_ToolsPic1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ToolsPic1_BeforeShow

//Custom Code @142-2A29BDB7
global $Tpl;
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Tools1->GetValue();
		$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$DBGayaFusionAll);
		$AddSampleCeramic->ToolsPic1->SetValue($ToolsPhoto);
	}
//End Custom Code

//Close AddSampleCeramic_ToolsPic1_BeforeShow @81-686513C2
    return $AddSampleCeramic_ToolsPic1_BeforeShow;
}
//End Close AddSampleCeramic_ToolsPic1_BeforeShow

//AddSampleCeramic_ToolsPic2_BeforeShow @82-5B3073B7
function AddSampleCeramic_ToolsPic2_BeforeShow(& $sender)
{
    $AddSampleCeramic_ToolsPic2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ToolsPic2_BeforeShow

//Custom Code @143-2A29BDB7
	global $Tpl;
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Tools2->GetValue();
		$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$DBGayaFusionAll);
		$AddSampleCeramic->ToolsPic2->SetValue($ToolsPhoto);
	}
//End Custom Code

//Close AddSampleCeramic_ToolsPic2_BeforeShow @82-14043619
    return $AddSampleCeramic_ToolsPic2_BeforeShow;
}
//End Close AddSampleCeramic_ToolsPic2_BeforeShow

//AddSampleCeramic_ToolsPic3_BeforeShow @83-E06D06DE
function AddSampleCeramic_ToolsPic3_BeforeShow(& $sender)
{
    $AddSampleCeramic_ToolsPic3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ToolsPic3_BeforeShow

//Custom Code @144-2A29BDB7
	global $Tpl;
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Tools3->GetValue();
		$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$DBGayaFusionAll);
		$AddSampleCeramic->ToolsPic3->SetValue($ToolsPhoto);
	}
//End Custom Code

//Close AddSampleCeramic_ToolsPic3_BeforeShow @83-890BD76F
    return $AddSampleCeramic_ToolsPic3_BeforeShow;
}
//End Close AddSampleCeramic_ToolsPic3_BeforeShow

//AddSampleCeramic_ToolsPic4_BeforeShow @84-761D4043
function AddSampleCeramic_ToolsPic4_BeforeShow(& $sender)
{
    $AddSampleCeramic_ToolsPic4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ToolsPic4_BeforeShow

//Custom Code @145-2A29BDB7
	global $Tpl;
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Tools4->GetValue();
		$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$DBGayaFusionAll);
		$AddSampleCeramic->ToolsPic4->SetValue($ToolsPhoto);
	}
//End Custom Code

//Close AddSampleCeramic_ToolsPic4_BeforeShow @84-ECC67DAF
    return $AddSampleCeramic_ToolsPic4_BeforeShow;
}
//End Close AddSampleCeramic_ToolsPic4_BeforeShow

//DEL  	

//AddSampleCeramic_Casting1Desc_BeforeShow @85-6A2BBDC3
function AddSampleCeramic_Casting1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting1Desc_BeforeShow

//Custom Code @86-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting1->GetValue();
		$AddSampleCeramic->Casting1Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Casting1Desc_BeforeShow @85-1111024F
    return $AddSampleCeramic_Casting1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting1Desc_BeforeShow

//AddSampleCeramic_Casting2Desc_BeforeShow @87-4A936005
function AddSampleCeramic_Casting2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting2Desc_BeforeShow

//Custom Code @88-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting2->GetValue();
		$AddSampleCeramic->Casting2Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Casting2Desc_BeforeShow @87-FB97DF2D
    return $AddSampleCeramic_Casting2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting2Desc_BeforeShow

//AddSampleCeramic_Casting3Desc_BeforeShow @89-E3D42978
function AddSampleCeramic_Casting3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting3Desc_BeforeShow

//Custom Code @90-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting3->GetValue();
		$AddSampleCeramic->Casting3Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Casting3Desc_BeforeShow @89-14C569CC
    return $AddSampleCeramic_Casting3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting3Desc_BeforeShow

//AddSampleCeramic_Casting4Desc_BeforeShow @91-0BE2DB89
function AddSampleCeramic_Casting4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting4Desc_BeforeShow

//Custom Code @92-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting4->GetValue();
		$AddSampleCeramic->Casting4Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Casting4Desc_BeforeShow @91-F5EB63A8
    return $AddSampleCeramic_Casting4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting4Desc_BeforeShow

//AddSampleCeramic_Estruder1Desc_BeforeShow @93-C22EEFB8
function AddSampleCeramic_Estruder1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder1Desc_BeforeShow

//Custom Code @94-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Estruder1->GetValue();
		$AddSampleCeramic->Estruder1Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Estruder1Desc_BeforeShow @93-E0CEB030
    return $AddSampleCeramic_Estruder1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder1Desc_BeforeShow

//AddSampleCeramic_Estruder2Desc_BeforeShow @95-2E0B299B
function AddSampleCeramic_Estruder2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder2Desc_BeforeShow

//Custom Code @96-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Estruder2->GetValue();
		$AddSampleCeramic->Estruder2Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Estruder2Desc_BeforeShow @95-0A486D52
    return $AddSampleCeramic_Estruder2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder2Desc_BeforeShow

//AddSampleCeramic_Estruder3Desc_BeforeShow @97-C3389645
function AddSampleCeramic_Estruder3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder3Desc_BeforeShow

//Custom Code @98-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Estruder3->GetValue();
		$AddSampleCeramic->Estruder3Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Estruder3Desc_BeforeShow @97-E51ADBB3
    return $AddSampleCeramic_Estruder3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder3Desc_BeforeShow

//AddSampleCeramic_Estruder4Desc_BeforeShow @99-2D31A39C
function AddSampleCeramic_Estruder4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder4Desc_BeforeShow

//Custom Code @100-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Estruder4->GetValue();
		$AddSampleCeramic->Estruder4Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Estruder4Desc_BeforeShow @99-0434D1D7
    return $AddSampleCeramic_Estruder4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder4Desc_BeforeShow

//AddSampleCeramic_Texture1Desc_BeforeShow @101-26E29A64
function AddSampleCeramic_Texture1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture1Desc_BeforeShow

//Custom Code @102-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Texture1->GetValue();
		$AddSampleCeramic->Texture1Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Texture1Desc_BeforeShow @101-A3A7B2D3
    return $AddSampleCeramic_Texture1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture1Desc_BeforeShow

//AddSampleCeramic_Texture2Desc_BeforeShow @103-065A47A2
function AddSampleCeramic_Texture2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture2Desc_BeforeShow

//Custom Code @104-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Texture2->GetValue();
		$AddSampleCeramic->Texture2Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Texture2Desc_BeforeShow @103-49216FB1
    return $AddSampleCeramic_Texture2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture2Desc_BeforeShow

//AddSampleCeramic_Texture3Desc_BeforeShow @105-AF1D0EDF
function AddSampleCeramic_Texture3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture3Desc_BeforeShow

//Custom Code @106-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Texture3->GetValue();
		$AddSampleCeramic->Texture3Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Texture3Desc_BeforeShow @105-A673D950
    return $AddSampleCeramic_Texture3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture3Desc_BeforeShow

//AddSampleCeramic_Texture4Desc_BeforeShow @107-472BFC2E
function AddSampleCeramic_Texture4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture4Desc_BeforeShow

//Custom Code @108-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Texture4->GetValue();
		$AddSampleCeramic->Texture4Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Texture4Desc_BeforeShow @107-475DD334
    return $AddSampleCeramic_Texture4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture4Desc_BeforeShow

//AddSampleCeramic_Engobe1Desc_BeforeShow @109-3C04CFF7
function AddSampleCeramic_Engobe1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe1Desc_BeforeShow

//Custom Code @110-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Engobe1->GetValue();
		$AddSampleCeramic->Engobe1Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Engobe1Desc_BeforeShow @109-F8736F81
    return $AddSampleCeramic_Engobe1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe1Desc_BeforeShow

//AddSampleCeramic_Engobe2Desc_BeforeShow @111-8DD06285
function AddSampleCeramic_Engobe2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe2Desc_BeforeShow

//Custom Code @112-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Engobe2->GetValue();
		$AddSampleCeramic->Engobe2Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Engobe2Desc_BeforeShow @111-12F5B2E3
    return $AddSampleCeramic_Engobe2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe2Desc_BeforeShow

//AddSampleCeramic_Engobe3Desc_BeforeShow @113-544CFB94
function AddSampleCeramic_Engobe3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe3Desc_BeforeShow

//Custom Code @114-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Engobe3->GetValue();
		$AddSampleCeramic->Engobe3Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Engobe3Desc_BeforeShow @113-FDA70402
    return $AddSampleCeramic_Engobe3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe3Desc_BeforeShow

//AddSampleCeramic_Engobe4Desc_BeforeShow @115-35083E20
function AddSampleCeramic_Engobe4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe4Desc_BeforeShow

//Custom Code @116-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Engobe4->GetValue();
		$AddSampleCeramic->Engobe4Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Engobe4Desc_BeforeShow @115-1C890E66
    return $AddSampleCeramic_Engobe4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe4Desc_BeforeShow

//AddSampleCeramic_StainOxide1Desc_BeforeShow @117-424E57CE
function AddSampleCeramic_StainOxide1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide1Desc_BeforeShow

//Custom Code @118-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->StainOxide1->GetValue();
		$AddSampleCeramic->StainOxide1Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide1Desc_BeforeShow @117-D6C0DCCE
    return $AddSampleCeramic_StainOxide1Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide1Desc_BeforeShow

//AddSampleCeramic_StainOxide2Desc_BeforeShow @119-D7AB18D9
function AddSampleCeramic_StainOxide2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide2Desc_BeforeShow

//Custom Code @120-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->StainOxide2->GetValue();
		$AddSampleCeramic->StainOxide2Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide2Desc_BeforeShow @119-3C4601AC
    return $AddSampleCeramic_StainOxide2Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide2Desc_BeforeShow

//AddSampleCeramic_StainOxide3Desc_BeforeShow @121-A4F7DDD4
function AddSampleCeramic_StainOxide3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide3Desc_BeforeShow

//Custom Code @122-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->StainOxide3->GetValue();
		$AddSampleCeramic->StainOxide3Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide3Desc_BeforeShow @121-D314B74D
    return $AddSampleCeramic_StainOxide3Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide3Desc_BeforeShow

//AddSampleCeramic_StainOxide4Desc_BeforeShow @123-271080B6
function AddSampleCeramic_StainOxide4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide4Desc_BeforeShow

//Custom Code @124-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->StainOxide4->GetValue();
		$AddSampleCeramic->StainOxide4Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide4Desc_BeforeShow @123-323ABD29
    return $AddSampleCeramic_StainOxide4Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide4Desc_BeforeShow

//AddSampleCeramic_Glaze1Desc_BeforeShow @125-F70D3B7F
function AddSampleCeramic_Glaze1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze1Desc_BeforeShow

//Custom Code @126-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Glaze1->GetValue();
		$AddSampleCeramic->Glaze1Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Glaze1Desc_BeforeShow @125-F600D96E
    return $AddSampleCeramic_Glaze1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze1Desc_BeforeShow

//AddSampleCeramic_Glaze2Desc_BeforeShow @127-4EC5B543
function AddSampleCeramic_Glaze2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze2Desc_BeforeShow

//Custom Code @128-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Glaze2->GetValue();
		$AddSampleCeramic->Glaze2Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Glaze2Desc_BeforeShow @127-1C86040C
    return $AddSampleCeramic_Glaze2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze2Desc_BeforeShow

//AddSampleCeramic_Glaze3Desc_BeforeShow @129-267DCF57
function AddSampleCeramic_Glaze3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze3Desc_BeforeShow

//Custom Code @130-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Glaze3->GetValue();
		$AddSampleCeramic->Glaze3Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Glaze3Desc_BeforeShow @129-F3D4B2ED
    return $AddSampleCeramic_Glaze3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze3Desc_BeforeShow

//AddSampleCeramic_Glaze4Desc_BeforeShow @131-E625AF7A
function AddSampleCeramic_Glaze4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze4Desc_BeforeShow

//Custom Code @132-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Glaze4->GetValue();
		$AddSampleCeramic->Glaze4Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Glaze4Desc_BeforeShow @131-12FAB889
    return $AddSampleCeramic_Glaze4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze4Desc_BeforeShow

//AddSampleCeramic_DesignMat1Desc_BeforeShow @133-CCA19380
function AddSampleCeramic_DesignMat1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat1Desc_BeforeShow

//Custom Code @134-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->DesignMat1->GetValue();
		$AddSampleCeramic->DesignMat1Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat1Desc_BeforeShow @133-9743EB9A
    return $AddSampleCeramic_DesignMat1Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat1Desc_BeforeShow

//AddSampleCeramic_DesignMat2Desc_BeforeShow @135-F028DE4F
function AddSampleCeramic_DesignMat2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat2Desc_BeforeShow

//Custom Code @136-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->DesignMat2->GetValue();
		$AddSampleCeramic->DesignMat2Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat2Desc_BeforeShow @135-7DC536F8
    return $AddSampleCeramic_DesignMat2Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat2Desc_BeforeShow

//AddSampleCeramic_DesignMat3Desc_BeforeShow @137-5280E735
function AddSampleCeramic_DesignMat3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat3Desc_BeforeShow

//Custom Code @138-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->DesignMat3->GetValue();
		$AddSampleCeramic->DesignMat3Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat3Desc_BeforeShow @137-92978019
    return $AddSampleCeramic_DesignMat3Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat3Desc_BeforeShow

//AddSampleCeramic_DesignMat4Desc_BeforeShow @139-893A45D1
function AddSampleCeramic_DesignMat4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat4Desc_BeforeShow

//Custom Code @140-2A29BDB7
	$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->DesignMat4->GetValue();
		$AddSampleCeramic->DesignMat4Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat4Desc_BeforeShow @139-73B98A7D
    return $AddSampleCeramic_DesignMat4Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat4Desc_BeforeShow

//AddSampleCeramic_ClayDesc_BeforeShow @146-E712DEB4
function AddSampleCeramic_ClayDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_ClayDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ClayDesc_BeforeShow

//Custom Code @147-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Clay->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->ClayDesc->SetValue(CCDLookUp("ClayDescription","tblClay","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_ClayDesc_BeforeShow @146-561D7D4E
    return $AddSampleCeramic_ClayDesc_BeforeShow;
}
//End Close AddSampleCeramic_ClayDesc_BeforeShow

//AddSampleCeramic_ClayCode_BeforeShow @148-5430BCDF
function AddSampleCeramic_ClayCode_BeforeShow(& $sender)
{
    $AddSampleCeramic_ClayCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ClayCode_BeforeShow

//Custom Code @149-2A29BDB7
global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Clay->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->ClayCode->SetValue(CCDLookUp("ClayCode","tblClay","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_ClayCode_BeforeShow @148-A59D60CA
    return $AddSampleCeramic_ClayCode_BeforeShow;
}
//End Close AddSampleCeramic_ClayCode_BeforeShow

//AddSampleCeramic_Casting1Code_BeforeShow @150-FCC33553
function AddSampleCeramic_Casting1Code_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting1Code_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting1Code_BeforeShow

//Custom Code @154-2A29BDB7
$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting1->GetValue();
		$AddSampleCeramic->Casting1Code->SetValue(CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$DBGayaFusionAll)." - ");
	}
//End Custom Code

//Close AddSampleCeramic_Casting1Code_BeforeShow @150-E2911FCB
    return $AddSampleCeramic_Casting1Code_BeforeShow;
}
//End Close AddSampleCeramic_Casting1Code_BeforeShow

//AddSampleCeramic_Casting2Code_BeforeShow @151-DC7BE895
function AddSampleCeramic_Casting2Code_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting2Code_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting2Code_BeforeShow

//Custom Code @155-2A29BDB7
$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting2->GetValue();
		$AddSampleCeramic->Casting2Code->SetValue(CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$DBGayaFusionAll)." - ");
	}
//End Custom Code

//Close AddSampleCeramic_Casting2Code_BeforeShow @151-0817C2A9
    return $AddSampleCeramic_Casting2Code_BeforeShow;
}
//End Close AddSampleCeramic_Casting2Code_BeforeShow

//AddSampleCeramic_Casting3Code_BeforeShow @152-753CA1E8
function AddSampleCeramic_Casting3Code_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting3Code_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting3Code_BeforeShow

//Custom Code @156-2A29BDB7
$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting3->GetValue();
		$AddSampleCeramic->Casting3Code->SetValue(CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$DBGayaFusionAll)." - ");
	}
//End Custom Code

//Close AddSampleCeramic_Casting3Code_BeforeShow @152-E7457448
    return $AddSampleCeramic_Casting3Code_BeforeShow;
}
//End Close AddSampleCeramic_Casting3Code_BeforeShow

//AddSampleCeramic_Casting4Code_BeforeShow @153-9D0A5319
function AddSampleCeramic_Casting4Code_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting4Code_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting4Code_BeforeShow

//Custom Code @157-2A29BDB7
$sID = CCGetFromGet("sID", 0);
	if($sID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Casting4->GetValue();
		$AddSampleCeramic->Casting4Code->SetValue(CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$DBGayaFusionAll)." - ");
	}
//End Custom Code

//Close AddSampleCeramic_Casting4Code_BeforeShow @153-066B7E2C
    return $AddSampleCeramic_Casting4Code_BeforeShow;
}
//End Close AddSampleCeramic_Casting4Code_BeforeShow

?>
