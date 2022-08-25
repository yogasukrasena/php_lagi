<?php
//BindEvents Method @1-7620930B
function BindEvents()
{
    global $GridList;
    $GridList->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
    $GridList->CCSEvents["BeforeShowRow"] = "GridList_BeforeShowRow";
}
//End BindEvents Method

//GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-5A3CBE8C
function GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow(& $sender)
{
    $GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridList; //Compatibility
//End GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow @12-C50BC8CA
    return $GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow;
}
//End Close GridList_tbladminist_client_tbladm1_TotalRecords_BeforeShow

//GridList_BeforeShowRow @2-97EA3250
function GridList_BeforeShowRow(& $sender)
{
    $GridList_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridList; //Compatibility
//End GridList_BeforeShowRow

//Custom Code @62-2A29BDB7
$AddressID = $GridList->AddressID->GetValue();
$ContactID = $GridList->ContactID->GetValue();
$ClientID = $GridList->ClientID->GetValue();
$Quo_H_ID = $GridList->Quotation_H_ID->GetValue();
$doc = CCGetFromGet("doc","");
if($doc == "i"){
  $GridList->Quotation_H_ID->SetLink("AddInvoice1.php?Quotation_H_ID=$Quo_H_ID&AddressID=$AddressID&ContactID=$ContactID&ClientID=$ClientID");
}elseif($doc == "p"){
  $GridList->Quotation_H_ID->SetLink("AddProforma.php?Quotation_H_ID=$Quo_H_ID&AddressID=$AddressID&ContactID=$ContactID&ClientID=$ClientID");
}
//End Custom Code

//Close GridList_BeforeShowRow @2-6961D946
    return $GridList_BeforeShowRow;
}
//End Close GridList_BeforeShowRow
?>