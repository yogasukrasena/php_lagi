<?php
//BindEvents Method @1-841784B7
function BindEvents()
{
    global $tblreference;
    global $Record;
    $tblreference->tblreference_TotalRecords->CCSEvents["BeforeShow"] = "tblreference_tblreference_TotalRecords_BeforeShow";
    $tblreference->SampleCode->CCSEvents["BeforeShow"] = "tblreference_SampleCode_BeforeShow";
    $tblreference->CollectCode->CCSEvents["BeforeShow"] = "tblreference_CollectCode_BeforeShow";
    $Record->ds->CCSEvents["BeforeExecuteDelete"] = "Record_ds_BeforeExecuteDelete";
}
//End BindEvents Method

//tblreference_tblreference_TotalRecords_BeforeShow @3-A092A4D5
function tblreference_tblreference_TotalRecords_BeforeShow(& $sender)
{
    $tblreference_tblreference_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblreference; //Compatibility
//End tblreference_tblreference_TotalRecords_BeforeShow

//Retrieve number of records @4-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblreference_tblreference_TotalRecords_BeforeShow @3-4BB2E014
    return $tblreference_tblreference_TotalRecords_BeforeShow;
}
//End Close tblreference_tblreference_TotalRecords_BeforeShow

//tblreference_SampleCode_BeforeShow @24-8B1AB242
function tblreference_SampleCode_BeforeShow(& $sender)
{
    $tblreference_SampleCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblreference; //Compatibility
//End tblreference_SampleCode_BeforeShow

//Custom Code @25-2A29BDB7
	global $DBGayaFusionAll;
	$sID = $tblreference->sID->GetValue();
	$tblreference->SampleCode->SetValue(CCDLookUp("SampleDescription","sampleceramic","sID = $sID",$DBGayaFusionAll));
//End Custom Code

//Close tblreference_SampleCode_BeforeShow @24-EF14E21E
    return $tblreference_SampleCode_BeforeShow;
}
//End Close tblreference_SampleCode_BeforeShow

//tblreference_CollectCode_BeforeShow @26-511406DC
function tblreference_CollectCode_BeforeShow(& $sender)
{
    $tblreference_CollectCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblreference; //Compatibility
//End tblreference_CollectCode_BeforeShow

//Custom Code @27-2A29BDB7
	global $DBGayaFusionAll;
	$CollectID = $tblreference->CollectID->GetValue();
	$tblreference->CollectCode->SetValue(CCDLookUp("CollectCode","tblCollect_Master","ID = $CollectID",$DBGayaFusionAll));
//End Custom Code

//Close tblreference_CollectCode_BeforeShow @26-A5FCBE3A
    return $tblreference_CollectCode_BeforeShow;
}
//End Close tblreference_CollectCode_BeforeShow

//Record_ds_BeforeExecuteDelete @15-7F4E37DC
function Record_ds_BeforeExecuteDelete(& $sender)
{
    $Record_ds_BeforeExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Record; //Compatibility
//End Record_ds_BeforeExecuteDelete

//Custom Code @22-2A29BDB7
	$db = new clsDBGayaFusionAll;
	$CollectID = $Record->CollectID->GetValue();
	$Update = "UPDATE tblCollect_Master SET RefID = '' WHERE ID = $CollectID";
	$db->query($Update);
	$db->close();
//End Custom Code

//Close Record_ds_BeforeExecuteDelete @15-720DEEFA
    return $Record_ds_BeforeExecuteDelete;
}
//End Close Record_ds_BeforeExecuteDelete
?>
