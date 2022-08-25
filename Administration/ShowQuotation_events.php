<?php
//BindEvents Method @1-F4BE7211
function BindEvents()
{
    global $Header;
    global $Detil;
    global $Report_Print;
    global $lblAdministrasi;
    global $lblCustomer;
    $Header->Client->CCSEvents["BeforeShow"] = "Header_Client_BeforeShow";
    $Header->Address->CCSEvents["BeforeShow"] = "Header_Address_BeforeShow";
    $Header->QuotationContact->CCSEvents["BeforeShow"] = "Header_QuotationContact_BeforeShow";
    $Header->DeliveryContact->CCSEvents["BeforeShow"] = "Header_DeliveryContact_BeforeShow";
    $Header->DeliveryTem->CCSEvents["BeforeShow"] = "Header_DeliveryTem_BeforeShow";
    $Header->DeliveryTime->CCSEvents["BeforeShow"] = "Header_DeliveryTime_BeforeShow";
    $Header->PaymentTerm->CCSEvents["BeforeShow"] = "Header_PaymentTerm_BeforeShow";
    $Header->DeliveryAddr->CCSEvents["BeforeShow"] = "Header_DeliveryAddr_BeforeShow";
    $Detil->LocalRowNumber->CCSEvents["BeforeShow"] = "Detil_LocalRowNumber_BeforeShow";
    $Detil->Photo1->CCSEvents["BeforeShow"] = "Detil_Photo1_BeforeShow";
    $Detil->Navigator->CCSEvents["BeforeShow"] = "Detil_Navigator_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
    $lblAdministrasi->CCSEvents["BeforeShow"] = "lblAdministrasi_BeforeShow";
    $lblCustomer->CCSEvents["BeforeShow"] = "lblCustomer_BeforeShow";
}
//End BindEvents Method

//Header_Client_BeforeShow @67-E9F9A0AD
function Header_Client_BeforeShow(& $sender)
{
    $Header_Client_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Client_BeforeShow

//Custom Code @68-2A29BDB7
$ID = $Container->ClientID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_Client_BeforeShow @67-19ED7B5B
    return $Header_Client_BeforeShow;
}
//End Close Header_Client_BeforeShow

//Header_Address_BeforeShow @69-53FB48DF
function Header_Address_BeforeShow(& $sender)
{
    $Header_Address_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Address_BeforeShow

//Custom Code @70-2A29BDB7
$ID = $Container->AddressID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_Address_BeforeShow @69-ADFE77C0
    return $Header_Address_BeforeShow;
}
//End Close Header_Address_BeforeShow

//Header_QuotationContact_BeforeShow @71-6023E43E
function Header_QuotationContact_BeforeShow(& $sender)
{
    $Header_QuotationContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_QuotationContact_BeforeShow

//Custom Code @72-2A29BDB7
$ID = $Container->QuotationContactID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $sql = "SELECT ContactName,Address,Email,Phone,Fax FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$db->ToSQL($ID,ccsInteger);
  $db->query($sql);
  $result = $db->next_record();
  if ($result){
    $Component->SetValue($db->f("ContactName"));
    $Container->QuotationEmail->SetValue($db->f("Email"));
    $Container->QuotationAddress->SetValue($db->f("Address"));
    $Container->QuotationPhone->SetValue($db->f("Phone"));
    $Container->QuotationFax->SetValue($db->f("Fax"));
  }
  $db->close();
}
//End Custom Code

//Close Header_QuotationContact_BeforeShow @71-89FB67BE
    return $Header_QuotationContact_BeforeShow;
}
//End Close Header_QuotationContact_BeforeShow

//Header_DeliveryContact_BeforeShow @77-A51F3614
function Header_DeliveryContact_BeforeShow(& $sender)
{
    $Header_DeliveryContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryContact_BeforeShow

//Custom Code @82-2A29BDB7
$ID = $Container->DeliveryContactID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $sql = "SELECT ContactName,Address,Email,Phone,Fax FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$db->ToSQL($ID,ccsInteger);
  $db->query($sql);
  $result = $db->next_record();
  if ($result){
    $Component->SetValue($db->f("ContactName"));
    $Container->DeliveryEmail->SetValue($db->f("Email"));
    $Container->DeliveryAddress->SetValue($db->f("Address"));
    $Container->DeliveryPhone->SetValue($db->f("Phone"));
    $Container->DeliveryFax->SetValue($db->f("Fax"));
  }
  $db->close();
}
//End Custom Code

