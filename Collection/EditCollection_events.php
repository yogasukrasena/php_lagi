<?php
//BindEvents Method @1-CC087D5C
function BindEvents()
{
    global $AddSampleCeramic;
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
    $AddSampleCeramic->Tools1Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Tools1Desc_BeforeShow";
    $AddSampleCeramic->Tools2Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Tools2Desc_BeforeShow";
    $AddSampleCeramic->Tools3Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Tools3Desc_BeforeShow";
    $AddSampleCeramic->Tools4Desc->CCSEvents["BeforeShow"] = "AddSampleCeramic_Tools4Desc_BeforeShow";
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
    $AddSampleCeramic->AddClay->CCSEvents["BeforeShow"] = "AddSampleCeramic_AddClay_BeforeShow";
    $AddSampleCeramic->ClayDesc->CCSEvents["BeforeShow"] = "AddSampleCeramic_ClayDesc_BeforeShow";
    $AddSampleCeramic->AddCasting1->CCSEvents["BeforeShow"] = "AddSampleCeramic_AddCasting1_BeforeShow";
    $AddSampleCeramic->AddTexture3->CCSEvents["BeforeShow"] = "AddSampleCeramic_AddTexture3_BeforeShow";
    $AddSampleCeramic->AddTexture4->CCSEvents["BeforeShow"] = "AddSampleCeramic_AddTexture4_BeforeShow";
    $AddSampleCeramic->LinkCopy->CCSEvents["BeforeShow"] = "AddSampleCeramic_LinkCopy_BeforeShow";
}
//End BindEvents Method

//AddSampleCeramic_Casting1Desc_BeforeShow @91-6A2BBDC3
function AddSampleCeramic_Casting1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting1Desc_BeforeShow

//Custom Code @123-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Casting1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddCasting1->Visible = false;
		$AddSampleCeramic->DelCasting1->Visible = true;
		$AddSampleCeramic->Casting1Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddCasting1->Visible = true;
		$AddSampleCeramic->DelCasting1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Casting1Desc_BeforeShow @91-1111024F
    return $AddSampleCeramic_Casting1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting1Desc_BeforeShow

//AddSampleCeramic_Casting2Desc_BeforeShow @92-4A936005
function AddSampleCeramic_Casting2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting2Desc_BeforeShow

//Custom Code @124-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Casting2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddCasting2->Visible = false;
		$AddSampleCeramic->DelCasting2->Visible = true;
		$AddSampleCeramic->Casting2Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddCasting2->Visible = true;
		$AddSampleCeramic->DelCasting2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Casting2Desc_BeforeShow @92-FB97DF2D
    return $AddSampleCeramic_Casting2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting2Desc_BeforeShow

//AddSampleCeramic_Casting3Desc_BeforeShow @93-E3D42978
function AddSampleCeramic_Casting3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting3Desc_BeforeShow

//Custom Code @125-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Casting3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddCasting3->Visible = false;
		$AddSampleCeramic->DelCasting3->Visible = true;
		$AddSampleCeramic->Casting3Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddCasting3->Visible = true;
		$AddSampleCeramic->DelCasting3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Casting3Desc_BeforeShow @93-14C569CC
    return $AddSampleCeramic_Casting3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting3Desc_BeforeShow

//AddSampleCeramic_Casting4Desc_BeforeShow @94-0BE2DB89
function AddSampleCeramic_Casting4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Casting4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Casting4Desc_BeforeShow

