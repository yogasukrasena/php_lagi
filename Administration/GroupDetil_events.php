<?php
//BindEvents Method @1-4C068C1F
function BindEvents()
{
    global $GridCollection;
    $GridCollection->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow";
}
//End BindEvents Method

//GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-A8013ABB
function GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow(& $sender)
{
    $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Retrieve number of records @29-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-F5257CAF
    return $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow;
}
//End Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

?>