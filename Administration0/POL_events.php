<?php
//BindEvents Method @1-7B6E8E83
function BindEvents()
{
    global $Grid;
    $Grid->tbladminist_pol_h_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tbladminist_pol_h_TotalRecords_BeforeShow";
    $Grid->CCSEvents["BeforeShowRow"] = "Grid_BeforeShowRow";
}
//End BindEvents Method

//Grid_tbladminist_pol_h_TotalRecords_BeforeShow @6-D3D9AFB2
function Grid_tbladminist_pol_h_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tbladminist_pol_h_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tbladminist_pol_h_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tbladminist_pol_h_TotalRecords_BeforeShow @6-4446286F
    return $Grid_tbladminist_pol_h_TotalRecords_BeforeShow;
}
//End Close Grid_tbladminist_pol_h_TotalRecords_BeforeShow

//Grid_BeforeShowRow @2-AC5B58BC
function Grid_BeforeShowRow(& $sender)
{
    $Grid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShowRow

//Custom Code @25-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = $Grid->Proforma_H_ID->GetValue();
$Pol_H_ID = $Grid->POL_H_ID->GetValue();

if($Proforma_H_ID > 0){
  $sql = "SELECT tbladminist_deliverytime.DeliveryTime AS DeliveryTime,tbladminist_client.ClientCompany AS ClientCompany,tbladminist_proforma_h.Proforma_H_ID,
  tbladminist_proforma_h.ProformaNo AS ProformaNo,tbladminist_proforma_h.Rev,tbladminist_proforma_h.ClientOrderRef, tblAdminist_Proforma_h.ClientID AS ClientID 
  FROM tbladminist_proforma_h INNER JOIN tbladminist_client ON (tbladminist_proforma_h.ClientID=tbladminist_client.ClientID)
  INNER JOIN tbladminist_deliverytime ON (tbladminist_proforma_h.DeliveryTimeID=tbladminist_deliverytime.DeliveryTimeID) WHERE Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger);
  $DBGayaFusionAll->query($sql);
  $result = $DBGayaFusionAll->next_record();
  if($result){
    $ProDate = $DBGayaFusionAll->f("ProformaDate");
    $Grid->ProformaNo->SetValue($DBGayaFusionAll->f("ProformaNo"));
	$Grid->ProformaNo->SetLink("ShowProforma.php?Proforma_H_ID=".$Proforma_H_ID);
	$Grid->ProformaRef->SetValue($DBGayaFusionAll->f("Rev"));
	$Grid->ClientCompany->SetValue($DBGayaFusionAll->f("ClientCompany"));
	$Grid->DeliveryTime->SetValue($DBGayaFusionAll->f("DeliveryTime"));
	$Grid->ClientOrderRef->SetValue($DBGayaFusionAll->f("ClientOrderRef"));
	$Grid->POL_H_ID->SetLink("AddProforma.php?Proforma_H_ID=".$Proforma_H_ID."&ContactID=".$DBGayaFusionAll->f("ClientID"));
	$Grid->POLNo->SetLink("ShowPOL.php?POL_H_ID=".$Pol_H_ID."&Proforma_H_ID=".$Proforma_H_ID);
  }
}else{
  $sql = "SELECT tbladminist_deliverytime.DeliveryTime AS DeliveryTime,tbladminist_client.ClientCompany AS ClientCompany,tbladminist_pol_h.Pol_H_ID,
  tbladminist_pol_h.PolNo AS PolNo,tbladminist_pol_h.ClientOrderRef
  FROM tbladminist_pol_h INNER JOIN tbladminist_client ON (tbladminist_pol_h.ClientID=tbladminist_client.ClientID)
  INNER JOIN tbladminist_deliverytime ON (tbladminist_pol_h.DeliveryTimeID=tbladminist_deliverytime.DeliveryTimeID) WHERE Pol_H_ID = ".$DBGayaFusionAll->ToSQL($Pol_H_ID,ccsInteger);
  $DBGayaFusionAll->query($sql);
  $result = $DBGayaFusionAll->next_record();
  if($result){
    $Grid->ProformaNo->SetValue("");
	$Grid->ProformaRef->SetValue("-");
	$Grid->ClientCompany->SetValue($DBGayaFusionAll->f("ClientCompany"));
	$Grid->DeliveryTime->SetValue($DBGayaFusionAll->f("DeliveryTime"));
	$Grid->ClientOrderRef->SetValue($DBGayaFusionAll->f("ClientOrderRef"));
	$Grid->POL_H_ID->SetLink("AddPol.php?POL_H_ID=".$Pol_H_ID);
	$Grid->POLNo->SetLink("ShowPOL.php?POL_H_ID=".$Pol_H_ID);
  }
}
//End Custom Code

//Close Grid_BeforeShowRow @2-CE8D36BE
    return $Grid_BeforeShowRow;
}
//End Close Grid_BeforeShowRow

?>