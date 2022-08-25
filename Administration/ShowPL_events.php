<?php
//BindEvents Method @1-D05F671C
function BindEvents()
{
    global $Header;
    global $Report_Print;
    global $Detil;
    global $lblAdministrasi;
    global $lblCustomer;
    $Header->Company->CCSEvents["BeforeShow"] = "Header_Company_BeforeShow";
    $Header->Company1->CCSEvents["BeforeShow"] = "Header_Company1_BeforeShow";
    $Header->Detail->CCSEvents["BeforeShow"] = "Header_Detail_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
    $Detil->LocalRowNumber->CCSEvents["BeforeShow"] = "Detil_LocalRowNumber_BeforeShow";
    $Detil->ReportLabel2->CCSEvents["BeforeShow"] = "Detil_ReportLabel2_BeforeShow";
    $Detil->ReportLabel3->CCSEvents["BeforeShow"] = "Detil_ReportLabel3_BeforeShow";
    $lblAdministrasi->CCSEvents["BeforeShow"] = "lblAdministrasi_BeforeShow";
    $lblCustomer->CCSEvents["BeforeShow"] = "lblCustomer_BeforeShow";
}
//End BindEvents Method

//Header_Company_BeforeShow @31-31D91942
function Header_Company_BeforeShow(& $sender)
{
    $Header_Company_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Company_BeforeShow

//Custom Code @141-2A29BDB7
$db = new clsDBGayaFusionAll();
$AddressID = $Container->AddressID->GetValue();
$Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($AddressID,ccsInteger),$db));
$db->close();
//End Custom Code

//Close Header_Company_BeforeShow @31-5F926915
    return $Header_Company_BeforeShow;
}
//End Close Header_Company_BeforeShow

//Header_Company1_BeforeShow @126-0A096A4E
function Header_Company1_BeforeShow(& $sender)
{
    $Header_Company1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Company1_BeforeShow

//Custom Code @142-2A29BDB7
$db = new clsDBGayaFusionAll();
$AddressID = $Container->DeliveryAddressID->GetValue();
$Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($AddressID,ccsInteger),$db));
$db->close();
//End Custom Code

//Close Header_Company1_BeforeShow @126-5AD6326A
    return $Header_Company1_BeforeShow;
}
//End Close Header_Company1_BeforeShow

//Header_Detail_BeforeShow @23-3888F587
function Header_Detail_BeforeShow(& $sender)
{
    $Header_Detail_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Detail_BeforeShow

//Custom Code @129-2A29BDB7
global $DBGayaFusionAll;
$InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
$DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
if($InvoiceContactID > 0){
  $addquery = "SELECT * FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$InvoiceContactID;
  $DBGayaFusionAll->query($addquery);
  $Result = $DBGayaFusionAll->next_record();
  if($Result){
  	$contactname = $DBGayaFusionAll->f("ContactName");
  	$address = $DBGayaFusionAll->f("Address");
  	$phone = $DBGayaFusionAll->f("Phone");
  	$fax = $DBGayaFusionAll->f("Fax");
  }
  $Header->Attn1->SetValue($contactname);
  $Header->Address1->SetValue($address);
  $Header->Phone1->SetValue($phone);
  $Header->Fax1->SetValue($fax);
}
  
if($DeliveryContactID > 0){
  $addquery = "SELECT * FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$DeliveryContactID;
  $DBGayaFusionAll->query($addquery);
  $Result = $DBGayaFusionAll->next_record();
  if($Result){
    $contactname = $DBGayaFusionAll->f("ContactName");
    $address = $DBGayaFusionAll->f("Address");
    $phone = $DBGayaFusionAll->f("Phone");
    $fax = $DBGayaFusionAll->f("Fax");
  }
  $Header->Attn2->SetValue($contactname);
  $Header->Address2->SetValue($address);
  $Header->Phone2->SetValue($phone);
  $Header->Fax2->SetValue($fax);
}
//End Custom Code

//Close Header_Detail_BeforeShow @23-B4E4B355
    return $Header_Detail_BeforeShow;
}
//End Close Header_Detail_BeforeShow


//Report_Print_BeforeShow @18-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @20-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @18-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow

