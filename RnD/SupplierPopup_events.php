<?php
//BindEvents Method @1-EAE5DA04
function BindEvents()
{
    global $SupplierGrid;
    $SupplierGrid->tblsupplier_TotalRecords->CCSEvents["BeforeShow"] = "SupplierGrid_tblsupplier_TotalRecords_BeforeShow";
    $SupplierGrid->CCSEvents["BeforeShow"] = "SupplierGrid_BeforeShow";
}
//End BindEvents Method

//SupplierGrid_tblsupplier_TotalRecords_BeforeShow @8-ABE34369
function SupplierGrid_tblsupplier_TotalRecords_BeforeShow(& $sender)
{
    $SupplierGrid_tblsupplier_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SupplierGrid; //Compatibility
//End SupplierGrid_tblsupplier_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close SupplierGrid_tblsupplier_TotalRecords_BeforeShow @8-46CF0E64
    return $SupplierGrid_tblsupplier_TotalRecords_BeforeShow;
}
//End Close SupplierGrid_tblsupplier_TotalRecords_BeforeShow

//SupplierGrid_BeforeShow @2-6FC2EE8A
function SupplierGrid_BeforeShow(& $sender)
{
    $SupplierGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SupplierGrid; //Compatibility
//End SupplierGrid_BeforeShow

//Custom Code @23-2A29BDB7
	global $Tpl;
	$doc = CCGetFromGet("doc", "");
	$txtID = CCGetFromGet("txtID", 0);
	$txtdesc = CCGetFromGet("txtdesc", "");

	$Tpl->setvar('doc', $doc);
	$Tpl->setvar('txtID', $txtID);
	$Tpl->setvar('txtdesc', $txtdesc);
//End Custom Code

//Close SupplierGrid_BeforeShow @2-F0B22601
    return $SupplierGrid_BeforeShow;
}
//End Close SupplierGrid_BeforeShow
?>
