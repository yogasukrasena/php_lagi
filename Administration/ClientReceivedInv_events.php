<?php
//BindEvents Method @1-23284D05
function BindEvents()
{
    global $Grid;
    $Grid->ar_proforma_pay_proforma1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow";
}
//End BindEvents Method

//Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow @19-CD6C2F25
function Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow

//Retrieve number of records @20-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow @19-100BC37C
    return $Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow;
}
//End Close Grid_ar_proforma_pay_proforma1_TotalRecords_BeforeShow


?>
