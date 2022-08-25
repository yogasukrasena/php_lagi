<?php
//BindEvents Method @1-5A9F68F5
function BindEvents()
{
    global $AddCollect;
    $AddCollect->CCSEvents["AfterUpdate"] = "AddCollect_AfterUpdate";
    $AddCollect->CCSEvents["BeforeInsert"] = "AddCollect_BeforeInsert";
    $AddCollect->CCSEvents["BeforeUpdate"] = "AddCollect_BeforeUpdate";
    $AddCollect->CCSEvents["BeforeShow"] = "AddCollect_BeforeShow";
    $AddCollect->CCSEvents["AfterInsert"] = "AddCollect_AfterInsert";
}
//End BindEvents Method

//AddCollect_AfterUpdate @2-6018E5F5
function AddCollect_AfterUpdate(& $sender)
{
    $AddCollect_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddCollect; //Compatibility
//End AddCollect_AfterUpdate

//Custom Code @17-2A29BDB7
	global $AddCollect;
	$db = new clsDBGayaFusionAll();
  	$CollectID=CCGetFromGet("ID",0);
  	$CollectCode=
	$AddCollect->DesignCode->GetValue().
	$AddCollect->NameCode->GetValue().
	$AddCollect->CategoryCode->GetValue().
	$AddCollect->SizeCode->GetValue().
	$AddCollect->TextureCode->GetValue().
	$AddCollect->ColorCode->GetValue().
	$AddCollect->MaterialCode->GetValue();
  	$sql="UPDATE tblCollect_Master SET CollectCode='$CollectCode' WHERE ID=$CollectID";
  	CCGetDBValue($sql,$db);
	$db->close();
	//$AddCollect->test->SetValue($CollectCode);
//End Custom Code

//Close AddCollect_AfterUpdate @2-61CFDE85
    return $AddCollect_AfterUpdate;
}
//End Close AddCollect_AfterUpdate

//DEL  

//AddCollect_BeforeInsert @2-359D0865
function AddCollect_BeforeInsert(& $sender)
{
    $AddCollect_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddCollect; //Compatibility
//End AddCollect_BeforeInsert

//Custom Code @20-2A29BDB7
	global $AddCollect;
  	$db = new clsDBGayaFusionAll();
  	$CollectCode=
	$AddCollect->DesignCode->GetValue().
	$AddCollect->NameCode->GetValue().
	$AddCollect->CategoryCode->GetValue().
	$AddCollect->SizeCode->GetValue().
	$AddCollect->TextureCode->GetValue().
	$AddCollect->ColorCode->GetValue().
	$AddCollect->MaterialCode->GetValue();
  	$sql="SELECT ID FROM tblCollect_Master WHERE CollectCode='$CollectCode'";
  	$db->query($sql);
	$result = $db->next_record();
	if ($result){
		$AddCollect->InsertAllowed=false;
		$AddCollect->Errors->addError("Collection Code Already Use. Data Not Saved");
	}
	$db->close();
//End Custom Code

//Close AddCollect_BeforeInsert @2-B154BFBF
    return $AddCollect_BeforeInsert;
}
//End Close AddCollect_BeforeInsert

//AddCollect_BeforeUpdate @2-8143B276
function AddCollect_BeforeUpdate(& $sender)
{
    $AddCollect_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddCollect; //Compatibility
//End AddCollect_BeforeUpdate

//Custom Code @22-2A29BDB7
	global $AddCollect;
  	$db = new clsDBGayaFusionAll();
  	$CollectCode=
	$AddCollect->DesignCode->GetValue().
	$AddCollect->NameCode->GetValue().
	$AddCollect->CategoryCode->GetValue().
	$AddCollect->SizeCode->GetValue().
	$AddCollect->TextureCode->GetValue().
	$AddCollect->ColorCode->GetValue().
	$AddCollect->MaterialCode->GetValue();
  	$sql="SELECT ID FROM tblCollect_Master WHERE CollectCode='$CollectCode'";
  	$db->query($sql);
	$result = $db->next_record();
	if ($result){
		$AddCollect->UpdateAllowed=false;
		$AddCollect->Errors->addError("Collection Code Already Use. Data Not Saved");
	}
	$db->close();
//End Custom Code

//Close AddCollect_BeforeUpdate @2-7E7D7E30
    return $AddCollect_BeforeUpdate;
}
//End Close AddCollect_BeforeUpdate

//AddCollect_BeforeShow @2-B028910E
function AddCollect_BeforeShow(& $sender)
{
    $AddCollect_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddCollect; //Compatibility
//End AddCollect_BeforeShow

//Custom Code @24-2A29BDB7
	global $AddCollect;
	if(!$AddCollect->EditMode)($AddCollect->LinkEdit->Visible=false);
//End Custom Code

//Close AddCollect_BeforeShow @2-46F72BE1
    return $AddCollect_BeforeShow;
}
//End Close AddCollect_BeforeShow

//AddCollect_AfterInsert @2-2EC7FA2E
function AddCollect_AfterInsert(& $sender)
{
    $AddCollect_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddCollect; //Compatibility
//End AddCollect_AfterInsert

//Custom Code @26-2A29BDB7
	global $AddCollect;
  	$db = new clsDBGayaFusionAll();
  	$CollectID= mysql_insert_id();
  	$CollectCode=
	$AddCollect->DesignCode->GetValue().
	$AddCollect->NameCode->GetValue().
	$AddCollect->CategoryCode->GetValue().
	$AddCollect->SizeCode->GetValue().
	$AddCollect->TextureCode->GetValue().
	$AddCollect->ColorCode->GetValue().
	$AddCollect->MaterialCode->GetValue();
  	$sql="UPDATE tblCollect_Master SET CollectCode='$CollectCode' WHERE ID=$CollectID";
  	CCGetDBValue($sql,$db);
	$db->close();
//End Custom Code

//Close AddCollect_AfterInsert @2-AEE61F0A
    return $AddCollect_AfterInsert;
}
//End Close AddCollect_AfterInsert

?>
