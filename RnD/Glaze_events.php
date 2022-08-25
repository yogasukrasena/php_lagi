<?php
//BindEvents Method @1-A1ACEFB6
function BindEvents()
{
    global $GlazeGrid;
    $GlazeGrid->tblglaze_TotalRecords->CCSEvents["BeforeShow"] = "GlazeGrid_tblglaze_TotalRecords_BeforeShow";
}
//End BindEvents Method

//GlazeGrid_tblglaze_TotalRecords_BeforeShow @9-6BE25C9F
function GlazeGrid_tblglaze_TotalRecords_BeforeShow(& $sender)
{
    $GlazeGrid_tblglaze_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GlazeGrid; //Compatibility
//End GlazeGrid_tblglaze_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GlazeGrid_tblglaze_TotalRecords_BeforeShow @9-8B85021E
    return $GlazeGrid_tblglaze_TotalRecords_BeforeShow;
}
//End Close GlazeGrid_tblglaze_TotalRecords_BeforeShow
?>
