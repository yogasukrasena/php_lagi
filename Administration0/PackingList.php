<?php
//Include Common Files @1-A7D827B3
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PackingList.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-373D8799

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
    public $Sorter_Company;
    public $Sorter_InvoicePar;
    public $Sorter_PL_H_ID;
    public $Sorter_PLNo;
    public $Sorter_PLDate;
//End Variables

//Class_Initialize Event @2-E6EC7DB0
    function clsGridGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridDataSource($this);
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
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->InvoiceNo = new clsControl(ccsLabel, "InvoiceNo", "InvoiceNo", ccsText, "", CCGetRequestParam("InvoiceNo", ccsGet, NULL), $this);
        $this->PL_H_ID = new clsControl(ccsLink, "PL_H_ID", "PL_H_ID", ccsInteger, "", CCGetRequestParam("PL_H_ID", ccsGet, NULL), $this);
        $this->PL_H_ID->Page = "AddPackList.php";
        $this->PLNo = new clsControl(ccsLink, "PLNo", "PLNo", ccsText, "", CCGetRequestParam("PLNo", ccsGet, NULL), $this);
        $this->PLNo->Page = "ShowPL.php";
        $this->PLDate = new clsControl(ccsLabel, "PLDate", "PLDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("PLDate", ccsGet, NULL), $this);
        $this->tbladminist_addressbook_t1_TotalRecords = new clsControl(ccsLabel, "tbladminist_addressbook_t1_TotalRecords", "tbladminist_addressbook_t1_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_addressbook_t1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_Company = new clsSorter($this->ComponentName, "Sorter_Company", $FileName, $this);
        $this->Sorter_InvoicePar = new clsSorter($this->ComponentName, "Sorter_InvoicePar", $FileName, $this);
        $this->Sorter_PL_H_ID = new clsSorter($this->ComponentName, "Sorter_PL_H_ID", $FileName, $this);
        $this->Sorter_PLNo = new clsSorter($this->ComponentName, "Sorter_PLNo", $FileName, $this);
        $this->Sorter_PLDate = new clsSorter($this->ComponentName, "Sorter_PLDate", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Page = "PackListOption.php";
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

//Show Method @2-696D9549
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_AddressID"] = CCGetFromGet("s_AddressID", NULL);
        $this->DataSource->Parameters["urls_PLDate"] = CCGetFromGet("s_PLDate", NULL);

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
            $this->ControlsVisible["Company"] = $this->Company->Visible;
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            $this->ControlsVisible["PL_H_ID"] = $this->PL_H_ID->Visible;
            $this->ControlsVisible["PLNo"] = $this->PLNo->Visible;
            $this->ControlsVisible["PLDate"] = $this->PLDate->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Company->SetValue($this->DataSource->Company->GetValue());
                $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
                $this->PL_H_ID->SetValue($this->DataSource->PL_H_ID->GetValue());
                $this->PL_H_ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->PL_H_ID->Parameters = CCAddParam($this->PL_H_ID->Parameters, "PL_H_ID", $this->DataSource->f("PL_H_ID"));
                $this->PL_H_ID->Parameters = CCAddParam($this->PL_H_ID->Parameters, "InvoiceContactID", $this->DataSource->f("InvoiceContactID"));
                $this->PL_H_ID->Parameters = CCAddParam($this->PL_H_ID->Parameters, "DeliveryContactID", $this->DataSource->f("DeliveryContactID"));
                $this->PLNo->SetValue($this->DataSource->PLNo->GetValue());
                $this->PLNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->PLNo->Parameters = CCAddParam($this->PLNo->Parameters, "PL_H_ID", $this->DataSource->f("PL_H_ID"));
                $this->PLNo->Parameters = CCAddParam($this->PLNo->Parameters, "InvoiceContactID", $this->DataSource->f("InvoiceContactID"));
                $this->PLNo->Parameters = CCAddParam($this->PLNo->Parameters, "DeliveryContactID", $this->DataSource->f("DeliveryContactID"));
                $this->PLNo->Parameters = CCAddParam($this->PLNo->Parameters, "Box_H_ID", $this->DataSource->f("Box_H_ID"));
                $this->PLDate->SetValue($this->DataSource->PLDate->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Company->Show();
                $this->InvoiceNo->Show();
                $this->PL_H_ID->Show();
                $this->PLNo->Show();
                $this->PLDate->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->tbladminist_addressbook_t1_TotalRecords->Show();
        $this->Sorter_Company->Show();
        $this->Sorter_InvoicePar->Show();
        $this->Sorter_PL_H_ID->Show();
        $this->Sorter_PLNo->Show();
        $this->Sorter_PLDate->Show();
        $this->Navigator->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-43AA3131
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Company->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PLNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->PLDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-D50F0D96
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Company;
    public $InvoiceNo;
    public $PL_H_ID;
    public $PLNo;
    public $PLDate;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6BA2C4F9
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->Company = new clsField("Company", ccsText, "");
        
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->PL_H_ID = new clsField("PL_H_ID", ccsInteger, "");
        
        $this->PLNo = new clsField("PLNo", ccsText, "");
        
        $this->PLDate = new clsField("PLDate", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-7E0F5A58
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Company" => array("Company", ""), 
            "Sorter_InvoicePar" => array("InvoicePar", ""), 
            "Sorter_PL_H_ID" => array("PL_H_ID", ""), 
            "Sorter_PLNo" => array("PLNo", ""), 
            "Sorter_PLDate" => array("PLDate", "")));
    }
//End SetOrder Method

//Prepare Method @2-D9BE2512
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_AddressID", ccsInteger, "", "", $this->Parameters["urls_AddressID"], "", false);
        $this->wp->AddParameter("2", "urls_PLDate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_PLDate"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_packinglist_h.AddressID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "tbladminist_packinglist_h.PLDate", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-3BDD046F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((tbladminist_packinglist_h INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_packinglist_h.AddressID = tbladminist_addressbook.AddressID) LEFT JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_packinglist_h.Invoice_H_ID = tbladminist_invoice_h.Invoice_H_ID) RIGHT JOIN tbladminist_box_h ON\n\n" .
        "tbladminist_box_h.PL_H_ID = tbladminist_packinglist_h.PL_H_ID";
        $this->SQL = "SELECT tbladminist_packinglist_h.PL_H_ID AS PL_H_ID, PLNo, PLDate, tbladminist_packinglist_h.InvoiceContactID AS InvoiceContactID,\n\n" .
        "tbladminist_packinglist_h.DeliveryContactID AS DeliveryContactID, Company, tbladminist_packinglist_h.AddressID AS AddressID,\n\n" .
        "InvoiceNo, tbladminist_invoice_h.Invoice_H_ID AS Invoice_H_ID, Box_H_ID \n\n" .
        "FROM ((tbladminist_packinglist_h INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_packinglist_h.AddressID = tbladminist_addressbook.AddressID) LEFT JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_packinglist_h.Invoice_H_ID = tbladminist_invoice_h.Invoice_H_ID) RIGHT JOIN tbladminist_box_h ON\n\n" .
        "tbladminist_box_h.PL_H_ID = tbladminist_packinglist_h.PL_H_ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-521143CD
    function SetValues()
    {
        $this->Company->SetDBValue($this->f("Company"));
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->PL_H_ID->SetDBValue(trim($this->f("PL_H_ID")));
        $this->PLNo->SetDBValue($this->f("PLNo"));
        $this->PLDate->SetDBValue(trim($this->f("PLDate")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsRecordSearch { //Search Class @19-39E8735D

//Variables @19-9E315808

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

//Class_Initialize Event @19-E5ED6163
    function clsRecordSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_AddressID = new clsControl(ccsTextBox, "s_AddressID", "s_AddressID", ccsInteger, "", CCGetRequestParam("s_AddressID", $Method, NULL), $this);
            $this->s_PLDate = new clsControl(ccsTextBox, "s_PLDate", "s_PLDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_PLDate", $Method, NULL), $this);
            $this->DatePicker_s_PLDate = new clsDatePicker("DatePicker_s_PLDate", "Search", "s_PLDate", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @19-C10021F2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_AddressID->Validate() && $Validation);
        $Validation = ($this->s_PLDate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_AddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_PLDate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @19-02B39AA9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_AddressID->Errors->Count());
        $errors = ($errors || $this->s_PLDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_PLDate->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @19-ED598703
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

//Operation Method @19-0F265CA0
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "PackingList.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "PackingList.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @19-5A53C1B1
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_PLDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_PLDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_AddressID->Show();
        $this->s_PLDate->Show();
        $this->DatePicker_s_PLDate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @19-FCB6E20C

//Initialize Page @1-0A47D223
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
$TemplateFileName = "PackingList.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-86BBE9F4
include_once("./PackingList_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-554D1A09
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->Search = & $Search;
$Grid->Initialize();

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

//Execute Components @1-34D1993E
$Search->Operation();
//End Execute Components

//Go to destination page @1-9D0437D3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4B5160C0
$Grid->Show();
$Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F8DFA0A3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($Search);
unset($Tpl);
//End Unload Page


?>
