<?php
//BindEvents Method @1-895E5FDD
function BindEvents()
{
    global $Grid;
    $Grid->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow";
    $Grid->Reference->CCSEvents["BeforeShow"] = "Grid_Reference_BeforeShow";
    $Grid->RealSellingPrice->CCSEvents["BeforeShow"] = "Grid_RealSellingPrice_BeforeShow";
    $Grid->CCSEvents["BeforeShow"] = "Grid_BeforeShow";
}
//End BindEvents Method

//Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow @50-54F357D9
function Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow(& $sender)
{
    $Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Retrieve number of records @51-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow @50-FAC3E721
    return $Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow;
}
//End Close Grid_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Grid_Reference_BeforeShow @181-757FAC5B
function Grid_Reference_BeforeShow(& $sender)
{
    $Grid_Reference_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_Reference_BeforeShow

//Custom Code @182-2A29BDB7
$db = new clsDBGayaFusionAll();
$CollectID = $Container->CollectID->GetValue();
$sql = "SELECT SID FROM tblReference WHERE CollectID = ".$db->ToSQL($CollectID,ccsInteger);
$db->query($sql);
$result = $db->next_record();
if ($result){
  $SID = $db->f("SID");
  $sql = "SELECT SampleCode FROM SampleCeramic WHERE SID = ".$db->ToSQL($SID,ccsInteger);
  $bd = new clsDBGayaFusionAll();
  $bd->query($sql);
  $hasil = $bd->next_record();
  if ($hasil){
    $Component->SetValue(" - ".$bd->f("SampleCode"));
  }
  $bd->close();
}else{
    $Component->SetValue(" - ");
}
$db->close();
//End Custom Code

//Close Grid_Reference_BeforeShow @181-23815381
    return $Grid_Reference_BeforeShow;
}
//End Close Grid_Reference_BeforeShow

//Grid_RealSellingPrice_BeforeShow @183-9D9F022A
function Grid_RealSellingPrice_BeforeShow(& $sender)
{
    $Grid_RealSellingPrice_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_RealSellingPrice_BeforeShow

//Custom Code @186-2A29BDB7
global $Tpl;
$rowNumber = CCGetFromGet("rowNumber","");
$ID = $Grid->CollectID->GetValue();
$DesignCode = CCGetFromGet("s_DesignName");
$NameCode = CCGetFromGet("s_NameDesc");
$CategoryCode = CCGetFromGet("s_CategoryName");
$SizeCode = CCGetFromGet("s_SizeName");
$TextureCode = CCGetFromGet("s_TextureName");
$ColorCode = CCGetFromGet("s_ColorName");
$MaterialCode = CCGetFromGet("s_MaterialName");
$CollectCode = CCGetFromGet("s_CollectCode");
if ($rowNumber == ""){
  $Grid->RealSellingPrice->SetLink("editprice.php?ID=".$ID."&s_DesignName=".$DesignCode."&s_NameDesc=".$NameCode."&s_CategoryName=".$CategoryCode."&s_SizeName=".$SizeCode."&s_TextureName=".$TextureCode."&s_ColorName=".$ColorCode."&s_MaterialName=".$MaterialCode."&s_CollectCode=".$CollectCode);
}
//End Custom Code

//Close Grid_RealSellingPrice_BeforeShow @183-C0824138
    return $Grid_RealSellingPrice_BeforeShow;
}
//End Close Grid_RealSellingPrice_BeforeShow

//Grid_BeforeShow @2-9B71DC32
function Grid_BeforeShow(& $sender)
{
    $Grid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShow

//Custom Code @170-2A29BDB7
global $Tpl;
global $Grid;
$rowNumber = CCGetFromGet("rowNumber",0);
if($rowNumber > 0){
	$Tpl->setvar('rowNumber',$rowNumber);
	$Grid->PriceDollar->Visible=true;
	$Grid->PriceEuro->Visible = true;
	$Grid->lblPriceDollar->Visible=false;
	$Grid->lblPriceEuro->Visible = false;
}else{
	$Grid->PriceDollar->Visible=false;
	$Grid->PriceEuro->Visible = false;
	$Grid->lblPriceDollar->Visible=true;
	$Grid->lblPriceEuro->Visible = true;
}
//End Custom Code
//Close Grid_BeforeShow @2-C392A694
    return $Grid_BeforeShow;
}
//End Close Grid_BeforeShow
?>