<?php
//BindEvents Method @1-CC286751
function BindEvents()
{
    global $tblengobe;
    $tblengobe->tblengobe_TotalRecords->CCSEvents["BeforeShow"] = "tblengobe_tblengobe_TotalRecords_BeforeShow";
    $tblengobe->CCSEvents["BeforeShow"] = "tblengobe_BeforeShow";
}
//End BindEvents Method

//tblengobe_tblengobe_TotalRecords_BeforeShow @7-31192813
function tblengobe_tblengobe_TotalRecords_BeforeShow(& $sender)
{
    $tblengobe_tblengobe_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblengobe; //Compatibility
//End tblengobe_tblengobe_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblengobe_tblengobe_TotalRecords_BeforeShow @7-A5F698FE
    return $tblengobe_tblengobe_TotalRecords_BeforeShow;
}
//End Close tblengobe_tblengobe_TotalRecords_BeforeShow

//tblengobe_BeforeShow @6-67BCD9B4
function tblengobe_BeforeShow(& $sender)
{
    $tblengobe_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblengobe; //Compatibility
//End tblengobe_BeforeShow

//Custom Code @29-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close tblengobe_BeforeShow @6-18C47168
    return $tblengobe_BeforeShow;
}
//End Close tblengobe_BeforeShow


?>
