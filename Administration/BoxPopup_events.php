<?php
//BindEvents Method @1-D2C9EDAA
function BindEvents()
{
    global $Grid;
    $Grid->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow";
    $Grid->CCSEvents["BeforeShow"] = "Grid_BeforeShow";
}
//End BindEvents Method

//Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow @13-54F357D9
function Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Retrieve number of records @14-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow @13-FAC3E721
    return $Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow;
}
//End Close Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Grid_BeforeShow @12-9B71DC32
function Grid_BeforeShow(& $sender)
{
    $Grid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShow

//Custom Code @44-2A29BDB7
global $Tpl;
global $Grid;
$rowNumber = CCGetFromGet("rowNumber",0);
if($rowNumber > 0){
	$Tpl->setvar('rowNumber',$rowNumber);
	$Grid->LinkCollectCode->Visible=true;
}
//End Custom Code

//Close Grid_BeforeShow @12-C392A694
    return $Grid_BeforeShow;
}
//End Close Grid_BeforeShow

?>