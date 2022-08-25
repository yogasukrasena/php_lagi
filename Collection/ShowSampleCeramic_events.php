<?php
//BindEvents Method @1-EF380887
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
    $AddSampleCeramic->DesignDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_DesignDesc_BeforeShow";
    $AddSampleCeramic->NameCode->CCSEvents["BeforeShow"] = "AddSampleCeramic_NameCode_BeforeShow";
    $AddSampleCeramic->CategoryDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_CategoryDesc_BeforeShow";
    $AddSampleCeramic->SizeDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_SizeDesc_BeforeShow";
    $AddSampleCeramic->TextureDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_TextureDesc_BeforeShow";
    $AddSampleCeramic->ColorDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_ColorDesc_BeforeShow";
    $AddSampleCeramic->MaterialDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_MaterialDesc_BeforeShow";
    $AddSampleCeramic->lblClay->CCSEvents["BeforeShow"] = "AddSampleCeramic_lblClay_BeforeShow";
    $AddSampleCeramic->CCSEvents["BeforeShow"] = "AddSampleCeramic_BeforeShow";
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

//Custom Code @251-2A29BDB7
$ID = CCGetFromGet("ID",0);
if($ID > 0){
	$db = new clsDBGayaFusionAll();
	$IDnya = $Container->Tools1->GetValue();
	$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$db);
	$Container->ToolsPic1->SetValue($ToolsPhoto);
	$db->close();
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

//Custom Code @252-2A29BDB7
$ID = CCGetFromGet("ID",0);
if($ID > 0){
	$db = new clsDBGayaFusionAll();
	$IDnya = $Container->Tools2->GetValue();
	$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$db);
	$Container->ToolsPic2->SetValue($ToolsPhoto);
	$db->close();
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

//Custom Code @253-2A29BDB7
$ID = CCGetFromGet("ID",0);
if($ID > 0){
	$db = new clsDBGayaFusionAll();
	$IDnya = $Container->Tools3->GetValue();
	$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$db);
	$Container->ToolsPic3->SetValue($ToolsPhoto);
	$db->close();
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

//Custom Code @254-2A29BDB7
$ID = CCGetFromGet("ID",0);
if($ID > 0){
	$db = new clsDBGayaFusionAll();
	$IDnya = $Container->Tools4->GetValue();
	$ToolsPhoto="../upload/".CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$db);
	$Container->ToolsPic4->SetValue($ToolsPhoto);
	$db->close();
}
//End Custom Code

//Close AddSampleCeramic_ToolsPic4_BeforeShow @84-ECC67DAF
    return $AddSampleCeramic_ToolsPic4_BeforeShow;
}
//End Close AddSampleCeramic_ToolsPic4_BeforeShow

//AddSampleCeramic_Casting1Desc_BeforeShow @85-6A2BBDC3
function AddSampleCeramic_Casting1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting1Desc_BeforeShow

