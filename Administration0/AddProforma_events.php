<?php
session_start();
//BindEvents Method @1-9BD7EE95
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    global $CCSEvents;
    $AddNewHeader->Attn->CCSEvents["BeforeShow"] = "AddNewHeader_Attn_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->ds->CCSEvents["BeforeBuildInsert"] = "AddNewHeader_ds_BeforeBuildInsert";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["AfterUpdate"] = "AddNewHeader_AfterUpdate";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
}
//End BindEvents Method

//AddNewHeader_Attn_BeforeShow @56-C0B4F923
function AddNewHeader_Attn_BeforeShow(& $sender)
{
    $AddNewHeader_Attn_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_Attn_BeforeShow

//Close AddNewHeader_Attn_BeforeShow @56-674E9276
    return $AddNewHeader_Attn_BeforeShow;
}
//End Close AddNewHeader_Attn_BeforeShow

//AddNewHeader_BeforeDelete @42-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @184-2A29BDB7
$Proforma_H_ID = CCGetFromGet("Proforma_H_ID",0);
if(intval($Proforma_H_ID) >0){
//Create a new database connection object
	$NewConnection = new clsDBGayaFusionAll();
	$NewConnection->query("DELETE FROM tblAdminist_Proforma_D WHERE Proforma_H_ID=".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
	$NewConnection->query("DELETE FROM ar_proforma WHERE Proforma_H_ID = ".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
}
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @42-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterInsert @42-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @185-2A29BDB7
global $DBGayaFusionAll;
global $Redirect,$FileName;

$ClientID = $AddNewHeader->ClientID->GetValue();
$predate = $AddNewHeader->PreviewDPDate->GetValue();
$Proforma_H_ID = CCDLookUp("last_insert_id()","tblAdminist_Proforma_H","",$DBGayaFusionAll);
$Quotation_H_ID = $AddNewHeader->Quotation_H_ID->GetValue();
$AddressID = $AddNewHeader->AddressIDAdd->GetValue();
$ContactID = $AddNewHeader->ContactIDAdd->GetValue();
$AddNewHeader->AddressIDAdd->SetValue($Quotation_H_ID);
$CurrencyID = $AddNewHeader->Currency->GetValue();
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll);

if($Quotation_H_ID > 0) $DBGayaFusionAll->query("UPDATE tblAdminist_Proforma_H SET AddressID = ".$DBGayaFusionAll->ToSQL($AddressID,ccsInteger).",ContactID = ".$DBGayaFusionAll->ToSQL($ContactID, ccsInteger)." WHERE Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger));

$sql = "INSERT INTO ar_proforma (Client_ID, Proforma_H_ID, pre_date,Currency,Rate) VALUES (".$DBGayaFusionAll->ToSQL($ClientID,csInteger).",". $DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger).",". $DBGayaFusionAll->ToSQL($predate,ccsDate).",".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger).",".$DBGayaFusionAll->ToSQL($CurrencyRate,ccsFloat).")";
$DBGayaFusionAll->query($sql);
		
