<?php
//BindEvents Method @1-4E0F69F3
function BindEvents()
{
    global $tblstainoxide;
    $tblstainoxide->tblstainoxide_TotalRecords->CCSEvents["BeforeShow"] = "tblstainoxide_tblstainoxide_TotalRecords_BeforeShow";
    $tblstainoxide->CCSEvents["BeforeShow"] = "tblstainoxide_BeforeShow";
}
//End BindEvents Method

//tblstainoxide_tblstainoxide_TotalRecords_BeforeShow @7-AF00F6C9
function tblstainoxide_tblstainoxide_TotalRecords_BeforeShow(& $sender)
{
    $tblstainoxide_tblstainoxide_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblstainoxide; //Compatibility
//End tblstainoxide_tblstainoxide_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblstainoxide_tblstainoxide_TotalRecords_BeforeShow @7-10C14894
    return $tblstainoxide_tblstainoxide_TotalRecords_BeforeShow;
}
//End Close tblstainoxide_tblstainoxide_TotalRecords_BeforeShow

//tblstainoxide_BeforeShow @6-5FA65E53
function tblstainoxide_BeforeShow(& $sender)
{
    $tblstainoxide_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblstainoxide; //Compatibility
//End tblstainoxide_BeforeShow

//Custom Code @29-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close tblstainoxide_BeforeShow @6-6010CCBA
    return $tblstainoxide_BeforeShow;
}
//End Close tblstainoxide_BeforeShow


?>
