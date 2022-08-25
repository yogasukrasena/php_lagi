<?php
session_start();
//BindEvents Method @1-4771EFC2
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    global $CCSEvents;
    $AddNewHeader->Attn->CCSEvents["BeforeShow"] = "AddNewHeader_Attn_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
    $AddNewDetail->CCSEvents["BeforeShow"] = "AddNewDetail_BeforeShow";
}
//End BindEvents Method

//AddNewHeader_Attn_BeforeShow @13-C0B4F923
function AddNewHeader_Attn_BeforeShow(& $sender)
{
    $AddNewHeader_Attn_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_Attn_BeforeShow

//Close AddNewHeader_Attn_BeforeShow @13-674E9276
    return $AddNewHeader_Attn_BeforeShow;
}
//End Close AddNewHeader_Attn_BeforeShow

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @48-2A29BDB7
// -------------------------
	global $AddNewHeader,$AddNewDetail;
	global $QuotationNo;//3 below to make an increment quo number
	global $AddQuotation;
	global $NoTrans;
	global $ContactID;//this is to get the contact id
	$Prefik = "QUO".date(Ym);
	$NewConnection = new clsDBGayaFusionAll();

   	if(!$AddNewHeader->EditMode){ 
		$dbf = new db_functions("localhost","root","","gayafusionall","","","");
		$AddNewHeader->DocMaker->SetValue($dbf->FieldToid("tblUser",'id',$_SESSION['session_user_id']));

		$AddNewDetail->Visible = false;
		$AddNewHeader->Revis->Visible = false;
		$AddNewHeader->LinkRev->Visible = false;

		$sqlquery = "SELECT * FROM tblAdminist_Quotation_H WHERE QuotationNo LIKE '".$Prefik."%'";
		$jumlah = mysql_num_rows(mysql_query($sqlquery));
		if ($jumlah > 0){
			$sqlquery = "SELECT MAX(QuotationNo) FROM tblAdminist_Quotation_H";
			$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
			$NoTrans = $Prefik.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
		}
		else{
			$NoTrans = $Prefik."01";
		}
		$AddNewHeader->QuotationNo->SetValue($NoTrans);
	}else{//to handle the revision
		
		$AddNewHeader->LinkRev->Visible = true;
		$QuotationHID = CCGetFromGet("Quotation_H_ID",0);
		if($QuotationHID > 0){
		$sqlquery = "SELECT Rev FROM tblAdminist_Qutation_H WHERE Quotation_H_ID = $QuotationHID";
		$NewConnection->query($sqlquery);
		$Result = $NewConnection->next_record();
			if($Result){
				$AddNewHeader->Revis->Visible = true;
			}
		}
		
	}

	//to handle the address-attn
	$ContactID = CCGetFromGet("ContactID",0);
	if($ContactID > 0){
		$AddNewHeader->AddressID->Visible = false;
		$AddNewHeader->Attn->Visible = false;
		$AddNewHeader->lblAddress->Visible = true;
		$AddNewHeader->lblAttn->Visible = true;
		$AddNewHeader->LinkChange->Visible = true;
		$addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$ContactID;
		$NewConnection->query($addquery);
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
		//show the value
		$AddNewHeader->lblAddress->SetValue($company);
		$AddNewHeader->Attn->SetValue($ContactID);
		$AddNewHeader->lblAttn->SetValue($contactname);
		$AddNewHeader->Email->SetValue($email);
		$AddNewHeader->Address->SetValue($address);
		$AddNewHeader->Phone->SetValue($phone);
		$AddNewHeader->Fax->SetValue($fax);
	}
	else{
		$AddNewHeader->AddressID->Visible = true;
		$AddNewHeader->Attn->Visible = true;
		$AddNewHeader->lblAddress->Visible = false;
		$AddNewHeader->lblAttn->Visible = false;
		$AddNewHeader->LinkChange->Visible = false;
	}
//End Custom Code
//Close AddNewHeader_BeforeShow @2-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_AfterInsert @2-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @49-2A29BDB7
// -------------------------
global $DBGayaFusionAll;	
global $Redirect,$FileName;  
$Quotation_H_ID = CCDLookUp("max(Quotation_H_ID)","tblAdminist_Quotation_H","", $DBGayaFusionAll);
$ContactID = CCDLookUp("ContactID","tblAdminist_Quotation_H","Quotation_H_ID = ".$DBGayaFusionAll->ToSQL($Quotation_H_ID,ccsInteger),$DBGayaFusionAll);
$Redirect = $FileName."?Quotation_H_ID=".$Quotation_H_ID."&ContactID=".$ContactID;
  // -------------------------
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewHeader_BeforeDelete @2-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @50-2A29BDB7
$Quotation_H_ID = CCGetFromGet("Quotation_H_ID",0);	
   
if(intval($Quotation_H_ID) >0){
	$NewConnection = new clsDBGayaFusionAll();
    $NewConnection->query("DELETE FROM tblAdminist_Quotation_D WHERE Quotation_H_ID=".$NewConnection->ToSQL($Quotation_H_ID,ccsInteger));
}
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @2-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewDetail_BeforeShowRow @24-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @51-2A29BDB7
	global $AddNewDetail;
	global $RowNumber;
  
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
//End Custom Code

//Close AddNewDetail_BeforeShowRow @24-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @24-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @52-2A29BDB7
	global $AddNewDetail;
	$Quotation_H_ID = intval(CCGetFromGet("Quotation_H_ID",0));
	if($Quotation_H_ID > 0){
		$AddNewDetail->ds->Quotation_H_ID->SetValue($Quotation_H_ID);
  	}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @24-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

//AddNewDetail_BeforeShow @24-41B7439C
function AddNewDetail_BeforeShow(& $sender)
{
    $AddNewDetail_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShow

//Custom Code @136-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close AddNewDetail_BeforeShow @24-C65A1036
    return $AddNewDetail_BeforeShow;
}
//End Close AddNewDetail_BeforeShow

//Page_BeforeInitialize @1-052A9EE2
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ListQuotation; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill2 Initialization @152-149F2A20
    if ('AddNewHeaderAttnPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @152-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @152-22D517C6
        $Service->AddDataSourceField('Email',ccsText,"");
        $Service->AddDataSourceField('Address',ccsText,"");
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccsText,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @152-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @152-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