$ContactID = CCDLookUp("ContactID","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
$Redirect = $FileName."?Proforma_H_ID=".$Proforma_H_ID."&ContactID=".$ContactID;//CCDLookUp("max(Proforma_H_ID)","tblAdminist_Proforma_H","", $DBGayaFusionAll);
	
//End Custom Code

//Close AddNewHeader_AfterInsert @42-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewHeader_ds_BeforeBuildInsert @42-D3DAC484
function AddNewHeader_ds_BeforeBuildInsert(& $sender)
{
    $AddNewHeader_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_ds_BeforeBuildInsert

//Custom Code @196-2A29BDB7
$PrevDpDate = $AddNewHeader->PreviewDPDate->GetValue();
$NowDate = $AddNewHeader->ProformaDate->GetValue();
if($PrevDpDate < $NowDate){
	$AddNewHeader->Errors->addError("Preview Deposit Date Can Not Smaller Than Proforma Date");
}
//End Custom Code

//Close AddNewHeader_ds_BeforeBuildInsert @42-27820F79
    return $AddNewHeader_ds_BeforeBuildInsert;
}
//End Close AddNewHeader_ds_BeforeBuildInsert

//AddNewHeader_BeforeShow @42-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @222-2A29BDB7
	//Declare the global
	global $AddNewHeader, $AddNewDetail;
	global $ProformaNo;
	global $AddProforma, $ContactID, $Quotation_H_ID;
	$NewConnection = new clsDBGayaFusionAll;

	//Make prefix variable for prof
	$Prefix = "PRO".date(Ym);

	if(!$AddNewHeader->EditMode){
		$dbf = new db_functions("localhost","root","","gayafusionall","","","");
		$AddNewHeader->DocMaker->SetValue($dbf->FieldToid("tblUser",'id',$_SESSION['session_user_id']));
		$AddNewDetail->Visible= false;
		$AddNewHeader->Revis->Visible = false;
		$AddNewHeader->LinkRev->Visible = false;
		

		$sqlquery = "SELECT Proforma_H_ID FROM tblAdminist_Proforma_H WHERE ProformaNo LIKE '".$Prefix."%'";
		$jumlah = mysql_num_rows(mysql_query($sqlquery));
		if($jumlah > 0){
			$sqlquery = "SELECT MAX(ProformaNo) FROM tblAdminist_Proforma_H";
			$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
			$NoTrans = $Prefix.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
		}else{
			$NoTrans = $Prefix."01";
		}
		$AddNewHeader->ProformaNo->SetValue($NoTrans);

		$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", 0);
		if($Quotation_H_ID > 0){
			$sql = "SELECT Validity,ClientOrderRef,ClientID,AddressID,ContactID,PackagingCost,DeliveryTermID, DeliveryTimeID,PaymentTermID,Currency, SpecialInstruction 
			  FROM tbladminist_quotation_h WHERE Quotation_H_ID = $Quotation_H_ID";
			$NewConnection->query($sql);
			$Result = $NewConnection->next_record();
			if($Result){
				$AddNewHeader->Validity->SetValue($NewConnection->f("Validity"));
				$AddNewHeader->ClientOrderRef->SetValue($NewConnection->f("ClientOrderRef"));
				$AddNewHeader->ClientID->SetValue($NewConnection->f("ClientID"));
				$AddNewHeader->AddressID->SetValue($NewConnection->f("AddressID"));//contact ga dipake dengan asumsi ga tau dikirim ke sapa
				$AddNewHeader->PackagingCost->SetValue($NewConnection->f("PackagingCost"));
				$AddNewHeader->DeliveryTimeID->SetValue($NewConnection->f("DeliveryTimeID"));
				$AddNewHeader->DeliveryTermID->SetValue($NewConnection->f("DeliveryTermID"));
				$AddNewHeader->PaymentTermID->SetValue($NewConnection->f("PaymentTermID"));
				$AddNewHeader->SpecialInstruction->SetValue($NewConnection->f("SpecialInstruction"));
				$AddNewHeader->Currency->SetValue($NewConnection->f("Currency"));
				$AddNewHeader->AddressIDAdd->SetValue($NewConnection->f("AddressID"));
				$AddNewHeader->ContactIDAdd->SetValue($NewConnection->f("ContactID"));
			}
			$AddNewHeader->Quotation_H_ID->SetValue($Quotation_H_ID);
		}
	}

	$ContactID = CCGetFromGet("ContactID",0);
	if($ContactID > 0){
		
		$AddNewHeader->AddressID->Visible= false;
		$AddNewHeader->Attn->Visible = false;
		$AddNewHeader->lblAddress->Visible=true;
		$AddNewHeader->lblAttn->Visible = true;	
		$AddNewHeader->LinkChange->Visible=true;

		$Query = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM ";
		$Query = $Query." tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON ";
		$Query = $Query." tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$ContactID;
		$NewConnection->query($Query);
		$Result = $NewConnection->next_record();
		if($Result){
			$company = $NewConnection->f("Company");
			$contactname = $NewConnection->f("ContactName");
			$email = $NewConnection->f("Email");
			$address = $NewConnection->f("Address");
			$phone = $NewConnection->f("Phone");
			$fax = $NewConnection->f("Fax");
		}
		$NewConnection->close;
		//show the valuez
		$AddNewHeader->lblAddress->SetValue($company);
		$AddNewHeader->lblAttn->SetValue($contactname);
		$AddNewHeader->Email->SetValue($email);
		$AddNewHeader->Phone->SetValue($phone);
		$AddNewHeader->Address->SetValue($address);
		$AddNewHeader->Fax->SetValue($fax);
		$AddNewHeader->Attn->SetValue($ContactID);//don't know this is need/not, but let's just fill it
	}else{
		$AddNewHeader->AddressID->Visible=true;
		$AddNewHeader->Attn->Visible= true;
		$AddNewHeader->lblAddress->Visible= false;
		$AddNewHeader->lblAttn->Visible= false;
		$AddNewHeader->LinkChange->Visible= false;
	}
//End Custom Code
//Close AddNewHeader_BeforeShow @42-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_AfterUpdate @42-D4CE57C7
function AddNewHeader_AfterUpdate(& $sender)
{
    $AddNewHeader_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterUpdate

//Custom Code @287-2A29BDB7
$db = new clsDBGayaFusionAll;
$ClientID = $AddNewHeader->ClientID->GetValue();
$predate = $AddNewHeader->PreviewDPDate->GetValue();
$proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
$CurrencyID = $AddNewHeader->Currency->GetValue();
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$db->ToSQL($CurrencyID,ccsInteger),$db);
$sql = "UPDATE ar_proforma SET Client_ID = ".$db->ToSQL($ClientID,ccsInteger).", pre_date = ".$db->ToSQL($predate,ccsDate).", Currency = ".$db->ToSQL($CurrencyID,ccsInteger).", Rate = ".$db->ToSQL($CurrencyRate,ccsFloat)." WHERE proforma_H_ID = ".$db->ToSQL($proforma_H_ID,ccsInteger);
$db->query($sql);
$db->close();
//End Custom Code

//Close AddNewHeader_AfterUpdate @42-9A0A8CA3
    return $AddNewHeader_AfterUpdate;
}
//End Close AddNewHeader_AfterUpdate

//AddNewDetail_BeforeShowRow @197-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @234-2A29BDB7
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
$query = "SELECT CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName 
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
}
$DB->close();
//End Custom Code

//Close AddNewDetail_BeforeShowRow @197-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @197-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @329-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = intval(CCGetFromGet("Proforma_H_ID",0));
if($Proforma_H_ID > 0){
  $AddNewDetail->ds->Proforma_H_ID->SetValue($Proforma_H_ID);
 }
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @197-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

//Page_BeforeInitialize @1-78E34480
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddProforma; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill2 Initialization @237-149F2A20
    if ('AddNewHeaderAttnPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @237-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @237-5A4F65B1
        $Service->AddDataSourceField('Email',ccsText,"");
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccsText,"");
        $Service->AddDataSourceField('Address',ccsText,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @237-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @237-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize
?>