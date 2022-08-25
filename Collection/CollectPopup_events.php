<?php
//BindEvents Method @1-ACE4386E
function BindEvents()
{
    global $GridCollection;
    $GridCollection->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow";
    $GridCollection->CCSEvents["BeforeShow"] = "GridCollection_BeforeShow";
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

//GridCollection_BeforeShow @2-44C2F77F
function GridCollection_BeforeShow(& $sender)
{
    $GridCollection_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_BeforeShow

//Custom Code @174-2A29BDB7
	global $Tpl;
	$rowNumber = CCGetFromGet("rowNumber",0);
	$Tpl->setvar('rowNumber',$rowNumber);
//End Custom Code

//Close GridCollection_BeforeShow @2-BABBC657
    return $GridCollection_BeforeShow;
}
//End Close GridCollection_BeforeShow

//DEL  

//DEL  	
?>