//Custom Code @86-2A29BDB7
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Casting1->GetValue();
		$Isinya = CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$db)." - ".CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$db);
		$Container->Casting1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Casting2->GetValue();
		$Isinya = CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$db)." - ".CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$db);
		$Container->Casting2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Casting3->GetValue();
		$Isinya = CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$db)." - ".CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$db);
		$Container->Casting3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Casting4->GetValue();
		$Isinya = CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$db)." - ".CCDLookUp("CastingCode","tblCasting","ID = $IDnya",$db);
		$Container->Casting4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Estruder1->GetValue();
		$Isinya = CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$db)." - ".CCDLookUp("EstruderCode","tblEstruder","ID = $IDnya",$db);
		$Container->Estruder1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Estruder2->GetValue();
		$Isinya = CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$db)." - ".CCDLookUp("EstruderCode","tblEstruder","ID = $IDnya",$db);
		$Container->Estruder2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Estruder3->GetValue();
		$Isinya = CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$db)." - ".CCDLookUp("EstruderCode","tblEstruder","ID = $IDnya",$db);
		$Container->Estruder3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Estruder4->GetValue();
		$Isinya = CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$db)." - ".CCDLookUp("EstruderCode","tblEstruder","ID = $IDnya",$db);
		$Container->Estruder4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Texture1->GetValue();
		$Isinya = CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$db)." - ".CCDLookUp("TextureCode","tblTexture","ID = $IDnya",$db);
		$Container->Texture1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Texture2->GetValue();
		$Isinya = CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$db)." - ".CCDLookUp("TextureCode","tblTexture","ID = $IDnya",$db);
		$Container->Texture2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Texture3->GetValue();
		$Isinya = CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$db)." - ".CCDLookUp("TextureCode","tblTexture","ID = $IDnya",$db);
		$Container->Texture3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Texture4->GetValue();
		$Isinya = CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$db)." - ".CCDLookUp("TextureCode","tblTexture","ID = $IDnya",$db);
		$Container->Texture4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Engobe1->GetValue();
		$Isinya = CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$db)." - ".CCDLookUp("EngobeCode","tblEngobe","ID = $IDnya",$db);
		$Container->Engobe1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Engobe2->GetValue();
		$Isinya = CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$db)." - ".CCDLookUp("EngobeCode","tblEngobe","ID = $IDnya",$db);
		$Container->Engobe2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Engobe3->GetValue();
		$Isinya = CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$db)." - ".CCDLookUp("EngobeCode","tblEngobe","ID = $IDnya",$db);
		$Container->Engobe3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Engobe4->GetValue();
		$Isinya = CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$db)." - ".CCDLookUp("EngobeCode","tblEngobe","ID = $IDnya",$db);
		$Container->Engobe4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->StainOxide1->GetValue();
		$Isinya = CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$db)." - ".CCDLookUp("StainOxideCode","tblStainOxide","ID = $IDnya",$db);
		$Container->StainOxide1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->StainOxide2->GetValue();
		$Isinya = CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$db)." - ".CCDLookUp("StainOxideCode","tblStainOxide","ID = $IDnya",$db);
		$Container->StainOxide2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->StainOxide3->GetValue();
		$Isinya = CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$db)." - ".CCDLookUp("StainOxideCode","tblStainOxide","ID = $IDnya",$db);
		$Container->StainOxide3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->StainOxide4->GetValue();
		$Isinya = CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$db)." - ".CCDLookUp("StainOxideCode","tblStainOxide","ID = $IDnya",$db);
		$Container->StainOxide4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Glaze1->GetValue();
		$Isinya = CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$db)." - ".CCDLookUp("GlazeCode","tblGlaze","ID = $IDnya",$db);
		$Container->Glaze1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Glaze2->GetValue();
		$Isinya = CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$db)." - ".CCDLookUp("GlazeCode","tblGlaze","ID = $IDnya",$db);
		$Container->Glaze2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Glaze3->GetValue();
		$Isinya = CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$db)." - ".CCDLookUp("GlazeCode","tblGlaze","ID = $IDnya",$db);
		$Container->Glaze3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->Glaze4->GetValue();
		$Isinya = CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$db)." - ".CCDLookUp("GlazeCode","tblGlaze","ID = $IDnya",$db);
		$Container->Glaze4Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->DesignMat1->GetValue();
		$Isinya = CCDLookUp("DesignMatDescription","tblDesignMat","ID = $IDnya",$db)." - ".CCDLookUp("DesignMatCode","tblDesignMat","ID = $IDnya",$db);
		$Container->DesignMat1Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->DesignMat2->GetValue();
		$Isinya = CCDLookUp("DesignMatDescription","tblDesignMat","ID = $IDnya",$db)." - ".CCDLookUp("DesignMatCode","tblDesignMat","ID = $IDnya",$db);
		$Container->DesignMat2Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->DesignMat3->GetValue();
		$Isinya = CCDLookUp("DesignMatDescription","tblDesignMat","ID = $IDnya",$db)." - ".CCDLookUp("DesignMatCode","tblDesignMat","ID = $IDnya",$db);
		$Container->DesignMat3Desc->SetValue($Isinya);
		$db->close();
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
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		$db = new clsDBGayaFusionAll();
		$IDnya = $Container->DesignMat4->GetValue();
		$Isinya = CCDLookUp("DesignMatDescription","tblDesignMat","ID = $IDnya",$db)." - ".CCDLookUp("DesignMatCode","tblDesignMat","ID = $IDnya",$db);
		$Container->DesignMat4Desc->SetValue($Isinya);
		$db->close();
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat4Desc_BeforeShow @139-73B98A7D
    return $AddSampleCeramic_DesignMat4Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat4Desc_BeforeShow

//AddSampleCeramic_DesignDesc_BeforeShow @143-BE63C959
function AddSampleCeramic_DesignDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignDesc_BeforeShow

