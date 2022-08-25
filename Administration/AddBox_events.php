<?php
//BindEvents Method @1-33B4AE4A
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeInsert"] = "AddNewHeader_BeforeInsert";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
}
//End BindEvents Method

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @46-2A29BDB7
global $AddNewHeader, $AddNewDetail;
global $Tpl;
$Box_H_Id = CCGetFromGet("Box_H_ID","");
if(!$AddNewHeader->EditMode){
 $AddNewDetail->Visible=false;
 $AddNewHeader->PL_H_ID->SetValue(CCGetFromGet("PL_H_ID",""));
}
$rowNumber = CCGetFromGet("rowNumber",0);
$PL_H_ID = CCGetFromGet("PL_H_ID",0);
$InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
$DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
if($rowNumber > 0){
	$Tpl->setvar('rowNumber',$rowNumber);
}
if($PL_H_ID > 0){
  $Tpl->setvar('PL_H_ID',$PL_H_ID);
}
if($InvoiceContactID > 0){
  $Tpl->setvar('InvoiceContactID',$InvoiceContactID);
}
if($DeliveryContactID > 0){
  $Tpl->setvar('DeliveryContactID',$DeliveryContactID);
}
//$Parent = "AddPackList.php?PL_H_ID=".$PL_H_ID."&InvoiceContactID=".$InvoiceContactID."&DeliveryContactID=".$DeliveryContactID;
//$Tpl->setvar('Parent',$Parent);
//End Custom Code

//Close AddNewHeader_BeforeShow @2-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_BeforeDelete @2-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @47-2A29BDB7
$Box_H_ID = CCGetFromGet("Box_H_ID",0);	

if(intval($Box_H_ID) >0){
//Create a new database connection object
  	$NewConnection = new clsDBGayaFusionAll();
   	$NewConnection->query("DELETE FROM tblAdminist_Box_D WHERE Box_H_ID=".$NewConnection->ToSQL($Box_H_ID,ccsInteger));
}
//Close and destroy the database connection object
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @2-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterInsert @2-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @48-2A29BDB7
global $DBGayaFusionAll;	
global $Redirect,$FileName;
$Box_H_ID = CCDLookUp("max(Box_H_ID)","tblAdminist_Box_H","", $DBGayaFusionAll);
$PL_H_ID = $AddNewHeader->PL_H_ID->GetValue();
$rowNumber = CCGetFromGet("rowNumber",0);
$Redirect = $FileName."?Box_H_ID=".$Box_H_ID."&rowNumber=".$rowNumber."&PL_H_ID=".$PL_H_ID;
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewHeader_BeforeInsert @2-D288C5A5
function AddNewHeader_BeforeInsert(& $sender)
{
    $AddNewHeader_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeInsert

//Custom Code @107-2A29BDB7
global $DBGayaFusionAll;
$BoxNumber = $AddNewHeader->BoxNumber->GetValue();
$PL_H_ID = CCGetFromGet("PL_H_ID",0);
$sql = "SELECT BoxNumber FROM tblAdminist_Box_H WHERE BoxNumber = ".$DBGayaFusionAll->ToSQL($BoxNumber,ccsInteger)." AND PL_H_ID = ".$DBGayaFusionAll->ToSQL($PL_H_ID,ccsInteger);
$DBGayaFusionAll->query($sql);
$Result = $DBGayaFusionAll->next_record();
if($Result){
  $AddNewHeader->InsertAllowed= false;
  $AddNewHeader->Errors->addError("Box Number For This Packing List Already Used.");
  return;
}
//End Custom Code

//Close AddNewHeader_BeforeInsert @2-63A2FF10
    return $AddNewHeader_BeforeInsert;
}
//End Close AddNewHeader_BeforeInsert

//DEL  echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
//DEL  echo "SetOpenerValue(document.AddNewHeader.Box_H_ID.value,document.AddNewHeader.BoxNumber.value);return false;\n";
//DEL  echo "</script>";