//Close Header_DeliveryContact_BeforeShow @77-498A62AE
    return $Header_DeliveryContact_BeforeShow;
}
//End Close Header_DeliveryContact_BeforeShow

//Header_DeliveryTem_BeforeShow @83-0E24CFEC
function Header_DeliveryTem_BeforeShow(& $sender)
{
    $Header_DeliveryTem_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryTem_BeforeShow

//Custom Code @86-2A29BDB7
$ID = $Container->DeliveryTermID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("DeliveryTerm","tblAdminist_DeliveryTerm","DeliveryTermID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryTem_BeforeShow @83-2400C371
    return $Header_DeliveryTem_BeforeShow;
}
//End Close Header_DeliveryTem_BeforeShow

//Header_DeliveryTime_BeforeShow @84-0328E101
function Header_DeliveryTime_BeforeShow(& $sender)
{
    $Header_DeliveryTime_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryTime_BeforeShow

//Custom Code @87-2A29BDB7
$ID = $Container->DeliveryTimeID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("DeliveryTime","tblAdminist_DeliveryTime","DeliveryTimeID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryTime_BeforeShow @84-89F792CF
    return $Header_DeliveryTime_BeforeShow;
}
//End Close Header_DeliveryTime_BeforeShow

//Header_PaymentTerm_BeforeShow @85-94971505
function Header_PaymentTerm_BeforeShow(& $sender)
{
    $Header_PaymentTerm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_PaymentTerm_BeforeShow

//Custom Code @88-2A29BDB7
$ID = $Container->PaymentTermID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("PaymentTerm","tblAdminist_PaymentTerm","PaymentTermID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_PaymentTerm_BeforeShow @85-955C2E33
    return $Header_PaymentTerm_BeforeShow;
}
//End Close Header_PaymentTerm_BeforeShow

//Header_DeliveryAddr_BeforeShow @92-8735EC6B
function Header_DeliveryAddr_BeforeShow(& $sender)
{
    $Header_DeliveryAddr_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryAddr_BeforeShow

//Custom Code @93-2A29BDB7
$ID = $Container->DeliveryAddressID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryAddr_BeforeShow @92-164F24A4
    return $Header_DeliveryAddr_BeforeShow;
}
//End Close Header_DeliveryAddr_BeforeShow

//Detil_LocalRowNumber_BeforeShow @62-CA11DE87
function Detil_LocalRowNumber_BeforeShow(& $sender)
{
    $Detil_LocalRowNumber_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_LocalRowNumber_BeforeShow

//Custom Code @63-2A29BDB7
$Container->LocalRowNumber->SetValue($Container->RowNumber);
//End Custom Code

//Close Detil_LocalRowNumber_BeforeShow @62-68D6D28D
    return $Detil_LocalRowNumber_BeforeShow;
}
//End Close Detil_LocalRowNumber_BeforeShow

//Detil_Photo1_BeforeShow @64-8224FCB1
function Detil_Photo1_BeforeShow(& $sender)
{
    $Detil_Photo1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_Photo1_BeforeShow

//Custom Code @94-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Detil_Photo1_BeforeShow @64-4D5D71A2
    return $Detil_Photo1_BeforeShow;
}
//End Close Detil_Photo1_BeforeShow

//Detil_Navigator_BeforeShow @47-7E0AB1A9
function Detil_Navigator_BeforeShow(& $sender)
{
    $Detil_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_Navigator_BeforeShow

//Hide-Show Component @48-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Detil_Navigator_BeforeShow @47-348B5BAB
    return $Detil_Navigator_BeforeShow;
}
//End Close Detil_Navigator_BeforeShow


//Report_Print_BeforeShow @37-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @39-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @37-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow

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
$Component->SetValue(CCDLookUp("Firstname","tblUser","id = ".$db->ToSQL($Header->DocMaker->GetValue(),ccsInteger),$db));
$db->close();
//End Custom Code

//Close lblAdministrasi_BeforeShow @65-E5CCD1BF
    return $lblAdministrasi_BeforeShow;
}
//End Close lblAdministrasi_BeforeShow

//lblCustomer_BeforeShow @66-9F1B654F
function lblCustomer_BeforeShow(& $sender)
{
    $lblCustomer_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblCustomer; //Compatibility
//End lblCustomer_BeforeShow

//Custom Code @90-2A29BDB7
global $Header;
$Component->SetValue($Header->Client->GetValue());
//End Custom Code

//Close lblCustomer_BeforeShow @66-7C7DE75F
    return $lblCustomer_BeforeShow;
}
//End Close lblCustomer_BeforeShow


?>
