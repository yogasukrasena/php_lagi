<?php
//BindEvents Method @1-751C1DE5
function BindEvents()
{
    global $sampleceramic;
    $sampleceramic->sampleceramic_TotalRecords->CCSEvents["BeforeShow"] = "sampleceramic_sampleceramic_TotalRecords_BeforeShow";
    $sampleceramic->CCSEvents["BeforeShow"] = "sampleceramic_BeforeShow";
}
//End BindEvents Method

//sampleceramic_sampleceramic_TotalRecords_BeforeShow @7-ACEDE9E0
function sampleceramic_sampleceramic_TotalRecords_BeforeShow(& $sender)
{
    $sampleceramic_sampleceramic_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramic; //Compatibility
//End sampleceramic_sampleceramic_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close sampleceramic_sampleceramic_TotalRecords_BeforeShow @7-B3875C5F
    return $sampleceramic_sampleceramic_TotalRecords_BeforeShow;
}
//End Close sampleceramic_sampleceramic_TotalRecords_BeforeShow

//sampleceramic_BeforeShow @2-2C128972
function sampleceramic_BeforeShow(& $sender)
{
    $sampleceramic_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramic; //Compatibility
//End sampleceramic_BeforeShow

//Custom Code @28-2A29BDB7
	global $Tpl;
	
	$RowNumber = CCGetFromGet("rowNumber",0);
	$Tpl->setvar('rowNumber',$RowNumber);
//End Custom Code

//Close sampleceramic_BeforeShow @2-FE43F553
    return $sampleceramic_BeforeShow;
}
//End Close sampleceramic_BeforeShow

?>
