<?php
//BindEvents Method @1-E1DBAB1E
function BindEvents()
{
    global $tbltools;
    $tbltools->tbltools_TotalRecords->CCSEvents["BeforeShow"] = "tbltools_tbltools_TotalRecords_BeforeShow";
    $tbltools->CCSEvents["BeforeShow"] = "tbltools_BeforeShow";
}
//End BindEvents Method

//tbltools_tbltools_TotalRecords_BeforeShow @7-8B6375D4
function tbltools_tbltools_TotalRecords_BeforeShow(& $sender)
{
    $tbltools_tbltools_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbltools; //Compatibility
//End tbltools_tbltools_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbltools_tbltools_TotalRecords_BeforeShow @7-0271CE48
    return $tbltools_tbltools_TotalRecords_BeforeShow;
}
//End Close tbltools_tbltools_TotalRecords_BeforeShow

//tbltools_BeforeShow @6-DE915AE8
function tbltools_BeforeShow(& $sender)
{
    $tbltools_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbltools; //Compatibility
//End tbltools_BeforeShow

//Custom Code @29-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close tbltools_BeforeShow @6-E9FE534D
    return $tbltools_BeforeShow;
}
//End Close tbltools_BeforeShow


?>
