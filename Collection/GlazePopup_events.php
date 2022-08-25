<?php
//BindEvents Method @1-0702478C
function BindEvents()
{
    global $GlazeGrid;
    $GlazeGrid->tblglaze_TotalRecords->CCSEvents["BeforeShow"] = "GlazeGrid_tblglaze_TotalRecords_BeforeShow";
    $GlazeGrid->CCSEvents["BeforeShow"] = "GlazeGrid_BeforeShow";
}
//End BindEvents Method

//GlazeGrid_tblglaze_TotalRecords_BeforeShow @7-6BE25C9F
function GlazeGrid_tblglaze_TotalRecords_BeforeShow(& $sender)
{
    $GlazeGrid_tblglaze_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GlazeGrid; //Compatibility
//End GlazeGrid_tblglaze_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GlazeGrid_tblglaze_TotalRecords_BeforeShow @7-8B85021E
    return $GlazeGrid_tblglaze_TotalRecords_BeforeShow;
}
//End Close GlazeGrid_tblglaze_TotalRecords_BeforeShow

//GlazeGrid_BeforeShow @6-34B8EF95
function GlazeGrid_BeforeShow(& $sender)
{
    $GlazeGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GlazeGrid; //Compatibility
//End GlazeGrid_BeforeShow

//Custom Code @30-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);

//End Custom Code

//Close GlazeGrid_BeforeShow @6-4A75D9A8
    return $GlazeGrid_BeforeShow;
}
//End Close GlazeGrid_BeforeShow


?>
