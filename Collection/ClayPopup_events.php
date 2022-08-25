<?php
//BindEvents Method @1-6E0173A8
function BindEvents()
{
    global $tblclay;
    $tblclay->tblclay_TotalRecords->CCSEvents["BeforeShow"] = "tblclay_tblclay_TotalRecords_BeforeShow";
}
//End BindEvents Method

//tblclay_tblclay_TotalRecords_BeforeShow @7-9EEFF262
function tblclay_tblclay_TotalRecords_BeforeShow(& $sender)
{
    $tblclay_tblclay_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tblclay; //Compatibility
//End tblclay_tblclay_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tblclay_tblclay_TotalRecords_BeforeShow @7-03690001
    return $tblclay_tblclay_TotalRecords_BeforeShow;
}
//End Close tblclay_tblclay_TotalRecords_BeforeShow


?>
