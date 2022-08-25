<?php
//Include Common Files @1-DED1B9B9
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Proforma.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearch { //Search Class @21-39E8735D

//Variables @21-9E315808

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

//Class_Initialize Event @21-CC8FDD16
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
            $this->s_ProformaNo = new clsControl(ccsTextBox, "s_ProformaNo", "s_ProformaNo", ccsText, "", CCGetRequestParam("s_ProformaNo", $Method, NULL), $this);
            $this->s_ClientCompany = new clsControl(ccsTextBox, "s_ClientCompany", "s_ClientCompany", ccsText, "", CCGetRequestParam("s_ClientCompany", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @21-F9804EB1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_ProformaNo->Validate() && $Validation);
        $Validation = ($this->s_ClientCompany->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_ProformaNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ClientCompany->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @21-DF580D61
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ProformaNo->Errors->Count());
        $errors = ($errors || $this->s_ClientCompany->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @21-ED598703
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

//Operation Method @21-BDD3C6BD
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
        $Redirect = "Proforma.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Proforma.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @21-2CCB22A6
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
            $Error = ComposeStrings($Error, $this->s_ProformaNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ClientCompany->Errors->ToString());
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
        $this->s_ProformaNo->Show();
        $this->s_ClientCompany->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @21-FCB6E20C

class clsGridGrid { //Grid class @2-76129994

//Variables @2-031637E7

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
    public $Sorter_Proforma_H_ID;
    public $Sorter_ProformaNo;
    public $Sorter_ClientCompany;
    public $Sorter_ProformaDate;
//End Variables

//Class_Initialize Event @2-0A771162
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

        $this->Proforma_H_ID = new clsControl(ccsLink, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->Proforma_H_ID->Page = "AddProforma.php";
        $this->ProformaNo = new clsControl(ccsLink, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->ProformaNo->Page = "ShowProforma.php";
        $this->Rev = new clsControl(ccsLabel, "Rev", "Rev", ccsText, "", CCGetRequestParam("Rev", ccsGet, NULL), $this);
        $this->ClientCompany = new clsControl(ccsLabel, "ClientCompany", "ClientCompany", ccsText, "", CCGetRequestParam("ClientCompany", ccsGet, NULL), $this);
        $this->ProformaDate = new clsControl(ccsLabel, "ProformaDate", "ProformaDate", ccsDate, $DefaultDateFormat, CCGetRequestParam("ProformaDate", ccsGet, NULL), $this);
        $this->LinkPOL = new clsControl(ccsLink, "LinkPOL", "LinkPOL", ccsText, "", CCGetRequestParam("LinkPOL", ccsGet, NULL), $this);
        $this->LinkPOL->Page = "";
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "AddInvoice.php";
        $this->lblQuotation = new clsControl(ccsLink, "lblQuotation", "lblQuotation", ccsText, "", CCGetRequestParam("lblQuotation", ccsGet, NULL), $this);
        $this->lblQuotation->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lblQuotation->Page = "";
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
        $this->lblInvoice = new clsControl(ccsLabel, "lblInvoice", "lblInvoice", ccsText, "", CCGetRequestParam("lblInvoice", ccsGet, NULL), $this);
        $this->tbladminist_client_tbladm1_Insert = new clsControl(ccsLink, "tbladminist_client_tbladm1_Insert", "tbladminist_client_tbladm1_Insert", ccsText, "", CCGetRequestParam("tbladminist_client_tbladm1_Insert", ccsGet, NULL), $this);
        $this->tbladminist_client_tbladm1_Insert->Parameters = CCGetQueryString("QueryString", array("Proforma_H_ID", "ccsForm"));
        $this->tbladminist_client_tbladm1_Insert->Page = "ProfOption.php";
        $this->tbladminist_client_tbladm1_TotalRecords = new clsControl(ccsLabel, "tbladminist_client_tbladm1_TotalRecords", "tbladminist_client_tbladm1_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_client_tbladm1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_Proforma_H_ID = new clsSorter($this->ComponentName, "Sorter_Proforma_H_ID", $FileName, $this);
        $this->Sorter_ProformaNo = new clsSorter($this->ComponentName, "Sorter_ProformaNo", $FileName, $this);
        $this->Sorter_ClientCompany = new clsSorter($this->ComponentName, "Sorter_ClientCompany", $FileName, $this);
        $this->Sorter_ProformaDate = new clsSorter($this->ComponentName, "Sorter_ProformaDate", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-834A647A
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_ProformaNo"] = CCGetFromGet("s_ProformaNo", NULL);
        $this->DataSource->Parameters["urls_ClientCompany"] = CCGetFromGet("s_ClientCompany", NULL);

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
            $this->ControlsVisible["ProformaNo"] = $this->ProformaNo->Visible;
            $this->ControlsVisible["Rev"] = $this->Rev->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["ProformaDate"] = $this->ProformaDate->Visible;
            $this->ControlsVisible["LinkPOL"] = $this->LinkPOL->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["lblQuotation"] = $this->lblQuotation->Visible;
            $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
            $this->ControlsVisible["lblInvoice"] = $this->lblInvoice->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->Proforma_H_ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Proforma_H_ID->Parameters = CCAddParam($this->Proforma_H_ID->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                $this->Proforma_H_ID->Parameters = CCAddParam($this->Proforma_H_ID->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Proforma_H_ID->Parameters = CCAddParam($this->Proforma_H_ID->Parameters, "ProformaContactID", $this->DataSource->f("ProformaContactID"));
                $this->Proforma_H_ID->Parameters = CCAddParam($this->Proforma_H_ID->Parameters, "DeliveryAddressID", $this->DataSource->f("DeliveryAddressID"));
                $this->Proforma_H_ID->Parameters = CCAddParam($this->Proforma_H_ID->Parameters, "DeliveryContactID", $this->DataSource->f("DeliveryContactID"));
                $this->ProformaNo->SetValue($this->DataSource->ProformaNo->GetValue());
                $this->ProformaNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ProformaNo->Parameters = CCAddParam($this->ProformaNo->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                $this->Rev->SetValue($this->DataSource->Rev->GetValue());
                $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
                $this->ProformaDate->SetValue($this->DataSource->ProformaDate->GetValue());
                $this->LinkPOL->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LinkPOL->Parameters = CCAddParam($this->LinkPOL->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
                $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Proforma_H_ID->Show();
                $this->ProformaNo->Show();
                $this->Rev->Show();
                $this->ClientCompany->Show();
                $this->ProformaDate->Show();
                $this->LinkPOL->Show();
                $this->Link1->Show();
                $this->lblQuotation->Show();
                $this->Quotation_H_ID->Show();
                $this->lblInvoice->Show();
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
        $this->tbladminist_client_tbladm1_Insert->Show();
        $this->tbladminist_client_tbladm1_TotalRecords->Show();
        $this->Sorter_Proforma_H_ID->Show();
        $this->Sorter_ProformaNo->Show();
        $this->Sorter_ClientCompany->Show();
        $this->Sorter_ProformaDate->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E05D9EBA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Rev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LinkPOL->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblQuotation->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblInvoice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-BF8EF1B6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Proforma_H_ID;
    public $ProformaNo;
    public $Rev;
    public $ClientCompany;
    public $ProformaDate;
    public $Quotation_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7FB6128C
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->ProformaNo = new clsField("ProformaNo", ccsText, "");
        
        $this->Rev = new clsField("Rev", ccsText, "");
        
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->ProformaDate = new clsField("ProformaDate", ccsDate, $this->DateFormat);
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0634C7EF
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tbladminist_proforma_h.Proforma_H_ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Proforma_H_ID" => array("Proforma_H_ID", ""), 
            "Sorter_ProformaNo" => array("ProformaNo", ""), 
            "Sorter_ClientCompany" => array("ClientCompany", ""), 
            "Sorter_ProformaDate" => array("ProformaDate", "")));
    }
//End SetOrder Method

//Prepare Method @2-4802CEE5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_ProformaNo", ccsText, "", "", $this->Parameters["urls_ProformaNo"], "", false);
        $this->wp->AddParameter("2", "urls_ClientCompany", ccsText, "", "", $this->Parameters["urls_ClientCompany"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tbladminist_proforma_h.ProformaNo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tbladminist_client.ClientCompany", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-709BD137
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_proforma_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_proforma_h.ClientID = tbladminist_client.ClientID";
        $this->SQL = "SELECT ClientCompany, tbladminist_proforma_h.* \n\n" .
        "FROM tbladminist_proforma_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_proforma_h.ClientID = tbladminist_client.ClientID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5D67C373
    function SetValues()
    {
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->ProformaNo->SetDBValue($this->f("ProformaNo"));
        $this->Rev->SetDBValue($this->f("Rev"));
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->ProformaDate->SetDBValue(trim($this->f("ProformaDate")));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C



//Initialize Page @1-85C5EC30
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
$TemplateFileName = "Proforma.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-FDD240EF
include_once("./Proforma_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D2FF37AB
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Search = & $Search;
$MainPage->Grid = & $Grid;
$Panel1->AddComponent("Search", $Search);
$Panel1->AddComponent("Grid", $Grid);
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

//Go to destination page @1-7EE673AE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Grid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D3C14256
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D2DCB2C5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Grid);
unset($Tpl);
//End Unload Page


?>
