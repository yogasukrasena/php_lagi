<?php
//BindEvents Method @1-9C77A2A2
function BindEvents()
{
    global $tblcasting;
    $tblcasting->tblcasting_TotalRecords->CCSEvents["BeforeShow"] = "tblcasting_tblcasting_TotalRecords_BeforeShow";
    $tblcasting->CCSEvents["BeforeShow"] = "tblcasting_BeforeShow";
}
//End BindEvents Method

//tblcasting_tblcasting_TotalRecords_BeforeShow @7-19B7408C
function tblcasting_tblcasting_TotalRecords_BeforeShow(& $sender)
{
    $tblcasting_tblcasting_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblcasting; //Compatibility
//End tblcasting_tblcasting_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblcasting_tblcasting_TotalRecords_BeforeShow @7-DDDD2636
    return $tblcasting_tblcasting_TotalRecords_BeforeShow;
}
//End Close tblcasting_tblcasting_TotalRecords_BeforeShow

//tblcasting_BeforeShow @6-0577A743
function tblcasting_BeforeShow(& $sender)
{
    $tblcasting_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblcasting; //Compatibility
//End tblcasting_BeforeShow

//Custom Code @29-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);
//End Custom Code

//Close tblcasting_BeforeShow @6-6FAF69F9
    return $tblcasting_BeforeShow;
}
//End Close tblcasting_BeforeShow


?>
