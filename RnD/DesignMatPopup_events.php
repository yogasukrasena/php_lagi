<?php
//BindEvents Method @1-FEB4065B
function BindEvents()
{
    global $tbldesignmatGrid;
    $tbldesignmatGrid->tbldesignmat_tblsupplier1_TotalRecords->CCSEvents["BeforeShow"] = "tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow";
    $tbldesignmatGrid->CCSEvents["BeforeShow"] = "tbldesignmatGrid_BeforeShow";
}
//End BindEvents Method

//tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow @8-803D91AE
function tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow(& $sender)
{
    $tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmatGrid; //Compatibility
//End tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow @8-BCB9FB66
    return $tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow;
}
//End Close tbldesignmatGrid_tbldesignmat_tblsupplier1_TotalRecords_BeforeShow

//tbldesignmatGrid_BeforeShow @7-BC302D9C
function tbldesignmatGrid_BeforeShow(& $sender)
{
    $tbldesignmatGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbldesignmatGrid; //Compatibility
//End tbldesignmatGrid_BeforeShow

//Custom Code @45-2A29BDB7
	global $Tpl;
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");
	$txtSup = CCGetFromGet("txtSup", "");
	$txtUnit = CCGetFromGet("txtUnit", "");
	$txtUPrice = CCGetFromGet("txtUPrice", "");

	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);
	$Tpl->setvar('txtSup', $txtSup);
	$Tpl->setvar('txtUnit', $txtUnit);
	$Tpl->setvar('txtUPrice', $txtUPrice);

//End Custom Code

//Close tbldesignmatGrid_BeforeShow @7-27A6F0DA
    return $tbldesignmatGrid_BeforeShow;
}
//End Close tbldesignmatGrid_BeforeShow


?>