//Custom Code @126-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Casting4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddCasting4->Visible = false;
		$AddSampleCeramic->DelCasting4->Visible = true;
		$AddSampleCeramic->Casting4Desc->SetValue(CCDLookUp("CastingDescription","tblCasting","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddCasting4->Visible = true;
		$AddSampleCeramic->DelCasting4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Casting4Desc_BeforeShow @94-F5EB63A8
    return $AddSampleCeramic_Casting4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Casting4Desc_BeforeShow

//AddSampleCeramic_Estruder1Desc_BeforeShow @95-C22EEFB8
function AddSampleCeramic_Estruder1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder1Desc_BeforeShow

//Custom Code @127-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Estruder1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEstruder1->Visible = false;
		$AddSampleCeramic->DelEstruder1->Visible = true;
		$AddSampleCeramic->Estruder1Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEstruder1->Visible = true;
		$AddSampleCeramic->DelEstruder1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Estruder1Desc_BeforeShow @95-E0CEB030
    return $AddSampleCeramic_Estruder1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder1Desc_BeforeShow

//AddSampleCeramic_Estruder2Desc_BeforeShow @96-2E0B299B
function AddSampleCeramic_Estruder2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder2Desc_BeforeShow

//Custom Code @128-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Estruder2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEstruder2->Visible = false;
		$AddSampleCeramic->DelEstruder2->Visible = true;
		$AddSampleCeramic->Estruder2Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEstruder2->Visible = true;
		$AddSampleCeramic->DelEstruder2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Estruder2Desc_BeforeShow @96-0A486D52
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

//Custom Code @129-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Estruder3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEstruder3->Visible = false;
		$AddSampleCeramic->DelEstruder3->Visible = true;
		$AddSampleCeramic->Estruder3Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEstruder3->Visible = true;
		$AddSampleCeramic->DelEstruder3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Estruder3Desc_BeforeShow @97-E51ADBB3
    return $AddSampleCeramic_Estruder3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder3Desc_BeforeShow

//AddSampleCeramic_Estruder4Desc_BeforeShow @98-2D31A39C
function AddSampleCeramic_Estruder4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Estruder4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Estruder4Desc_BeforeShow

//Custom Code @130-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Estruder4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEstruder4->Visible = false;
		$AddSampleCeramic->DelEstruder4->Visible = true;
		$AddSampleCeramic->Estruder4Desc->SetValue(CCDLookUp("EstruderDescription","tblEstruder","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEstruder4->Visible = true;
		$AddSampleCeramic->DelEstruder4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Estruder4Desc_BeforeShow @98-0434D1D7
    return $AddSampleCeramic_Estruder4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Estruder4Desc_BeforeShow

//AddSampleCeramic_Texture1Desc_BeforeShow @99-26E29A64
function AddSampleCeramic_Texture1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture1Desc_BeforeShow

//Custom Code @131-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Texture1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTexture1->Visible = false;
		$AddSampleCeramic->DelTexture1->Visible = true;
		$AddSampleCeramic->Texture1Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTexture1->Visible = true;
		$AddSampleCeramic->DelTexture1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Texture1Desc_BeforeShow @99-A3A7B2D3
    return $AddSampleCeramic_Texture1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture1Desc_BeforeShow

//AddSampleCeramic_Texture2Desc_BeforeShow @100-065A47A2
function AddSampleCeramic_Texture2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture2Desc_BeforeShow

//Custom Code @132-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Texture2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->Texture2Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
		$AddSampleCeramic->AddTexture2->Visible = false;
		$AddSampleCeramic->DelTexture2->Visible = true;
	}else{
		$AddSampleCeramic->AddTexture2->Visible = true;
		$AddSampleCeramic->DelTexture2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Texture2Desc_BeforeShow @100-49216FB1
    return $AddSampleCeramic_Texture2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture2Desc_BeforeShow

//AddSampleCeramic_Texture3Desc_BeforeShow @101-AF1D0EDF
function AddSampleCeramic_Texture3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture3Desc_BeforeShow

//Custom Code @133-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Texture3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->Texture3Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_Texture3Desc_BeforeShow @101-A673D950
    return $AddSampleCeramic_Texture3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture3Desc_BeforeShow

//AddSampleCeramic_Texture4Desc_BeforeShow @102-472BFC2E
function AddSampleCeramic_Texture4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Texture4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Texture4Desc_BeforeShow

//Custom Code @134-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Texture4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTexture4->Visible = false;
		$AddSampleCeramic->DelTexture4->Visible = true;
		$AddSampleCeramic->Texture4Desc->SetValue(CCDLookUp("TextureDescription","tblTexture","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTexture4->Visible = true;
		$AddSampleCeramic->DelTexture4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Texture4Desc_BeforeShow @102-475DD334
    return $AddSampleCeramic_Texture4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Texture4Desc_BeforeShow

//AddSampleCeramic_Tools1Desc_BeforeShow @103-40617E46
function AddSampleCeramic_Tools1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Tools1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Tools1Desc_BeforeShow

//Custom Code @135-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Tools1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTools1->Visible = false;
		$AddSampleCeramic->DelTools1->Visible = true;
		$AddSampleCeramic->Tools1Desc->SetValue(CCDLookUp("ToolsDescription","tblTools","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTools1->Visible = true;
		$AddSampleCeramic->DelTools1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Tools1Desc_BeforeShow @103-815BC106
    return $AddSampleCeramic_Tools1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Tools1Desc_BeforeShow

//AddSampleCeramic_Tools2Desc_BeforeShow @104-F9A9F07A
function AddSampleCeramic_Tools2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Tools2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Tools2Desc_BeforeShow

//Custom Code @136-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Tools2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTools2->Visible = false;
		$AddSampleCeramic->DelTools2->Visible = true;
		$AddSampleCeramic->Tools2Desc->SetValue(CCDLookUp("ToolsDescription","tblTools","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTools2->Visible = true;
		$AddSampleCeramic->DelTools2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Tools2Desc_BeforeShow @104-6BDD1C64
    return $AddSampleCeramic_Tools2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Tools2Desc_BeforeShow

//AddSampleCeramic_Tools3Desc_BeforeShow @105-91118A6E
function AddSampleCeramic_Tools3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Tools3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Tools3Desc_BeforeShow

//Custom Code @137-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Tools3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTools3->Visible = false;
		$AddSampleCeramic->DelTools3->Visible = true;
		$AddSampleCeramic->Tools3Desc->SetValue(CCDLookUp("ToolsDescription","tblTools","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTools3->Visible = true;
		$AddSampleCeramic->DelTools3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Tools3Desc_BeforeShow @105-848FAA85
    return $AddSampleCeramic_Tools3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Tools3Desc_BeforeShow

//AddSampleCeramic_Tools4Desc_BeforeShow @106-5149EA43
function AddSampleCeramic_Tools4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Tools4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Tools4Desc_BeforeShow

//Custom Code @138-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Tools4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTools4->Visible = false;
		$AddSampleCeramic->DelTools4->Visible = true;
		$AddSampleCeramic->Tools4Desc->SetValue(CCDLookUp("ToolsDescription","tblTools","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddTools4->Visible = true;
		$AddSampleCeramic->DelTools4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Tools4Desc_BeforeShow @106-65A1A0E1
    return $AddSampleCeramic_Tools4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Tools4Desc_BeforeShow

//AddSampleCeramic_Engobe1Desc_BeforeShow @107-3C04CFF7
function AddSampleCeramic_Engobe1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe1Desc_BeforeShow

//Custom Code @139-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Engobe1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEngobe1->Visible = false;
		$AddSampleCeramic->DelEngobe1->Visible = true;
		$AddSampleCeramic->Engobe1Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEngobe1->Visible = true;
		$AddSampleCeramic->DelEngobe1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Engobe1Desc_BeforeShow @107-F8736F81
    return $AddSampleCeramic_Engobe1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe1Desc_BeforeShow

//AddSampleCeramic_Engobe2Desc_BeforeShow @108-8DD06285
function AddSampleCeramic_Engobe2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe2Desc_BeforeShow

//Custom Code @140-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Engobe2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEngobe2->Visible = false;
		$AddSampleCeramic->DelEngobe2->Visible = true;
		$AddSampleCeramic->Engobe2Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEngobe2->Visible = true;
		$AddSampleCeramic->DelEngobe2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Engobe2Desc_BeforeShow @108-12F5B2E3
    return $AddSampleCeramic_Engobe2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe2Desc_BeforeShow

//AddSampleCeramic_Engobe3Desc_BeforeShow @109-544CFB94
function AddSampleCeramic_Engobe3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe3Desc_BeforeShow

//Custom Code @141-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Engobe3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEngobe3->Visible = false;
		$AddSampleCeramic->DelEngobe3->Visible = true;
		$AddSampleCeramic->Engobe3Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEngobe3->Visible = true;
		$AddSampleCeramic->DelEngobe3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Engobe3Desc_BeforeShow @109-FDA70402
    return $AddSampleCeramic_Engobe3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe3Desc_BeforeShow

//AddSampleCeramic_Engobe4Desc_BeforeShow @110-35083E20
function AddSampleCeramic_Engobe4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Engobe4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Engobe4Desc_BeforeShow

//Custom Code @142-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Engobe4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddEngobe4->Visible = false;
		$AddSampleCeramic->DelEngobe4->Visible = true;
		$AddSampleCeramic->Engobe4Desc->SetValue(CCDLookUp("EngobeDescription","tblEngobe","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddEngobe4->Visible = true;
		$AddSampleCeramic->DelEngobe4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Engobe4Desc_BeforeShow @110-1C890E66
    return $AddSampleCeramic_Engobe4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Engobe4Desc_BeforeShow

//AddSampleCeramic_StainOxide1Desc_BeforeShow @111-424E57CE
function AddSampleCeramic_StainOxide1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide1Desc_BeforeShow

//Custom Code @143-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->StainOxide1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddStainOxide1->Visible = false;
		$AddSampleCeramic->DelStainOxide1->Visible = true;
		$AddSampleCeramic->StainOxide1Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddStainOxide1->Visible = true;
		$AddSampleCeramic->DelStainOxide1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide1Desc_BeforeShow @111-D6C0DCCE
    return $AddSampleCeramic_StainOxide1Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide1Desc_BeforeShow

//AddSampleCeramic_StainOxide2Desc_BeforeShow @112-D7AB18D9
function AddSampleCeramic_StainOxide2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide2Desc_BeforeShow

//Custom Code @144-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->StainOxide2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddStainOxide2->Visible = false;
		$AddSampleCeramic->DelStainOxide2->Visible = true;
		$AddSampleCeramic->StainOxide2Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddStainOxide2->Visible = true;
		$AddSampleCeramic->DelStainOxide2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide2Desc_BeforeShow @112-3C4601AC
    return $AddSampleCeramic_StainOxide2Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide2Desc_BeforeShow

//AddSampleCeramic_StainOxide3Desc_BeforeShow @113-A4F7DDD4
function AddSampleCeramic_StainOxide3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide3Desc_BeforeShow

//Custom Code @145-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->StainOxide3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddStainOxide3->Visible = false;
		$AddSampleCeramic->DelStainOxide3->Visible = true;
		$AddSampleCeramic->StainOxide3Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddStainOxide3->Visible = true;
		$AddSampleCeramic->DelStainOxide3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide3Desc_BeforeShow @113-D314B74D
    return $AddSampleCeramic_StainOxide3Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide3Desc_BeforeShow

//AddSampleCeramic_StainOxide4Desc_BeforeShow @114-271080B6
function AddSampleCeramic_StainOxide4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_StainOxide4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_StainOxide4Desc_BeforeShow

//Custom Code @146-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->StainOxide4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddStainOxide4->Visible = false;
		$AddSampleCeramic->DelStainOxide4->Visible = true;
		$AddSampleCeramic->StainOxide4Desc->SetValue(CCDLookUp("StainOxideDescription","tblStainOxide","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddStainOxide4->Visible = true;
		$AddSampleCeramic->DelStainOxide4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_StainOxide4Desc_BeforeShow @114-323ABD29
    return $AddSampleCeramic_StainOxide4Desc_BeforeShow;
}
//End Close AddSampleCeramic_StainOxide4Desc_BeforeShow

//AddSampleCeramic_Glaze1Desc_BeforeShow @115-F70D3B7F
function AddSampleCeramic_Glaze1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze1Desc_BeforeShow

//Custom Code @147-2A29BDB7
	$IDnya = $AddSampleCeramic->Glaze1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddGlaze1->Visible = false;
		$AddSampleCeramic->DelGlaze1->Visible = true;
		$AddSampleCeramic->Glaze1Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddGlaze1->Visible = true;
		$AddSampleCeramic->DelGlaze1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Glaze1Desc_BeforeShow @115-F600D96E
    return $AddSampleCeramic_Glaze1Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze1Desc_BeforeShow

//AddSampleCeramic_Glaze2Desc_BeforeShow @116-4EC5B543
function AddSampleCeramic_Glaze2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze2Desc_BeforeShow

//Custom Code @148-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Glaze2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddGlaze2->Visible = false;
		$AddSampleCeramic->DelGlaze2->Visible = true;
		$AddSampleCeramic->Glaze2Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddGlaze2->Visible = true;
		$AddSampleCeramic->DelGlaze2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Glaze2Desc_BeforeShow @116-1C86040C
    return $AddSampleCeramic_Glaze2Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze2Desc_BeforeShow

//AddSampleCeramic_Glaze3Desc_BeforeShow @117-267DCF57
function AddSampleCeramic_Glaze3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze3Desc_BeforeShow

//Custom Code @149-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Glaze3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddGlaze3->Visible = false;
		$AddSampleCeramic->DelGlaze3->Visible = true;
		$AddSampleCeramic->Glaze3Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddGlaze3->Visible = true;
		$AddSampleCeramic->DelGlaze3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Glaze3Desc_BeforeShow @117-F3D4B2ED
    return $AddSampleCeramic_Glaze3Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze3Desc_BeforeShow

//AddSampleCeramic_Glaze4Desc_BeforeShow @118-E625AF7A
function AddSampleCeramic_Glaze4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_Glaze4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_Glaze4Desc_BeforeShow

//Custom Code @150-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Glaze4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddGlaze4->Visible = false;
		$AddSampleCeramic->DelGlaze4->Visible = true;
		$AddSampleCeramic->Glaze4Desc->SetValue(CCDLookUp("GlazeDescription","tblGlaze","ID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddGlaze4->Visible = true;
		$AddSampleCeramic->DelGlaze4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_Glaze4Desc_BeforeShow @118-12FAB889
    return $AddSampleCeramic_Glaze4Desc_BeforeShow;
}
//End Close AddSampleCeramic_Glaze4Desc_BeforeShow

//AddSampleCeramic_DesignMat1Desc_BeforeShow @119-CCA19380
function AddSampleCeramic_DesignMat1Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat1Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat1Desc_BeforeShow

//Custom Code @151-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->DesignMat1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddDesignMat1->Visible = false;
		$AddSampleCeramic->DelDesignMat1->Visible = true;
		$AddSampleCeramic->DesignMat1Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddDesignMat1->Visible = true;
		$AddSampleCeramic->DelDesignMat1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat1Desc_BeforeShow @119-9743EB9A
    return $AddSampleCeramic_DesignMat1Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat1Desc_BeforeShow

//AddSampleCeramic_DesignMat2Desc_BeforeShow @120-F028DE4F
function AddSampleCeramic_DesignMat2Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat2Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat2Desc_BeforeShow

//Custom Code @152-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->DesignMat2->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddDesignMat2->Visible = false;
		$AddSampleCeramic->DelDesignMat2->Visible = true;
		$AddSampleCeramic->DesignMat2Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddDesignMat2->Visible = true;
		$AddSampleCeramic->DelDesignMat2->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat2Desc_BeforeShow @120-7DC536F8
    return $AddSampleCeramic_DesignMat2Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat2Desc_BeforeShow

//AddSampleCeramic_DesignMat3Desc_BeforeShow @121-5280E735
function AddSampleCeramic_DesignMat3Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat3Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat3Desc_BeforeShow

//Custom Code @153-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->DesignMat3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddDesignMat3->Visible = false;
		$AddSampleCeramic->DelDesignMat3->Visible = true;
		$AddSampleCeramic->DesignMat3Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddDesignMat3->Visible = true;
		$AddSampleCeramic->DelDesignMat3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat3Desc_BeforeShow @121-92978019
    return $AddSampleCeramic_DesignMat3Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat3Desc_BeforeShow

//AddSampleCeramic_DesignMat4Desc_BeforeShow @122-893A45D1
function AddSampleCeramic_DesignMat4Desc_BeforeShow(& $sender)
{
    $AddSampleCeramic_DesignMat4Desc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_DesignMat4Desc_BeforeShow

//Custom Code @154-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->DesignMat4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddDesignMat4->Visible = false;
		$AddSampleCeramic->DelDesignMat4->Visible = true;
		$AddSampleCeramic->DesignMat4Desc->SetValue(CCDLookUp("DesignMatDescription","tblDesignMat","DesignMatID = $IDnya",$DBGayaFusionAll));
	}else{
		$AddSampleCeramic->AddDesignMat4->Visible = true;
		$AddSampleCeramic->DelDesignMat4->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_DesignMat4Desc_BeforeShow @122-73B98A7D
    return $AddSampleCeramic_DesignMat4Desc_BeforeShow;
}
//End Close AddSampleCeramic_DesignMat4Desc_BeforeShow

//AddSampleCeramic_AddClay_BeforeShow @155-9B56BA5D
function AddSampleCeramic_AddClay_BeforeShow(& $sender)
{
    $AddSampleCeramic_AddClay_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_AddClay_BeforeShow

//Custom Code @223-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Clay->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddClay->Visible= false;
		$AddSampleCeramic->DelClay->Visible = true;
	}else{
		$AddSampleCeramic->AddClay->Visible= true;
		$AddSampleCeramic->DelClay->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_AddClay_BeforeShow @155-5B3CD21E
    return $AddSampleCeramic_AddClay_BeforeShow;
}
//End Close AddSampleCeramic_AddClay_BeforeShow

//AddSampleCeramic_ClayDesc_BeforeShow @157-E712DEB4
function AddSampleCeramic_ClayDesc_BeforeShow(& $sender)
{
    $AddSampleCeramic_ClayDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_ClayDesc_BeforeShow

//Custom Code @222-2A29BDB7
	global $AddSampleCeramic;
	$IDnya = $AddSampleCeramic->Clay->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->ClayDesc->SetValue(CCDLookUp("ClayDescription","tblClay","ID = $IDnya",$DBGayaFusionAll));
	}
//End Custom Code

//Close AddSampleCeramic_ClayDesc_BeforeShow @157-561D7D4E
    return $AddSampleCeramic_ClayDesc_BeforeShow;
}
//End Close AddSampleCeramic_ClayDesc_BeforeShow

//AddSampleCeramic_AddCasting1_BeforeShow @159-29BDF527
function AddSampleCeramic_AddCasting1_BeforeShow(& $sender)
{
    $AddSampleCeramic_AddCasting1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_AddCasting1_BeforeShow

//Custom Code @224-2A29BDB7
	$IDnya = $AddSampleCeramic->Casting1->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddCasting1->Visible= false;
		$AddSampleCeramic->DelCasting1->Visible = true;
	}else{
		$AddSampleCeramic->AddCasting1->Visible= true;
		$AddSampleCeramic->DelCasting1->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_AddCasting1_BeforeShow @159-F41CC759
    return $AddSampleCeramic_AddCasting1_BeforeShow;
}
//End Close AddSampleCeramic_AddCasting1_BeforeShow

//AddSampleCeramic_AddTexture3_BeforeShow @178-21E9709C
function AddSampleCeramic_AddTexture3_BeforeShow(& $sender)
{
    $AddSampleCeramic_AddTexture3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_AddTexture3_BeforeShow

//Custom Code @225-2A29BDB7
	$IDnya = $AddSampleCeramic->Texture3->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTexture3->Visible= false;
		$AddSampleCeramic->DelTexture3->Visible = true;
	}else{
		$AddSampleCeramic->AddTexture3->Visible= true;
		$AddSampleCeramic->DelTexture3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_AddTexture3_BeforeShow @178-B8A14ADE
    return $AddSampleCeramic_AddTexture3_BeforeShow;
}
//End Close AddSampleCeramic_AddTexture3_BeforeShow

//AddSampleCeramic_AddTexture4_BeforeShow @181-5F08AF0E
function AddSampleCeramic_AddTexture4_BeforeShow(& $sender)
{
    $AddSampleCeramic_AddTexture4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_AddTexture4_BeforeShow

//Custom Code @226-2A29BDB7
	$IDnya = $AddSampleCeramic->Texture4->GetValue();
	if($IDnya > 0){
		global $DBGayaFusionAll;
		$AddSampleCeramic->AddTexture4->Visible= false;
		$AddSampleCeramic->DelTexture4->Visible = true;
	}else{
		$AddSampleCeramic->AddTexture4->Visible= true;
		$AddSampleCeramic->DelTexture3->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_AddTexture4_BeforeShow @181-DD6CE01E
    return $AddSampleCeramic_AddTexture4_BeforeShow;
}
//End Close AddSampleCeramic_AddTexture4_BeforeShow

//AddSampleCeramic_LinkCopy_BeforeShow @228-4A7A3407
function AddSampleCeramic_LinkCopy_BeforeShow(& $sender)
{
    $AddSampleCeramic_LinkCopy_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddSampleCeramic; //Compatibility
//End AddSampleCeramic_LinkCopy_BeforeShow

//Custom Code @229-2A29BDB7
	if(!CCGetFromGet("ID","") == ""){
		$AddSampleCeramic->LinkCopy->Visible = true;
	}else{
		$AddSampleCeramic->LinkCopy->Visible = false;
	}
//End Custom Code

//Close AddSampleCeramic_LinkCopy_BeforeShow @228-28B3C9C3
    return $AddSampleCeramic_LinkCopy_BeforeShow;
}
//End Close AddSampleCeramic_LinkCopy_BeforeShow

//DEL  // -------------------------
//DEL      // Write your own code here.
//DEL  



?>
