<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);

if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
//Include Common Files @1-B2B332C2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowProforma.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridHeader { //Header class @2-C9AA34A2

//Variables @2-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @2-248A8BC4
    function clsGridHeader($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Header";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Header";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->DeliveryTerm = new clsControl(ccsLabel, "DeliveryTerm", "DeliveryTerm", ccsText, "", CCGetRequestParam("DeliveryTerm", ccsGet, NULL), $this);
        $this->DeliveryTime = new clsControl(ccsLabel, "DeliveryTime", "DeliveryTime", ccsText, "", CCGetRequestParam("DeliveryTime", ccsGet, NULL), $this);
        $this->PaymentTerm = new clsControl(ccsLabel, "PaymentTerm", "PaymentTerm", ccsText, "", CCGetRequestParam("PaymentTerm", ccsGet, NULL), $this);
        $this->ProformaNo = new clsControl(ccsLabel, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->Rev = new clsControl(ccsLabel, "Rev", "Rev", ccsText, "", CCGetRequestParam("Rev", ccsGet, NULL), $this);
        $this->Validity = new clsControl(ccsLabel, "Validity", "Validity", ccsText, "", CCGetRequestParam("Validity", ccsGet, NULL), $this);
        $this->ProformaDate = new clsControl(ccsLabel, "ProformaDate", "ProformaDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("ProformaDate", ccsGet, NULL), $this);
        $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", ccsGet, NULL), $this);
        $this->ContactName = new clsControl(ccsLabel, "ContactName", "ContactName", ccsText, "", CCGetRequestParam("ContactName", ccsGet, NULL), $this);
        $this->SpecialInstruction = new clsControl(ccsLabel, "SpecialInstruction", "SpecialInstruction", ccsMemo, "", CCGetRequestParam("SpecialInstruction", ccsGet, NULL), $this);
        $this->Email = new clsControl(ccsLabel, "Email", "Email", ccsText, "", CCGetRequestParam("Email", ccsGet, NULL), $this);
        $this->Address = new clsControl(ccsLabel, "Address", "Address", ccsText, "", CCGetRequestParam("Address", ccsGet, NULL), $this);
        $this->Phone = new clsControl(ccsLabel, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", ccsGet, NULL), $this);
        $this->Fax = new clsControl(ccsLabel, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", ccsGet, NULL), $this);
        $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", ccsGet, NULL), $this);
        $this->CurrencyID = new clsControl(ccsHidden, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-FC809250
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Company->SetValue($this->DataSource->Company->GetValue());
        $this->DeliveryTerm->SetValue($this->DataSource->DeliveryTerm->GetValue());
        $this->DeliveryTime->SetValue($this->DataSource->DeliveryTime->GetValue());
        $this->PaymentTerm->SetValue($this->DataSource->PaymentTerm->GetValue());
        $this->ProformaNo->SetValue($this->DataSource->ProformaNo->GetValue());
        $this->Rev->SetValue($this->DataSource->Rev->GetValue());
        $this->Validity->SetValue($this->DataSource->Validity->GetValue());
        $this->ProformaDate->SetValue($this->DataSource->ProformaDate->GetValue());
        $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
        $this->ContactName->SetValue($this->DataSource->ContactName->GetValue());
        $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
        $this->Email->SetValue($this->DataSource->Email->GetValue());
        $this->Address->SetValue($this->DataSource->Address->GetValue());
        $this->Phone->SetValue($this->DataSource->Phone->GetValue());
        $this->Fax->SetValue($this->DataSource->Fax->GetValue());
        $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
        $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
        $this->Company->Show();
        $this->DeliveryTerm->Show();
        $this->DeliveryTime->Show();
        $this->PaymentTerm->Show();
        $this->ProformaNo->Show();
        $this->Rev->Show();
        $this->Validity->Show();
        $this->ProformaDate->Show();
        $this->ClientOrderRef->Show();
        $this->ContactName->Show();
        $this->SpecialInstruction->Show();
        $this->Email->Show();
        $this->Address->Show();
        $this->Phone->Show();
        $this->Fax->Show();
        $this->DocMaker->Show();
        $this->CurrencyID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-580C33D7
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Header Class @2-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @2-AB3B61E5

//DataSource Variables @2-25A0893A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Company;
    public $DeliveryTerm;
    public $DeliveryTime;
    public $PaymentTerm;
    public $ProformaNo;
    public $Rev;
    public $Validity;
    public $ProformaDate;
    public $ClientOrderRef;
    public $ContactName;
    public $SpecialInstruction;
    public $Email;
    public $Address;
    public $Phone;
    public $Fax;
    public $DocMaker;
    public $CurrencyID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3967BDE3
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Header";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->DeliveryTerm = new clsField("DeliveryTerm", ccsText, "");
        
        $this->DeliveryTime = new clsField("DeliveryTime", ccsText, "");
        
        $this->PaymentTerm = new clsField("PaymentTerm", ccsText, "");
        
        $this->ProformaNo = new clsField("ProformaNo", ccsText, "");
        
        $this->Rev = new clsField("Rev", ccsText, "");
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->ProformaDate = new clsField("ProformaDate", ccsDate, $this->DateFormat);
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->ContactName = new clsField("ContactName", ccsText, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Address = new clsField("Address", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-067D3121
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsInteger, "", "", $this->Parameters["urlProforma_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_proforma_h.Proforma_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-408F97B9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((tbladminist_proforma_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_proforma_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_proforma_h.AddressID = tbladminist_addressbook.AddressID) INNER JOIN tbladminist_deliveryterm ON\n\n" .
        "tbladminist_proforma_h.DeliveryTermID = tbladminist_deliveryterm.DeliveryTermID) INNER JOIN tbladminist_deliverytime ON\n\n" .
        "tbladminist_proforma_h.DeliveryTimeID = tbladminist_deliverytime.DeliveryTimeID) INNER JOIN tbladminist_paymentterm ON\n\n" .
        "tbladminist_proforma_h.PaymentTermID = tbladminist_paymentterm.PaymentTermID) INNER JOIN tbladminist_addressbook_contact ON\n\n" .
        "tbladminist_proforma_h.ContactID = tbladminist_addressbook_contact.ContactId";
        $this->SQL = "SELECT tbladminist_proforma_h.*, ClientCompany, Company, DeliveryTerm, PaymentTerm, DeliveryTime, ContactName, Email, Address, Fax,\n\n" .
        "Phone \n\n" .
        "FROM (((((tbladminist_proforma_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_proforma_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_proforma_h.AddressID = tbladminist_addressbook.AddressID) INNER JOIN tbladminist_deliveryterm ON\n\n" .
        "tbladminist_proforma_h.DeliveryTermID = tbladminist_deliveryterm.DeliveryTermID) INNER JOIN tbladminist_deliverytime ON\n\n" .
        "tbladminist_proforma_h.DeliveryTimeID = tbladminist_deliverytime.DeliveryTimeID) INNER JOIN tbladminist_paymentterm ON\n\n" .
        "tbladminist_proforma_h.PaymentTermID = tbladminist_paymentterm.PaymentTermID) INNER JOIN tbladminist_addressbook_contact ON\n\n" .
        "tbladminist_proforma_h.ContactID = tbladminist_addressbook_contact.ContactId {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-08A9A1D6
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
        $this->DeliveryTerm->SetDBValue($this->f("DeliveryTerm"));
        $this->DeliveryTime->SetDBValue($this->f("DeliveryTime"));
        $this->PaymentTerm->SetDBValue($this->f("PaymentTerm"));
        $this->ProformaNo->SetDBValue($this->f("ProformaNo"));
        $this->Rev->SetDBValue($this->f("Rev"));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->ProformaDate->SetDBValue(trim($this->f("ProformaDate")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->ContactName->SetDBValue($this->f("ContactName"));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->CurrencyID->SetDBValue(trim($this->f("Currency")));
    }
//End SetValues Method

} //End HeaderDataSource Class @2-FCB6E20C

class clsGridDetil { //Detil class @45-19BDA346

//Variables @45-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @45-CA3C35B9
    function clsGridDetil($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Detil";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Detil";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetilDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->CollectID = new clsControl(ccsLabel, "CollectID", "CollectID", ccsInteger, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsInteger, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Unit = new clsControl(ccsLabel, "Unit", "Unit", ccsText, "", CCGetRequestParam("Unit", ccsGet, NULL), $this);
        $this->UnitPrice = new clsControl(ccsLabel, "UnitPrice", "UnitPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("UnitPrice", ccsGet, NULL), $this);
        $this->Total = new clsControl(ccsLabel, "Total", "Total", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Total", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $this);
        $this->DocNotes = new clsControl(ccsLabel, "DocNotes", "DocNotes", ccsMemo, "", CCGetRequestParam("DocNotes", ccsGet, NULL), $this);
        $this->SubTotal = new clsControl(ccsLabel, "SubTotal", "SubTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SubTotal", ccsGet, NULL), $this);
        $this->PackCost = new clsControl(ccsLabel, "PackCost", "PackCost", ccsInteger, "", CCGetRequestParam("PackCost", ccsGet, NULL), $this);
        $this->Discount = new clsControl(ccsLabel, "Discount", "Discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Discount", ccsGet, NULL), $this);
        $this->Packaging = new clsControl(ccsLabel, "Packaging", "Packaging", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Packaging", ccsGet, NULL), $this);
        $this->Fumigation = new clsControl(ccsLabel, "Fumigation", "Fumigation", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Fumigation", ccsGet, NULL), $this);
        $this->GrandTotal = new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @45-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @45-98FC7153
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Total"] = $this->Total->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                $this->Total->SetValue($this->DataSource->Total->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->Attributes->SetValue("LocalRowNumber", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Proforma_H_ID->Show();
                $this->CollectID->Show();
                $this->CollectCode->Show();
                $this->Qty->Show();
                $this->Unit->Show();
                $this->UnitPrice->Show();
                $this->Total->Show();
                $this->CategoryName->Show();
                $this->ColorName->Show();
                $this->Photo1->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->MaterialName->Show();
                $this->NameDesc->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->lblCurrency->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Company->Show();
        $this->lblAdministrasi->Show();
        $this->DocNotes->Show();
        $this->SubTotal->Show();
        $this->PackCost->Show();
        $this->Discount->Show();
        $this->Packaging->Show();
        $this->Fumigation->Show();
        $this->GrandTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @45-61FC0B18
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Detil Class @45-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @45-28B8FEE9

//DataSource Variables @45-4578EE06
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Proforma_H_ID;
    public $CollectID;
    public $CollectCode;
    public $Qty;
    public $Unit;
    public $UnitPrice;
    public $Total;
    public $CategoryName;
    public $ColorName;
    public $Photo1;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $MaterialName;
    public $NameDesc;
    public $SizeName;
    public $TextureName;
//End DataSource Variables

//DataSourceClass_Initialize Event @45-BBAC2982
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Detil";
        $this->Initialize();
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Total = new clsField("Total", ccsFloat, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @45-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @45-DBC47ED7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsInteger, "", "", $this->Parameters["urlProforma_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_proforma_d.Proforma_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @45-5DDC94C0
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_proforma_d ON\n\n" .
        "tbladminist_proforma_d.CollectID = tblcollect_master.ID";
        $this->SQL = "SELECT tbladminist_proforma_d.*, CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc, ID, Photo1, Width,\n\n" .
        "Height, Length, Diameter \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_proforma_d ON\n\n" .
        "tbladminist_proforma_d.CollectID = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @45-E4F19A63
    function SetValues()
    {
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Total->SetDBValue(trim($this->f("Total")));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
    }
//End SetValues Method

} //End DetilDataSource Class @45-FCB6E20C

//Initialize Page @1-676057F9
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "ShowProforma.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D5FF8347
include_once("./ShowProforma_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-2447F5D4
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsGridHeader("", $MainPage);
$Detil = new clsGridDetil("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->Detil = & $Detil;
$Header->Initialize();
$Detil->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-4C0FF4C7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Header);
    unset($Detil);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EE570319
$Header->Show();
$Detil->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AE87764E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Header);
unset($Detil);
unset($Tpl);
//End Unload Page


?>
