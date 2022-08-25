<?php
//BindEvents Method @1-E334B81C
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
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

//Custom Code @85-2A29BDB7
global $AddNewHeader, $AddNewDetail;
global $POLNo;

//Make prefix variable for prof
$Prefix = "POL".date(Ym);

if(!$AddNewHeader->EditMode){
	$AddNewDetail->Visible= false;

	$sqlquery = "SELECT POL_H_ID FROM tblAdminist_POL_H WHERE POLNo LIKE '".$Prefix."%'";
	$jumlah = mysql_num_rows(mysql_query($sqlquery));
	if($jumlah > 0){
		$sqlquery = "SELECT MAX(POLNo) FROM tblAdminist_POL_H";
		$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
		$NoTrans = $Prefix.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
	}else{
		$NoTrans = $Prefix."01";
	}
	$AddNewHeader->PolNo->SetValue($NoTrans);
}
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

//Custom Code @95-2A29BDB7
$POL_H_ID = CCGetFromGet("POL_H_ID",0);
if(intval($POL_H_ID) >0){
//Create a new database connection object
	$NewConnection = new clsDBGayaFusionAll();
	$NewConnection->query("DELETE FROM tblAdminist_POL_D WHERE POL_H_ID=".$NewConnection->ToSQL($POL_H_ID,ccsInteger));
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

//Custom Code @96-2A29BDB7
global $DBGayaFusionAll;
global $Redirect,$FileName;

$POL_H_ID = CCDLookUp("last_insert_id()","tblAdminist_POL_H","",$DBGayaFusionAll);	
$Redirect = $FileName."?POL_H_ID=".$POL_H_ID;//CCDLookUp("max(Proforma_H_ID)","tblAdminist_Proforma_H","", $DBGayaFusionAll);
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewDetail_BeforeShowRow @11-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @49-2A29BDB7
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
$query = "SELECT CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName, CollectCode  
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
	$AddNewDetail->Design->SetValue($DB->f("DesignName"));
	$AddNewDetail->NameDesc->SetValue($DB->f("NameDesc"));
	$AddNewDetail->Category->SetValue($DB->f("CategoryName"));
	$AddNewDetail->Size->SetValue($DB->f("SizeName"));
	$AddNewDetail->Texture->SetValue($DB->f("TextureName"));
	$AddNewDetail->Color->SetValue($DB->f("ColorName"));
	$AddNewDetail->Material->SetValue($DB->f("MaterialName"));
	$AddNewDetail->CollectCode->SetValue($DB->f("CollectCode"));
}
$DB->close();
//End Custom Code

//Close AddNewDetail_BeforeShowRow @11-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @11-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @98-2A29BDB7
  	global $AddNewDetail;
  	$POL_H_ID = intval(CCGetFromGet("POL_H_ID",0));
  	if($POL_H_ID > 0){
  		$AddNewDetail->ds->POL_H_ID->SetValue($POL_H_ID);
   	}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @11-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert
?>