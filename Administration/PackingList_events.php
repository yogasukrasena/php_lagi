<?php
//BindEvents Method @1-65765AF2
function BindEvents()
{
    global $Grid;
    $Grid->tbladminist_addressbook_t1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow";
}
//End BindEvents Method

//Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow @24-C6B4284D
function Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow

//Retrieve number of records @25-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow @24-CA8F7CC8
    return $Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow;
}
//End Close Grid_tbladminist_addressbook_t1_TotalRecords_BeforeShow


?>
