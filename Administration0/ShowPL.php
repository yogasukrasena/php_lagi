<?php
//Include Common Files @1-3274BBDB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowPL.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordHeader { //Header Class @2-9DE33543

//Variables @2-9E315808

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

//Class_Initialize Event @2-8E38A87A
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
            $this->PackingListNo = new clsControl(ccsLabel, "PackingListNo", "Packing List No", ccsText, "", CCGetRequestParam("PackingListNo", $Method, NULL), $this);
            $this->PackingListDate = new clsControl(ccsLabel, "PackingListDate", "Packing List Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("PackingListDate", $Method, NULL), $this);
            $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice H ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", $Method, NULL), $this);
            $this->OrderRef = new clsControl(ccsLabel, "OrderRef", "Order Ref", ccsText, "", CCGetRequestParam("OrderRef", $Method, NULL), $this);
            $this->InvoiceAddressContact = new clsControl(ccsHidden, "InvoiceAddressContact", "Invoice Address", ccsInteger, "", CCGetRequestParam("InvoiceAddressContact", $Method, NULL), $this);
            $this->lblInvoiceAddressContact = new clsControl(ccsLabel, "lblInvoiceAddressContact", "lblInvoiceAddressContact", ccsText, "", CCGetRequestParam("lblInvoiceAddressContact", $Method, NULL), $this);
            $this->DeliveryAddressContact = new clsControl(ccsHidden, "DeliveryAddressContact", "Delivery Address", ccsInteger, "", CCGetRequestParam("DeliveryAddressContact", $Method, NULL), $this);
            $this->lblDeliveryAddressContact = new clsControl(ccsLabel, "lblDeliveryAddressContact", "lblDeliveryAddressContact", ccsText, "", CCGetRequestParam("lblDeliveryAddressContact", $Method, NULL), $this);
            $this->InvoiceAddress = new clsControl(ccsLabel, "InvoiceAddress", "Address", ccsText, "", CCGetRequestParam("InvoiceAddress", $Method, NULL), $this);
            $this->DeliveryAddress = new clsControl(ccsLabel, "DeliveryAddress", "Address", ccsText, "", CCGetRequestParam("DeliveryAddress", $Method, NULL), $this);
            $this->InvoicePhone = new clsControl(ccsLabel, "InvoicePhone", "Phone", ccsText, "", CCGetRequestParam("InvoicePhone", $Method, NULL), $this);
            $this->InvoiceFax = new clsControl(ccsLabel, "InvoiceFax", "Fax", ccsText, "", CCGetRequestParam("InvoiceFax", $Method, NULL), $this);
            $this->DeliveryPhone = new clsControl(ccsLabel, "DeliveryPhone", "Phone", ccsText, "", CCGetRequestParam("DeliveryPhone", $Method, NULL), $this);
            $this->DeliveryFax = new clsControl(ccsLabel, "DeliveryFax", "Fax", ccsText, "", CCGetRequestParam("DeliveryFax", $Method, NULL), $this);
            $this->DumyAddress1 = new clsControl(ccsLabel, "DumyAddress1", "DumyAddress1", ccsText, "", CCGetRequestParam("DumyAddress1", $Method, NULL), $this);
            $this->DumyAddress2 = new clsControl(ccsLabel, "DumyAddress2", "DumyAddress2", ccsText, "", CCGetRequestParam("DumyAddress2", $Method, NULL), $this);
            $this->PL_H_ID = new clsControl(ccsHidden, "PL_H_ID", "PL_H_ID", ccsInteger, "", CCGetRequestParam("PL_H_ID", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-1F14898E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlPL_H_ID"] = CCGetFromGet("PL_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-2C546863
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Invoice_H_ID->Validate() && $Validation);
        $Validation = ($this->InvoiceAddressContact->Validate() && $Validation);
        $Validation = ($this->DeliveryAddressContact->Validate() && $Validation);
        $Validation = ($this->PL_H_ID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Invoice_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoiceAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PL_H_ID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C77E44A5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->PackingListNo->Errors->Count());
        $errors = ($errors || $this->PackingListDate->Errors->Count());
        $errors = ($errors || $this->Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->OrderRef->Errors->Count());
        $errors = ($errors || $this->InvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->lblInvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->DeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->lblDeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->InvoiceAddress->Errors->Count());
        $errors = ($errors || $this->DeliveryAddress->Errors->Count());
        $errors = ($errors || $this->InvoicePhone->Errors->Count());
        $errors = ($errors || $this->InvoiceFax->Errors->Count());
        $errors = ($errors || $this->DeliveryPhone->Errors->Count());
        $errors = ($errors || $this->DeliveryFax->Errors->Count());
        $errors = ($errors || $this->DumyAddress1->Errors->Count());
        $errors = ($errors || $this->DumyAddress2->Errors->Count());
        $errors = ($errors || $this->PL_H_ID->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
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

//Operation Method @2-17DC9883
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

//Show Method @2-F76FD661
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
                $this->PackingListNo->SetValue($this->DataSource->PackingListNo->GetValue());
                $this->PackingListDate->SetValue($this->DataSource->PackingListDate->GetValue());
                $this->OrderRef->SetValue($this->DataSource->OrderRef->GetValue());
                $this->DumyAddress1->SetValue($this->DataSource->DumyAddress1->GetValue());
                $this->DumyAddress2->SetValue($this->DataSource->DumyAddress2->GetValue());
                if(!$this->FormSubmitted){
                    $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                    $this->InvoiceAddressContact->SetValue($this->DataSource->InvoiceAddressContact->GetValue());
                    $this->DeliveryAddressContact->SetValue($this->DataSource->DeliveryAddressContact->GetValue());
                    $this->PL_H_ID->SetValue($this->DataSource->PL_H_ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->PackingListNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackingListDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Invoice_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->OrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblInvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoicePhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryPhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DumyAddress1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DumyAddress2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PL_H_ID->Errors->ToString());
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

        $this->PackingListNo->Show();
        $this->PackingListDate->Show();
        $this->Invoice_H_ID->Show();
        $this->OrderRef->Show();
        $this->InvoiceAddressContact->Show();
        $this->lblInvoiceAddressContact->Show();
        $this->DeliveryAddressContact->Show();
        $this->lblDeliveryAddressContact->Show();
        $this->InvoiceAddress->Show();
        $this->DeliveryAddress->Show();
        $this->InvoicePhone->Show();
        $this->InvoiceFax->Show();
        $this->DeliveryPhone->Show();
        $this->DeliveryFax->Show();
        $this->DumyAddress1->Show();
        $this->DumyAddress2->Show();
        $this->PL_H_ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Header Class @2-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @2-AB3B61E5

//DataSource Variables @2-AF557FA3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $PackingListNo;
    public $PackingListDate;
    public $Invoice_H_ID;
    public $OrderRef;
    public $InvoiceAddressContact;
    public $lblInvoiceAddressContact;
    public $DeliveryAddressContact;
    public $lblDeliveryAddressContact;
    public $InvoiceAddress;
    public $DeliveryAddress;
    public $InvoicePhone;
    public $InvoiceFax;
    public $DeliveryPhone;
    public $DeliveryFax;
    public $DumyAddress1;
    public $DumyAddress2;
    public $PL_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8328F191
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Header/Error";
        $this->Initialize();
        $this->PackingListNo = new clsField("PackingListNo", ccsText, "");
        
        $this->PackingListDate = new clsField("PackingListDate", ccsDate, $this->DateFormat);
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
        $this->OrderRef = new clsField("OrderRef", ccsText, "");
        
        $this->InvoiceAddressContact = new clsField("InvoiceAddressContact", ccsInteger, "");
        
        $this->lblInvoiceAddressContact = new clsField("lblInvoiceAddressContact", ccsText, "");
        
        $this->DeliveryAddressContact = new clsField("DeliveryAddressContact", ccsInteger, "");
        
        $this->lblDeliveryAddressContact = new clsField("lblDeliveryAddressContact", ccsText, "");
        
        $this->InvoiceAddress = new clsField("InvoiceAddress", ccsText, "");
        
        $this->DeliveryAddress = new clsField("DeliveryAddress", ccsText, "");
        
        $this->InvoicePhone = new clsField("InvoicePhone", ccsText, "");
        
        $this->InvoiceFax = new clsField("InvoiceFax", ccsText, "");
        
        $this->DeliveryPhone = new clsField("DeliveryPhone", ccsText, "");
        
        $this->DeliveryFax = new clsField("DeliveryFax", ccsText, "");
        
        $this->DumyAddress1 = new clsField("DumyAddress1", ccsText, "");
        
        $this->DumyAddress2 = new clsField("DumyAddress2", ccsText, "");
        
        $this->PL_H_ID = new clsField("PL_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-CBFD3569
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPL_H_ID", ccsInteger, "", "", $this->Parameters["urlPL_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_packinglist_h.PL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-F69133EE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT tbladminist_packinglist_h.*, Company \n\n" .
        "FROM tbladminist_packinglist_h INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_packinglist_h.AddressID = tbladminist_addressbook.AddressID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-332C58E0
    function SetValues()
    {
        $this->PackingListNo->SetDBValue($this->f("PLNo"));
        $this->PackingListDate->SetDBValue(trim($this->f("PLDate")));
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
        $this->OrderRef->SetDBValue($this->f("OrderRef"));
        $this->InvoiceAddressContact->SetDBValue(trim($this->f("InvoiceContactID")));
        $this->DeliveryAddressContact->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->DumyAddress1->SetDBValue($this->f("Company"));
        $this->DumyAddress2->SetDBValue($this->f("Company"));
        $this->PL_H_ID->SetDBValue(trim($this->f("PL_H_ID")));
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

//Class_Initialize Event @45-D09CC679
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

        $this->PL_H_ID = new clsControl(ccsHidden, "PL_H_ID", "PL_H_ID", ccsInteger, "", CCGetRequestParam("PL_H_ID", ccsGet, NULL), $this);
        $this->CollectID = new clsControl(ccsLabel, "CollectID", "CollectID", ccsInteger, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsInteger, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Unit = new clsControl(ccsLabel, "Unit", "Unit", ccsText, "", CCGetRequestParam("Unit", ccsGet, NULL), $this);
        $this->Total = new clsControl(ccsLabel, "Total", "Total", ccsMemo, "", CCGetRequestParam("Total", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->BoxNumber = new clsControl(ccsLabel, "BoxNumber", "BoxNumber", ccsText, "", CCGetRequestParam("BoxNumber", ccsGet, NULL), $this);
        $this->BoxLength = new clsControl(ccsLabel, "BoxLength", "BoxLength", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("BoxLength", ccsGet, NULL), $this);
        $this->BoxWidth = new clsControl(ccsLabel, "BoxWidth", "BoxWidth", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("BoxWidth", ccsGet, NULL), $this);
        $this->BoxHeight = new clsControl(ccsLabel, "BoxHeight", "BoxHeight", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("BoxHeight", ccsGet, NULL), $this);
        $this->BoxWeight = new clsControl(ccsLabel, "BoxWeight", "BoxWeight", ccsFloat, array(False, 2, Null, "", False, "", "", 1, True, ""), CCGetRequestParam("BoxWeight", ccsGet, NULL), $this);
        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $this);
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

//Show Method @45-08385EE8
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlPL_H_ID"] = CCGetFromGet("PL_H_ID", NULL);
        $this->DataSource->Parameters["urlBox_H_ID"] = CCGetFromGet("Box_H_ID", NULL);

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
            $this->ControlsVisible["PL_H_ID"] = $this->PL_H_ID->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
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
            $this->ControlsVisible["BoxNumber"] = $this->BoxNumber->Visible;
            $this->ControlsVisible["BoxLength"] = $this->BoxLength->Visible;
            $this->ControlsVisible["BoxWidth"] = $this->BoxWidth->Visible;
            $this->ControlsVisible["BoxHeight"] = $this->BoxHeight->Visible;
            $this->ControlsVisible["BoxWeight"] = $this->BoxWeight->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->PL_H_ID->SetValue($this->DataSource->PL_H_ID->GetValue());
                $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->Unit->SetValue($this->DataSource->Unit->GetValue());
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
                $this->BoxNumber->SetValue($this->DataSource->BoxNumber->GetValue());
                $this->BoxLength->SetValue($this->DataSource->BoxLength->GetValue());
                $this->BoxWidth->SetValue($this->DataSource->BoxWidth->GetValue());
                $this->BoxHeight->SetValue($this->DataSource->BoxHeight->GetValue());
                $this->BoxWeight->SetValue($this->DataSource->BoxWeight->GetValue());
                $this->Attributes->SetValue("LocalRowNumber", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->PL_H_ID->Show();
                $this->CollectID->Show();
                $this->CollectCode->Show();
                $this->Qty->Show();
                $this->Unit->Show();
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
                $this->BoxNumber->Show();
                $this->BoxLength->Show();
                $this->BoxWidth->Show();
                $this->BoxHeight->Show();
                $this->BoxWeight->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @45-97E1DCB4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->PL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
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
        $errors = ComposeStrings($errors, $this->BoxNumber->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BoxLength->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BoxWidth->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BoxHeight->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BoxWeight->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Detil Class @45-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @45-28B8FEE9

//DataSource Variables @45-99AE8D22
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $PL_H_ID;
    public $CollectID;
    public $CollectCode;
    public $Qty;
    public $Unit;
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
    public $BoxNumber;
    public $BoxLength;
    public $BoxWidth;
    public $BoxHeight;
    public $BoxWeight;
//End DataSource Variables

//DataSourceClass_Initialize Event @45-69332EC6
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Detil";
        $this->Initialize();
        $this->PL_H_ID = new clsField("PL_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->Total = new clsField("Total", ccsMemo, "");
        
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
        
        $this->BoxNumber = new clsField("BoxNumber", ccsText, "");
        
        $this->BoxLength = new clsField("BoxLength", ccsFloat, "");
        
        $this->BoxWidth = new clsField("BoxWidth", ccsFloat, "");
        
        $this->BoxHeight = new clsField("BoxHeight", ccsFloat, "");
        
        $this->BoxWeight = new clsField("BoxWeight", ccsFloat, "");
        

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

//Prepare Method @45-8A7C678A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPL_H_ID", ccsInteger, "", "", $this->Parameters["urlPL_H_ID"], "", false);
        $this->wp->AddParameter("2", "urlBox_H_ID", ccsInteger, "", "", $this->Parameters["urlBox_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_box_h.PL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "tbladminist_box_d.Box_H_ID", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @45-7EBC1CA3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((((((tbladminist_box_d INNER JOIN tblcollect_master ON\n\n" .
        "tbladminist_box_d.CollectID = tblcollect_master.ID) INNER JOIN tbladminist_box_h ON\n\n" .
        "tbladminist_box_d.Box_H_ID = tbladminist_box_h.Box_H_ID) INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode";
        $this->SQL = "SELECT CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc, ID, Photo1, tblcollect_master.Width AS tblcollect_master_Width,\n\n" .
        "tblcollect_master.Height AS tblcollect_master_Height, tblcollect_master.Length AS tblcollect_master_Length, Diameter, tbladminist_box_h.*,\n\n" .
        "tbladminist_box_d.*, CollectCode \n\n" .
        "FROM ((((((((tbladminist_box_d INNER JOIN tblcollect_master ON\n\n" .
        "tbladminist_box_d.CollectID = tblcollect_master.ID) INNER JOIN tbladminist_box_h ON\n\n" .
        "tbladminist_box_d.Box_H_ID = tbladminist_box_h.Box_H_ID) INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @45-27E6AB10
    function SetValues()
    {
        $this->PL_H_ID->SetDBValue(trim($this->f("PL_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->Total->SetDBValue($this->f("Remarks"));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("tblcollect_master_Width")));
        $this->Height->SetDBValue(trim($this->f("tblcollect_master_Height")));
        $this->Length->SetDBValue(trim($this->f("tblcollect_master_Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
        $this->BoxNumber->SetDBValue($this->f("BoxNumber"));
        $this->BoxLength->SetDBValue(trim($this->f("Length")));
        $this->BoxWidth->SetDBValue(trim($this->f("Width")));
        $this->BoxHeight->SetDBValue(trim($this->f("Height")));
        $this->BoxWeight->SetDBValue(trim($this->f("Weight")));
    }
//End SetValues Method

} //End DetilDataSource Class @45-FCB6E20C

//Initialize Page @1-699C1280
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
$TemplateFileName = "ShowPL.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-C0B9528C
include_once("./ShowPL_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-856B337D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsRecordHeader("", $MainPage);
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

//Execute Components @1-26FC0CAB
$Header->Operation();
//End Execute Components

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

//Show Page @1-FF250CF0
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