//AddNewDetail_BeforeShowRow @51-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @72-2A29BDB7
global $AddNewDetail;
global $RowNumber;
global $DBGayaFusionAll;    
    	$RowNumber++;
    	$AddNewDetail->RowIDAttribute->SetValue($RowNumber);
  
    	if( ($RowNumber <= $AddNewDetail->ds->RecordsCount) && ($RowNumber <= $AddNewDetail->PageSize) ){
      	
  		$AddNewDetail->RowNameAttribute->SetValue("FillRow");
  
    	}else{ 
  
  		$AddNewDetail->RowNameAttribute->SetValue("EmptyRow");
      	$AddNewDetail->RowStyleAttribute->SetValue("style='display:none;'");
       	
  		if($AddNewDetail->EditMode){
  
  		    if($AddNewDetail->ErrorMessages[$RowNumber]) $AddNewDetail->RowStyleAttribute->SetValue("");
          }
  	 }

$CollectID = $AddNewDetail->CollectID->GetValue();
$DBGayaFusionAll->query("SELECT DesignCode, NameCode, CategoryCode, SizeCode, TextureCode, ColorCode, MaterialCode FROM tblCollect_Master
	WHERE ID = ".$DBGayaFusionAll->ToSQL($CollectID,ccsInteger));
$Result = $DBGayaFusionAll->next_record();
if($Result){
	$DesignCode = $DBGayaFusionAll->f("DesignCode");
	$NameCode = $DBGayaFusionAll->f("NameCode");
	$CategoryCode = $DBGayaFusionAll->f("CategoryCode");
	$SizeCode = $DBGayaFusionAll->f("SizeCode");
	$TextureCode = $DBGayaFusionAll->f("TextureCode");
	$ColorCode = $DBGayaFusionAll->f("ColorCode");
	$MaterialCode = $DBGayaFusionAll->f("MaterialCode");
}
$DB = new clsDBGayaFusionAll;
$query = "SELECT CollectCode, CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName 
FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON
tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON
tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON
tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON
tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON
tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON
tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON
tblcollect_master.MaterialCode = tblcollect_material.MaterialCode
WHERE tblcollect_color.ColorCode = ".$DB->ToSQL($ColorCode, ccsText)." AND tblcollect_category.CategoryCode = ".$DB->ToSQL($CategoryCode,ccsText).
" AND tblcollect_design.DesignCode = ".$DB->ToSQL($DesignCode,ccsText)." AND tblcollect_material.MaterialCode = ".$DB->ToSQL($MaterialCode,ccsText).
" AND tblcollect_texture.TextureCode = ".$DB->ToSQL($TextureCode,ccsText)." AND tblcollect_size.SizeCode = ".$DB->ToSQL($SizeCode,ccsText).
" AND tblcollect_name.NameCode = ". $DB->ToSQL($NameCode, ccsText)." AND tblcollect_master.ID = ".$DB->ToSQL($CollectID, ccsInteger);
$DB->query($query);
$Result = $DB->next_record();
if($Result){
	$AddNewDetail->CollectCode->SetValue($DB->f("CollectCode"));
	$AddNewDetail->Design->SetValue($DB->f("DesignName"));
	$AddNewDetail->NameDesc->SetValue($DB->f("NameDesc"));
	$AddNewDetail->Category->SetValue($DB->f("CategoryName"));
	$AddNewDetail->Size->SetValue($DB->f("SizeName"));
	$AddNewDetail->Texture->SetValue($DB->f("TextureName"));
	$AddNewDetail->Color->SetValue($DB->f("ColorName"));
	$AddNewDetail->Material->SetValue($DB->f("MaterialName"));
}
$DB->close();
//End Custom Code

//Close AddNewDetail_BeforeShowRow @51-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @51-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @73-2A29BDB7
global $AddNewDetail;
$Box_H_ID = intval(CCGetFromGet("Box_H_ID",0));
if($Box_H_ID > 0){
  $AddNewDetail->ds->Box_H_ID->SetValue($Box_H_ID);
}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @51-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert
?>