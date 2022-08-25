<?php
//BindEvents Method @1-98423B9C
function BindEvents()
{
    global $tblestruder;
    $tblestruder->tblestruder_TotalRecords->CCSEvents["BeforeShow"] = "tblestruder_tblestruder_TotalRecords_BeforeShow";
    $tblestruder->CCSEvents["BeforeShow"] = "tblestruder_BeforeShow";
}
//End BindEvents Method

//tblestruder_tblestruder_TotalRecords_BeforeShow @7-4C564F3E
function tblestruder_tblestruder_TotalRecords_BeforeShow(& $sender)
{
    $tblestruder_tblestruder_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblestruder; //Compatibility
//End tblestruder_tblestruder_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblestruder_tblestruder_TotalRecords_BeforeShow @7-AD6B5833
    return $tblestruder_tblestruder_TotalRecords_BeforeShow;
}
//End Close tblestruder_tblestruder_TotalRecords_BeforeShow

//tblestruder_BeforeShow @6-A994488B
function tblestruder_BeforeShow(& $sender)
{
    $tblestruder_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblestruder; //Compatibility
//End tblestruder_BeforeShow

//Custom Code @31-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close tblestruder_BeforeShow @6-88896623
    return $tblestruder_BeforeShow;
}
//End Close tblestruder_BeforeShow


?>
