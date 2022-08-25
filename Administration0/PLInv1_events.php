<?php
//BindEvents Method @1-B4801B79
function BindEvents()
{
    global $InvGrid;
    $InvGrid->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
}
//End BindEvents Method

//InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow @21-6B5A49F3
function InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow(& $sender)
{
    $InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $InvGrid; //Compatibility
//End InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Retrieve number of records @22-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow @21-0D46C429
    return $InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow;
}
//End Close InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow
//CLEARED
?>