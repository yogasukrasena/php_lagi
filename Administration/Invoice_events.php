<?php
//BindEvents Method @1-FADDF6D5
function BindEvents()
{
    global $InvGrid;
    $InvGrid->tbladminist_client_tbladm1_TotalRecords->CCSEvents["BeforeShow"] = "InvGrid_tbladminist_client_tbladm1_TotalRecords_BeforeShow";
    $InvGrid->CCSEvents["BeforeShowRow"] = "InvGrid_BeforeShowRow";
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

//DEL  

//InvGrid_BeforeShowRow @2-1E3059BD
function InvGrid_BeforeShowRow(& $sender)
{
    $InvGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $InvGrid; //Compatibility
//End InvGrid_BeforeShowRow

//Custom Code @137-2A29BDB7
$db = new clsDBGayaFusionAll();
$Quotation_H_ID = $InvGrid->Quotation_H_ID->GetValue();
$Proforma_H_ID = $InvGrid->Proforma_H_ID->GetValue();
$QuoInPro = CCDLookUp("Quotation_H_ID","tblAdminist_Proforma_H","Proforma_H_ID=".$db->ToSQL($Proforma_H_ID,ccsInteger),$db);
$ProNo = CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID=".$db->ToSQL($Proforma_H_ID,ccsInteger),$db);
$ProRev = CCDLookUp("Rev","tblAdminist_Proforma_H","Proforma_H_ID=".$db->ToSQL($Proforma_H_ID,ccsInteger),$db);

if(!$ProRev == ""){
    $InvGrid->ProformaNo->SetValue($ProNo."-".$ProRev);
}else{
    $InvGrid->ProformaNo->SetValue($ProNo);
}
$InvGrid->ProformaNo->SetLink("ShowProforma.php?Proforma_H_ID=".$Proforma_H_ID);
if(!$QuoInPro == ""){
  $QuoNo  = CCDLookUp("QuotationNo","tblAdminist_Quotation_H","Quotation_H_ID=".$db->ToSQL($QuoInPro,ccsInteger),$db);
  $QuoRev = CCDLookUp("Rev","tblAdminist_Quotation_H","Quotation_H_ID=".$db->ToSQL($QuoInPro,ccsInteger),$db);
  $InvGrid->QuotationNo->SetLink("ShowQuotation.php?Quotation_H_ID=".$QuoInPro);
}else{
  $QuoNo = CCDLookUp("QuotationNo","tblAdminist_Quotation_H","Quotation_H_ID=".$db->ToSQL($Quotation_H_ID,ccsInteger),$db);
  $QuoRev = CCDLookUp("Rev","tblAdminist_Quotation_H","Quotation_H_ID=".$db->ToSQL($Quotation_H_ID,ccsInteger),$db);
  $InvGrid->QuotationNo->SetLink("ShowQuotation.php?Quotation_H_ID=".$Quotation_H_ID);
  
}

if(!$QuoRev == ""){
    $InvGrid->QuotationNo->SetValue($QuoNo."-".$QuoRev);
  }else{
    $InvGrid->QuotationNo->SetValue($QuoNo);
  }
$db->close();
//End Custom Code

//Close InvGrid_BeforeShowRow @2-4511CC96
    return $InvGrid_BeforeShowRow;
}
//End Close InvGrid_BeforeShowRow
//CLEARED
?>