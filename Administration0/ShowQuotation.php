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
//Include Common Files @1-6A97B9F2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowQuotation.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridDetil { //Detil class @2-19BDA346

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

//Class_Initialize Event @2-EE04E636
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

        $this->RndCode = new clsControl(ccsLabel, "RndCode", "RndCode", ccsText, "", CCGetRequestParam("RndCode", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Description = new clsControl(ccsLabel, "Description", "Description", ccsText, "", CCGetRequestParam("Description", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->UnitPrice = new clsControl(ccsLabel, "UnitPrice", "UnitPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("UnitPrice", ccsGet, NULL), $this);
        $this->Remark = new clsControl(ccsLabel, "Remark", "Remark", ccsMemo, "", CCGetRequestParam("Remark", ccsGet, NULL), $this);
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
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

//Show Method @2-A45C3E43
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);

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
            $this->ControlsVisible["RndCode"] = $this->RndCode->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Description"] = $this->Description->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Remark"] = $this->Remark->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->RndCode->SetValue($this->DataSource->RndCode->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Description->SetValue($this->DataSource->Description->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                $this->Remark->SetValue($this->DataSource->Remark->GetValue());
                $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                $this->Attributes->SetValue("LocalRowNumber", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->RndCode->Show();
                $this->Photo1->Show();
                $this->Description->Show();
                $this->Diameter->Show();
                $this->Height->Show();
                $this->Width->Show();
                $this->Length->Show();
                $this->UnitPrice->Show();
                $this->Remark->Show();
                $this->lblCurrency->Show();
                $this->Quotation_H_ID->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4188D996
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->RndCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Detil Class @2-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @2-28B8FEE9

//DataSource Variables @2-36CD6423
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $RndCode;
    public $Photo1;
    public $Description;
    public $Diameter;
    public $Height;
    public $Width;
    public $Length;
    public $UnitPrice;
    public $Remark;
    public $Quotation_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7D06A769
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Detil";
        $this->Initialize();
        $this->RndCode = new clsField("RndCode", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Description = new clsField("Description", ccsText, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Remark = new clsField("Remark", ccsMemo, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-859FED46
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tbladminist_quotation_d.RndCode";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-C9B6F5F2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_quotation_d.Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-C1E1F782
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_quotation_d INNER JOIN sampleceramic ON\n\n" .
        "tbladminist_quotation_d.RndCode = sampleceramic.SampleCode";
        $this->SQL = "SELECT Photo1, SampleDescription, Width, Height, Length, Diameter, tbladminist_quotation_d.* \n\n" .
        "FROM tbladminist_quotation_d INNER JOIN sampleceramic ON\n\n" .
        "tbladminist_quotation_d.RndCode = sampleceramic.SampleCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-FF81EE44
    function SetValues()
    {
        $this->RndCode->SetDBValue($this->f("RndCode"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Description->SetDBValue($this->f("SampleDescription"));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Remark->SetDBValue($this->f("Remark"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
    }
//End SetValues Method

} //End DetilDataSource Class @2-FCB6E20C

class clsRecordHeader { //Header Class @49-9DE33543

//Variables @49-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @49-97A792C7
    function clsRecordHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Header/Error";
        $this->DataSource = new clsHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Header";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "Quotation No", ccsText, "", CCGetRequestParam("QuotationNo", $Method, NULL), $this);
            $this->Rev = new clsControl(ccsLabel, "Rev", "Rev", ccsText, "", CCGetRequestParam("Rev", $Method, NULL), $this);
            $this->Validity = new clsControl(ccsLabel, "Validity", "Validity", ccsText, "", CCGetRequestParam("Validity", $Method, NULL), $this);
            $this->QuotationDate = new clsControl(ccsLabel, "QuotationDate", "Quotation Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("QuotationDate", $Method, NULL), $this);
            $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "Client Order Ref", ccsText, "", CCGetRequestParam("ClientOrderRef", $Method, NULL), $this);
            $this->ClientID = new clsControl(ccsHidden, "ClientID", "Client ID", ccsInteger, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->ClientID->Required = true;
            $this->AddressID = new clsControl(ccsLabel, "AddressID", "Address ID", ccsText, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->ContactID = new clsControl(ccsLabel, "ContactID", "Contact ID", ccsText, "", CCGetRequestParam("ContactID", $Method, NULL), $this);
            $this->PackagingCost = new clsControl(ccsLabel, "PackagingCost", "Packaging Cost", ccsSingle, "", CCGetRequestParam("PackagingCost", $Method, NULL), $this);
            $this->DeliveryTermID = new clsControl(ccsLabel, "DeliveryTermID", "Delivery Term ID", ccsText, "", CCGetRequestParam("DeliveryTermID", $Method, NULL), $this);
            $this->DeliveryTimeID = new clsControl(ccsLabel, "DeliveryTimeID", "Delivery Time ID", ccsText, "", CCGetRequestParam("DeliveryTimeID", $Method, NULL), $this);
            $this->PaymentTermID = new clsControl(ccsLabel, "PaymentTermID", "Payment Term ID", ccsText, "", CCGetRequestParam("PaymentTermID", $Method, NULL), $this);
            $this->SpecialInstruction = new clsControl(ccsLabel, "SpecialInstruction", "Special Instruction", ccsMemo, "", CCGetRequestParam("SpecialInstruction", $Method, NULL), $this);
            $this->Address = new clsControl(ccsLabel, "Address", "Address", ccsMemo, "", CCGetRequestParam("Address", $Method, NULL), $this);
            $this->Email = new clsControl(ccsLabel, "Email", "Email", ccsText, "", CCGetRequestParam("Email", $Method, NULL), $this);
            $this->Phone = new clsControl(ccsLabel, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", $Method, NULL), $this);
            $this->Fax = new clsControl(ccsLabel, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", $Method, NULL), $this);
            $this->lblClient = new clsControl(ccsLabel, "lblClient", "lblClient", ccsText, "", CCGetRequestParam("lblClient", $Method, NULL), $this);
            $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", $Method, NULL), $this);
            $this->CurrencyID = new clsControl(ccsHidden, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @49-045B5529
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @49-C70CDA71
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->DocMaker->Validate() && $Validation);
        $Validation = ($this->CurrencyID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DocMaker->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CurrencyID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @49-1C5C403A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->QuotationNo->Errors->Count());
        $errors = ($errors || $this->Rev->Errors->Count());
        $errors = ($errors || $this->Validity->Errors->Count());
        $errors = ($errors || $this->QuotationDate->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->ContactID->Errors->Count());
        $errors = ($errors || $this->PackagingCost->Errors->Count());
        $errors = ($errors || $this->DeliveryTermID->Errors->Count());
        $errors = ($errors || $this->DeliveryTimeID->Errors->Count());
        $errors = ($errors || $this->PaymentTermID->Errors->Count());
        $errors = ($errors || $this->SpecialInstruction->Errors->Count());
        $errors = ($errors || $this->Address->Errors->Count());
        $errors = ($errors || $this->Email->Errors->Count());
        $errors = ($errors || $this->Phone->Errors->Count());
        $errors = ($errors || $this->Fax->Errors->Count());
        $errors = ($errors || $this->lblClient->Errors->Count());
        $errors = ($errors || $this->DocMaker->Errors->Count());
        $errors = ($errors || $this->CurrencyID->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @49-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @49-17DC9883
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @49-522E5686
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
                $this->Rev->SetValue($this->DataSource->Rev->GetValue());
                $this->Validity->SetValue($this->DataSource->Validity->GetValue());
                $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
                $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                $this->ContactID->SetValue($this->DataSource->ContactID->GetValue());
                $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
                $this->DeliveryTermID->SetValue($this->DataSource->DeliveryTermID->GetValue());
                $this->DeliveryTimeID->SetValue($this->DataSource->DeliveryTimeID->GetValue());
                $this->PaymentTermID->SetValue($this->DataSource->PaymentTermID->GetValue());
                $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
                $this->Address->SetValue($this->DataSource->Address->GetValue());
                $this->Email->SetValue($this->DataSource->Email->GetValue());
                $this->Phone->SetValue($this->DataSource->Phone->GetValue());
                $this->Fax->SetValue($this->DataSource->Fax->GetValue());
                $this->lblClient->SetValue($this->DataSource->lblClient->GetValue());
                if(!$this->FormSubmitted){
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                    $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->QuotationNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Rev->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Validity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QuotationDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ContactID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTermID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTimeID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PaymentTermID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SpecialInstruction->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Phone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Fax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblClient->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DocMaker->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CurrencyID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->QuotationNo->Show();
        $this->Rev->Show();
        $this->Validity->Show();
        $this->QuotationDate->Show();
        $this->ClientOrderRef->Show();
        $this->ClientID->Show();
        $this->AddressID->Show();
        $this->ContactID->Show();
        $this->PackagingCost->Show();
        $this->DeliveryTermID->Show();
        $this->DeliveryTimeID->Show();
        $this->PaymentTermID->Show();
        $this->SpecialInstruction->Show();
        $this->Address->Show();
        $this->Email->Show();
        $this->Phone->Show();
        $this->Fax->Show();
        $this->lblClient->Show();
        $this->DocMaker->Show();
        $this->CurrencyID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Header Class @49-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @49-AB3B61E5

//DataSource Variables @49-B2325F30
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $QuotationNo;
    public $Rev;
    public $Validity;
    public $QuotationDate;
    public $ClientOrderRef;
    public $ClientID;
    public $AddressID;
    public $ContactID;
    public $PackagingCost;
    public $DeliveryTermID;
    public $DeliveryTimeID;
    public $PaymentTermID;
    public $SpecialInstruction;
    public $Address;
    public $Email;
    public $Phone;
    public $Fax;
    public $lblClient;
    public $DocMaker;
    public $CurrencyID;
//End DataSource Variables

//DataSourceClass_Initialize Event @49-3AAB21DA
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Header/Error";
        $this->Initialize();
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->Rev = new clsField("Rev", ccsText, "");
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsText, "");
        
        $this->ContactID = new clsField("ContactID", ccsText, "");
        
        $this->PackagingCost = new clsField("PackagingCost", ccsSingle, "");
        
        $this->DeliveryTermID = new clsField("DeliveryTermID", ccsText, "");
        
        $this->DeliveryTimeID = new clsField("DeliveryTimeID", ccsText, "");
        
        $this->PaymentTermID = new clsField("PaymentTermID", ccsText, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Address = new clsField("Address", ccsMemo, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->lblClient = new clsField("lblClient", ccsText, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @49-AF8EFC66
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_quotation_h.Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @49-9057D627
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbladminist_quotation_h.*, Company, ContactName, Email, Address, Phone, Fax, ClientCompany, DeliveryTerm, DeliveryTime, PaymentTerm \n\n" .
        "FROM (((((tbladminist_quotation_h INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_quotation_h.AddressID = tbladminist_addressbook.AddressID) INNER JOIN tbladminist_addressbook_contact ON\n\n" .
        "tbladminist_quotation_h.ContactId = tbladminist_addressbook_contact.ContactId) INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_quotation_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_deliveryterm ON\n\n" .
        "tbladminist_quotation_h.DeliveryTermID = tbladminist_deliveryterm.DeliveryTermID) INNER JOIN tbladminist_deliverytime ON\n\n" .
        "tbladminist_quotation_h.DeliveryTimeID = tbladminist_deliverytime.DeliveryTimeID) INNER JOIN tbladminist_paymentterm ON\n\n" .
        "tbladminist_quotation_h.PaymentTermID = tbladminist_paymentterm.PaymentTermID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @49-8BBC1E0B
    function SetValues()
    {
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->Rev->SetDBValue($this->f("Rev"));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->QuotationDate->SetDBValue(trim($this->f("QuotationDate")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->AddressID->SetDBValue($this->f("Company"));
        $this->ContactID->SetDBValue($this->f("ContactName"));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryTermID->SetDBValue($this->f("DeliveryTerm"));
        $this->DeliveryTimeID->SetDBValue($this->f("DeliveryTime"));
        $this->PaymentTermID->SetDBValue($this->f("PaymentTerm"));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Address->SetDBValue($this->f("Address"));
        $this->Email->SetDBValue($this->f("Email"));
        $this->Phone->SetDBValue($this->f("Phone"));
        $this->Fax->SetDBValue($this->f("Fax"));
        $this->lblClient->SetDBValue($this->f("ClientCompany"));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->CurrencyID->SetDBValue(trim($this->f("Currency")));
    }
//End SetValues Method

} //End HeaderDataSource Class @49-FCB6E20C

//Initialize Page @1-C1349B0B
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
$TemplateFileName = "ShowQuotation.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-880EC5A2
include_once("./ShowQuotation_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1A5076C2
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Detil = new clsGridDetil("", $MainPage);
$Header = new clsRecordHeader("", $MainPage);
$lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $MainPage);
$lblCustomer = new clsControl(ccsLabel, "lblCustomer", "lblCustomer", ccsText, "", CCGetRequestParam("lblCustomer", ccsGet, NULL), $MainPage);
$MainPage->Detil = & $Detil;
$MainPage->Header = & $Header;
$MainPage->lblAdministrasi = & $lblAdministrasi;
$MainPage->lblCustomer = & $lblCustomer;
$Detil->Initialize();
$Header->Initialize();

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

//Execute Components @1-26FC0CAB
$Header->Operation();
//End Execute Components

//Go to destination page @1-B2DB1CB8
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Detil);
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-86F4D339
$Detil->Show();
$Header->Show();
$lblAdministrasi->Show();
$lblCustomer->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FBCB6E29
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Detil);
unset($Header);
unset($Tpl);
//End Unload Page
?>