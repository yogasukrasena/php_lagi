<?php
//BindEvents Method @1-B724428E
function BindEvents()
{
    global $UnitGrid;
    $UnitGrid->tblunit_TotalRecords->CCSEvents["BeforeShow"] = "UnitGrid_tblunit_TotalRecords_BeforeShow";
}
//End BindEvents Method

//UnitGrid_tblunit_TotalRecords_BeforeShow @8-AC026A72
function UnitGrid_tblunit_TotalRecords_BeforeShow(& $sender)
{
    $UnitGrid_tblunit_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $UnitGrid; //Compatibility
//End UnitGrid_tblunit_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close UnitGrid_tblunit_TotalRecords_BeforeShow @8-AC209B34
    return $UnitGrid_tblunit_TotalRecords_BeforeShow;
}
//End Close UnitGrid_tblunit_TotalRecords_BeforeShow
?>