//Custom Code @156-2A29BDB7
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("DesignCode","");
		$AddSampleCeramic->DesignDesc->SetValue(CCDLookUp("DesignName","tblCollect_Design", "DesignCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_DesignDesc_BeforeShow @143-D824D90C
    return $AddSampleCeramic_DesignDesc_BeforeShow;
}
//End Close AddSampleCeramic_DesignDesc_BeforeShow

//AddSampleCeramic_NameCode_BeforeShow @144-5FC4FCB8
function AddSampleCeramic_NameCode_BeforeShow(& $sender)
{
    $AddSampleCeramic_NameCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_NameCode_BeforeShow

//Custom Code @157-2A29BDB7
global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("NameCode","");
		$AddSampleCeramic->NameDesc->SetValue(CCDLookUp("NameDesc","tblCollect_Name", "NameCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_NameCode_BeforeShow @144-698EDD41
    return $AddSampleCeramic_NameCode_BeforeShow;
}
//End Close AddSampleCeramic_NameCode_BeforeShow

//AddSampleCeramic_CategoryDesc_BeforeShow @147-500216A8
function AddSampleCeramic_CategoryDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_CategoryDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_CategoryDesc_BeforeShow

//Custom Code @158-2A29BDB7
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("CategoryCode","");
		$AddSampleCeramic->CategoryDesc->SetValue(CCDLookUp("CategoryName","tblCollect_Category", "CategoryCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_CategoryDesc_BeforeShow @147-EFCBEB4A
    return $AddSampleCeramic_CategoryDesc_BeforeShow;
}
//End Close AddSampleCeramic_CategoryDesc_BeforeShow

//AddSampleCeramic_SizeDesc_BeforeShow @149-DC906926
function AddSampleCeramic_SizeDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_SizeDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_SizeDesc_BeforeShow

//Custom Code @159-2A29BDB7
	global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("SizeCode","");
		$AddSampleCeramic->SizeDesc->SetValue(CCDLookUp("SizeName","tblCollect_Size", "SizeCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_SizeDesc_BeforeShow @149-BD9C3A89
    return $AddSampleCeramic_SizeDesc_BeforeShow;
}
//End Close AddSampleCeramic_SizeDesc_BeforeShow

//AddSampleCeramic_TextureDesc_BeforeShow @151-06F49D12
function AddSampleCeramic_TextureDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_TextureDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_TextureDesc_BeforeShow

//Custom Code @160-2A29BDB7
	global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("TextureCode","");
		$AddSampleCeramic->TextureDesc->SetValue(CCDLookUp("TextureName","tblCollect_Texture", "TextureCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_TextureDesc_BeforeShow @151-D77C8271
    return $AddSampleCeramic_TextureDesc_BeforeShow;
}
//End Close AddSampleCeramic_TextureDesc_BeforeShow

//AddSampleCeramic_ColorDesc_BeforeShow @153-79AFDCE3
function AddSampleCeramic_ColorDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_ColorDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ColorDesc_BeforeShow

//Custom Code @161-2A29BDB7
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("ColorCode","");
		$AddSampleCeramic->ColorDesc->SetValue(CCDLookUp("ColorName","tblCollect_Color", "ColorCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_ColorDesc_BeforeShow @153-069AE744
    return $AddSampleCeramic_ColorDesc_BeforeShow;
}
//End Close AddSampleCeramic_ColorDesc_BeforeShow

//AddSampleCeramic_MaterialDesc_BeforeShow @155-4C8530D6
function AddSampleCeramic_MaterialDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_MaterialDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_MaterialDesc_BeforeShow

//Custom Code @162-2A29BDB7
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = CCGetFromGet("MaterialCode","");
		$AddSampleCeramic->MaterialDesc->SetValue(CCDLookUp("MaterialName","tblCollect_Material", "MaterialCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close AddSampleCeramic_MaterialDesc_BeforeShow @155-90B29C1B
    return $AddSampleCeramic_MaterialDesc_BeforeShow;
}
//End Close AddSampleCeramic_MaterialDesc_BeforeShow

//AddSampleCeramic_lblClay_BeforeShow @249-E925EDF7
function AddSampleCeramic_lblClay_BeforeShow(& $sender)
{
    $AddSampleCeramic_lblClay_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_lblClay_BeforeShow

//Custom Code @250-2A29BDB7
	$db = new clsDBGayaFusionAll();
	$ClayID = $AddSampleCeramic->Clay->GetValue();
	$Claynya = CCDLookUp("ClayDescription","tblClay","ID = ".$db->ToSQL($ClayID,ccsInteger),$db);
	$Claynya = $Claynya." - ".CCDLookUp("ClayCode","tblClay","ID = ".$db->ToSQL($ClayID,ccsInteger),$db);
	$AddSampleCeramic->lblClay->SetValue($Claynya);
	$db->close();
//End Custom Code

//Close AddSampleCeramic_lblClay_BeforeShow @249-7D1C21A7
    return $AddSampleCeramic_lblClay_BeforeShow;
}
//End Close AddSampleCeramic_lblClay_BeforeShow

//AddSampleCeramic_BeforeShow @2-916F59DA
function AddSampleCeramic_BeforeShow(& $sender)
{
    $AddSampleCeramic_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_BeforeShow

//Custom Code @141-2A29BDB7
	global $Tpl;
	$ID = CCGetFromGet("ID", 0);
	if($ID > 0){
		global $DBGayaFusionAll;
		global $AddSampleCeramic;
		$IDnya = $AddSampleCeramic->Tools1->GetValue();
		$ToolsPhoto1=CCDLookUp("ToolsPhoto1","tblTools","ID = $IDnya",$DBGayaFusionAll);
		$Tpl->setvar("TollsPic1", $ToolsPhoto1);
	}
//End Custom Code

//Close AddSampleCeramic_BeforeShow @2-BB933A94
    return $AddSampleCeramic_BeforeShow;
}
//End Close AddSampleCeramic_BeforeShow
?>
