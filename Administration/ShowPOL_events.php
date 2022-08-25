<?php
//BindEvents Method @1-BD9371E7
function BindEvents()
{
    global $Grid;
    global $DetailPOL;
    global $Report_Print;
    global $DetailPROF;
    $Grid->CCSEvents["BeforeShow"] = "Grid_BeforeShow";
    $DetailPOL->Navigator->CCSEvents["BeforeShow"] = "DetailPOL_Navigator_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
    $DetailPROF->Navigator->CCSEvents["BeforeShow"] = "DetailPROF_Navigator_BeforeShow";
}
//End BindEvents Method

//Grid_BeforeShow @2-9B71DC32
function Grid_BeforeShow(& $sender)
{
    $Grid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShow

//Custom Code @157-2A29BDB7
global $DBGayaFusionAll;
global $DetailPOL, $DetailPROF;
$Pol_H_ID = $Grid->POL_H_ID->GetValue();
$Proforma_H_ID = CCDLookUp("Proforma_H_ID", "tblAdminist_POL_H","POL_H_ID = ".$DBGayaFusionAll->ToSQL($Pol_H_ID, ccsInteger), $DBGayaFusionAll);
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
  }
  $DetailPOL->Visible = false;
  $DetailPROF->Visible = true;
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
  }
  $DetailPOL->Visible = true;
  $DetailPROF->Visible = false;
}
//End Custom Code

//Close Grid_BeforeShow @2-C392A694
    return $Grid_BeforeShow;
}
//End Close Grid_BeforeShow

//DetailPOL_Navigator_BeforeShow @276-DA2568DD
function DetailPOL_Navigator_BeforeShow(& $sender)
{
    $DetailPOL_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DetailPOL; //Compatibility
//End DetailPOL_Navigator_BeforeShow

//Hide-Show Component @277-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close DetailPOL_Navigator_BeforeShow @276-72812300
    return $DetailPOL_Navigator_BeforeShow;
}
//End Close DetailPOL_Navigator_BeforeShow

//Report_Print_BeforeShow @266-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @268-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @266-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow

//DetailPROF_Navigator_BeforeShow @301-9C137C63
function DetailPROF_Navigator_BeforeShow(& $sender)
{
    $DetailPROF_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DetailPROF; //Compatibility
//End DetailPROF_Navigator_BeforeShow

//Hide-Show Component @302-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close DetailPROF_Navigator_BeforeShow @301-2C924FB2
    return $DetailPROF_Navigator_BeforeShow;
}
//End Close DetailPROF_Navigator_BeforeShow
//DEL

//DEL  

//DEL

//DEL  global $Grid;
//DEL  global $DBGayaFusionAll;
//DEL  //$POL_H_ID = CCGetFromGet("POL_H_ID",0);
//DEL  $POL_D_ID = $Detail->POL_D_ID->GetValue();
//DEL  $POL_H_ID = $Detail->POL_H_ID->GetValue();
//DEL  $Proforma_H_ID = CCDLookUp("Proforma_H_ID","tblAdminist_POL_H","POL_H_ID = ".$DBGayaFusionAll->ToSQL($Pol_H_ID,ccsInteger), $DBGayaFusionAll);
//DEL  $Proforma_D_ID = CCDLookUp("Proforma_D_ID","tblAdminist_Proforma_D","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  
//DEL  if($Proforma_H_ID > 0){
//DEL  
//DEL    $sql = "SELECT Proforma_H_ID,Qty,Photo1, CategoryName, NameDesc, SizeName, TextureName, ColorName, DesignName, MaterialName 
//DEL  FROM (((((((tblcollect_master INNER JOIN tbladminist_proforma_d ON tbladminist_proforma_d.CollectID = tblcollect_master.ID) INNER JOIN tblcollect_category ON
//DEL  tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON
//DEL  tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON
//DEL  tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_material ON
//DEL  tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tblcollect_name ON
//DEL  tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON
//DEL  tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON
//DEL  tblcollect_master.TextureCode = tblcollect_texture.TextureCode
//DEL  WHERE tbladminist_proforma_d.Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger);
//DEL    $DBGayaFusionAll->query($sql);
//DEL    $result = $DBGayaFusionAll->next_record();
//DEL    if($result){
//DEL      $Detail->NameDesc->SetValue($DBGayaFusionAll->f("NameDesc"));
//DEL  	$Detail->CategoryName->SetValue($DBGayaFusionAll->f("CategoryName"));
//DEL  	$Detail->SizeName->SetValue($DBGayaFusionAll->f("SizeName"));
//DEL  	$Detail->TextureName->SetValue($DBGayaFusionAll->f("TextureName"));
//DEL  	$Detail->ColorName->SetValue($DBGayaFusionAll->f("ColorName"));
//DEL  	$Detail->MaterialName->SetValue($DBGayaFusionAll->f("MaterialName"));
//DEL  	$Detail->Qty->SetValue($DBGayaFusionAll->f("Qty"));
//DEL  	$Detail->Photo1->SetValue($DBGayaFusionAll->f("Photo1"));
//DEL  	
//DEL    }
//DEL  $Detail->Label3->SetValue($sql);
//DEL  }else{
//DEL    $sql = "SELECT CategoryName, NameDesc, SizeName, TextureName, ColorName, DesignName, MaterialName, Qty, Photo1, POL_H_ID 
//DEL  FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON
//DEL  tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON
//DEL  tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_material ON
//DEL  tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tblcollect_name ON
//DEL  tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON
//DEL  tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON
//DEL  tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tbladminist_pol_d ON
//DEL  tbladminist_pol_d.CollectID = tblcollect_master.ID WHERE tbladminist_pol_d.POL_D_ID = ".$DBGayaFusionAll->ToSQL($POL_D_ID,ccsInteger);
//DEL  
//DEL    $DBGayaFusionAll->query($sql);
//DEL    //$result = $DBGayaFusionAll->next_record();
//DEL    if($DBGayaFusionAll->next_record()){
//DEL      $Detail->NameDesc->SetValue($DBGayaFusionAll->f("NameDesc"));
//DEL  	$Detail->CategoryName->SetValue($DBGayaFusionAll->f("CategoryName"));
//DEL  	$Detail->SizeName->SetValue($DBGayaFusionAll->f("SizeName"));
//DEL  	$Detail->TextureName->SetValue($DBGayaFusionAll->f("TextureName"));
//DEL  	$Detail->ColorName->SetValue($DBGayaFusionAll->f("ColorName"));
//DEL  	$Detail->MaterialName->SetValue($DBGayaFusionAll->f("MaterialName"));
//DEL  	$Detail->Qty->SetValue($DBGayaFusionAll->f("Qty"));
//DEL  	$Detail->Photo1->SetValue($DBGayaFusionAll->f("Photo1"));
//DEL    }
//DEL  }
//DEL  

//DEL  

?>