//Detil_LocalRowNumber_BeforeShow @131-CA11DE87
function Detil_LocalRowNumber_BeforeShow(& $sender)
{
    $Detil_LocalRowNumber_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_LocalRowNumber_BeforeShow

//Custom Code @132-2A29BDB7
$Container->LocalRowNumber->SetValue($Container->RowNumber);
//End Custom Code

//Close Detil_LocalRowNumber_BeforeShow @131-68D6D28D
    return $Detil_LocalRowNumber_BeforeShow;
}
//End Close Detil_LocalRowNumber_BeforeShow

//Detil_ReportLabel2_BeforeShow @133-78646F72
function Detil_ReportLabel2_BeforeShow(& $sender)
{
    $Detil_ReportLabel2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_ReportLabel2_BeforeShow

//Custom Code @136-2A29BDB7
$PL_H_ID = CCGetFromGet("PL_H_ID","");
$sql = "SELECT BoxNumber FROM tblAdminist_Box_H WHERE PL_H_ID = ".$PL_H_ID;
$result = mysql_query($sql);
$jumlah = mysql_num_rows($result);
$Component->SetValue($jumlah." of Boxes");
//End Custom Code

//Close Detil_ReportLabel2_BeforeShow @133-DC3E9740
    return $Detil_ReportLabel2_BeforeShow;
}
//End Close Detil_ReportLabel2_BeforeShow

//Detil_ReportLabel3_BeforeShow @137-AE8607F4
function Detil_ReportLabel3_BeforeShow(& $sender)
{
    $Detil_ReportLabel3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_ReportLabel3_BeforeShow

//Custom Code @138-2A29BDB7
$PL_H_ID = CCGetFromGet("PL_H_ID","");
$db = new clsDBGayaFusionAll();
$sql = "SELECT * FROM tblAdminist_Box_H WHERE PL_H_ID = ".$PL_H_ID." GROUP BY PL_H_ID";
$db->query($sql);
$result = $db->next_record();
if ($result){
  $Pjg = $db->f("Length");
  $Lbr = $db->f("Width");
  $tg = $db->f("Height");
}
$db->close();
$db2 = new clsDBGayaFusionAll();
$sql= "SELECT SentBy FROM tblAdminist_Packinglist_H WHERE PL_H_ID = ".$PL_H_ID;
$db2->query($sql);
$result = $db->next_record();
if ($result){
  $SentBy = $db2->f("SentBy");
}
$db2->close();
if ($SentBy == "A"){
  $cbm = (($Pjg * $Lbr * $tg) / 6000) ;
}else{
  $cbm = (($Pjg * $Lbr * $tg) / 1000000) ;
}
$Component->SetValue("CBM = ".$cbm);
//End Custom Code

//Close Detil_ReportLabel3_BeforeShow @137-41317636
    return $Detil_ReportLabel3_BeforeShow;
}
//End Close Detil_ReportLabel3_BeforeShow

//lblAdministrasi_BeforeShow @65-52E7D33D
function lblAdministrasi_BeforeShow(& $sender)
{
    $lblAdministrasi_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblAdministrasi; //Compatibility
//End lblAdministrasi_BeforeShow

//Custom Code @89-2A29BDB7
global $Header;
$db = new clsDBGayaFusionAll();
$Invoice_H_ID = $Header->Invoice_H_ID->GetValue();
$DocMaker = CCDLookUp("DocMaker","tblAdminist_Invoice_H","Invoice_H_ID = ".$db->ToSQL($Invoice_H_ID,ccsInteger),$db);
$Component->SetValue(CCDLookUp("Firstname","tblUser","id = ".$db->ToSQL($DocMaker,ccsInteger),$db));
$db->close();
//End Custom Code

//Close lblAdministrasi_BeforeShow @65-E5CCD1BF
    return $lblAdministrasi_BeforeShow;
}
//End Close lblAdministrasi_BeforeShow

//lblCustomer_BeforeShow @145-9F1B654F
function lblCustomer_BeforeShow(& $sender)
{
    $lblCustomer_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblCustomer; //Compatibility
//End lblCustomer_BeforeShow

//Custom Code @146-2A29BDB7
global $Header;
$db = new clsDBGayaFusionAll();
$AddressID = $Header->AddressID->GetValue();
//$DocMaker = CCDLookUp("DocMaker","tblAdminist_Invoice_H","Invoice_H_ID = ".$db->ToSQL($Invoice_H_ID,ccsInteger),$db);
$Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($AddressID,ccsInteger),$db));
$db->close();
//End Custom Code

//Close lblCustomer_BeforeShow @145-7C7DE75F
    return $lblCustomer_BeforeShow;
}
//End Close lblCustomer_BeforeShow

?>