<?php
//BindEvents Method @1-9DE5D97B
function BindEvents()
{
    global $tbladminist_client;
    $tbladminist_client->tbladminist_client_TotalRecords->CCSEvents["BeforeShow"] = "tbladminist_client_tbladminist_client_TotalRecords_BeforeShow";
}
//End BindEvents Method

//tbladminist_client_tbladminist_client_TotalRecords_BeforeShow @6-527D33EB
function tbladminist_client_tbladminist_client_TotalRecords_BeforeShow(& $sender)
{
    $tbladminist_client_tbladminist_client_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tbladminist_client; //Compatibility
//End tbladminist_client_tbladminist_client_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tbladminist_client_tbladminist_client_TotalRecords_BeforeShow @6-B25D11CA
    return $tbladminist_client_tbladminist_client_TotalRecords_BeforeShow;
}
//End Close tbladminist_client_tbladminist_client_TotalRecords_BeforeShow


?>
