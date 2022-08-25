<?php
//BindEvents Method @1-10B72511
function BindEvents()
{
    global $tblunit;
    $tblunit->tblunit_TotalRecords->CCSEvents["BeforeShow"] = "tblunit_tblunit_TotalRecords_BeforeShow";
}
//End BindEvents Method

//tblunit_tblunit_TotalRecords_BeforeShow @7-C7881A5F
function tblunit_tblunit_TotalRecords_BeforeShow(& $sender)
{
    $tblunit_tblunit_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblunit; //Compatibility
//End tblunit_tblunit_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblunit_tblunit_TotalRecords_BeforeShow @7-F53A0580
    return $tblunit_tblunit_TotalRecords_BeforeShow;
}
//End Close tblunit_tblunit_TotalRecords_BeforeShow


?>
