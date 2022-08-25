<?php
//Include Common Files @1-684F7F4F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "QuotChoose.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGridList { //GridList class @2-AF2A901A

//Variables @2-D0A0CA0A

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
    public $Sorter_Quotation_H_ID;
    public $Sorter_QuotationNo;
    public $Sorter_ClientCompany;
    public $Sorter_QuotationDate;
//End Variables

//Class_Initialize Event @2-D8EC38FC
    function clsGridGridList($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GridList";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GridList";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridListDataSource($this);
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
        $this->SorterName = CCGetParam("GridListOrder", "");
        $this->SorterDirection = CCGetParam("GridListDir", "");

        $this->Quotation_H_ID = new clsControl(ccsLink, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
        $this->Quotation_H_ID->Page = "";
        $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->ClientCompany = new clsControl(ccsLabel, "ClientCompany", "ClientCompany", ccsText, "", CCGetRequestParam("ClientCompany", ccsGet, NULL), $this);
        $this->QuotationDate = new clsControl(ccsLabel, "QuotationDate", "QuotationDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("QuotationDate", ccsGet, NULL), $this);
        $this->lblRev = new clsControl(ccsLabel, "lblRev", "lblRev", ccsText, "", CCGetRequestParam("lblRev", ccsGet, NULL), $this);
        $this->AddressID = new clsControl(ccsHidden, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", ccsGet, NULL), $this);
        $this->ContactID = new clsControl(ccsHidden, "ContactID", "ContactID", ccsInteger, "", CCGetRequestParam("ContactID", ccsGet, NULL), $this);
        $this->ClientID = new clsControl(ccsHidden, "ClientID", "ClientID", ccsInteger, "", CCGetRequestParam("ClientID", ccsGet, NULL), $this);
        $this->DeliveryAddressID = new clsControl(ccsHidden, "DeliveryAddressID", "DeliveryAddressID", ccsInteger, "", CCGetRequestParam("DeliveryAddressID", ccsGet, NULL), $this);
        $this->DeliveryContactID = new clsControl(ccsHidden, "DeliveryContactID", "DeliveryContactID", ccsInteger, "", CCGetRequestParam("DeliveryContactID", ccsGet, NULL), $this);
        $this->tbladminist_client_tbladm1_TotalRecords = new clsControl(ccsLabel, "tbladminist_client_tbladm1_TotalRecords", "tbladminist_client_tbladm1_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_client_tbladm1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_Quotation_H_ID = new clsSorter($this->ComponentName, "Sorter_Quotation_H_ID", $FileName, $this);
        $this->Sorter_QuotationNo = new clsSorter($this->ComponentName, "Sorter_QuotationNo", $FileName, $this);
        $this->Sorter_ClientCompany = new clsSorter($this->ComponentName, "Sorter_ClientCompany", $FileName, $this);
        $this->Sorter_QuotationDate = new clsSorter($this->ComponentName, "Sorter_QuotationDate", $FileName, $this);
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

//Show Method @2-7366E6FF
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_QuotationNo"] = CCGetFromGet("s_QuotationNo", NULL);
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
            $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
            $this->ControlsVisible["QuotationNo"] = $this->QuotationNo->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["QuotationDate"] = $this->QuotationDate->Visible;
            $this->ControlsVisible["lblRev"] = $this->lblRev->Visible;
            $this->ControlsVisible["AddressID"] = $this->AddressID->Visible;
            $this->ControlsVisible["ContactID"] = $this->ContactID->Visible;
            $this->ControlsVisible["ClientID"] = $this->ClientID->Visible;
            $this->ControlsVisible["DeliveryAddressID"] = $this->DeliveryAddressID->Visible;
            $this->ControlsVisible["DeliveryContactID"] = $this->DeliveryContactID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                $this->Quotation_H_ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "QuotationContactID", $this->DataSource->f("QuotationContactID"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "ClientID", $this->DataSource->f("tbladminist_quotation_h.ClientID"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "DeliveryAddressID", $this->DataSource->f("DeliveryAddressID"));
                $this->Quotation_H_ID->Parameters = CCAddParam($this->Quotation_H_ID->Parameters, "DeliveryContactID", $this->DataSource->f("DeliveryContactID"));
                $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
                $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
                $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
                $this->lblRev->SetValue($this->DataSource->lblRev->GetValue());
                $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                $this->ContactID->SetValue($this->DataSource->ContactID->GetValue());
                $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                $this->DeliveryAddressID->SetValue($this->DataSource->DeliveryAddressID->GetValue());
                $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Quotation_H_ID->Show();
                $this->QuotationNo->Show();
                $this->ClientCompany->Show();
                $this->QuotationDate->Show();
                $this->lblRev->Show();
                $this->AddressID->Show();
                $this->ContactID->Show();
                $this->ClientID->Show();
                $this->DeliveryAddressID->Show();
                $this->DeliveryContactID->Show();
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
        $this->tbladminist_client_tbladm1_TotalRecords->Show();
        $this->Sorter_Quotation_H_ID->Show();
        $this->Sorter_QuotationNo->Show();
        $this->Sorter_ClientCompany->Show();
        $this->Sorter_QuotationDate->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-7D089FEF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblRev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->AddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryAddressID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryContactID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GridList Class @2-FCB6E20C

class clsGridListDataSource extends clsDBGayaFusionAll {  //GridListDataSource Class @2-3BF17B41

//DataSource Variables @2-71727DB8
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Quotation_H_ID;
    public $QuotationNo;
    public $ClientCompany;
    public $QuotationDate;
    public $lblRev;
    public $AddressID;
    public $ContactID;
    public $ClientID;
    public $DeliveryAddressID;
    public $DeliveryContactID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6D82D3FB
    function clsGridListDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GridList";
        $this->Initialize();
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->lblRev = new clsField("lblRev", ccsText, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->ContactID = new clsField("ContactID", ccsInteger, "");
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->DeliveryAddressID = new clsField("DeliveryAddressID", ccsInteger, "");
        
        $this->DeliveryContactID = new clsField("DeliveryContactID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B2165857
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tbladminist_quotation_h.Quotation_H_ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_Quotation_H_ID" => array("Quotation_H_ID", ""), 
            "Sorter_QuotationNo" => array("QuotationNo", ""), 
            "Sorter_ClientCompany" => array("ClientCompany", ""), 
            "Sorter_QuotationDate" => array("QuotationDate", "")));
    }
//End SetOrder Method

//Prepare Method @2-427A61B7
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_QuotationNo", ccsText, "", "", $this->Parameters["urls_QuotationNo"], "", false);
        $this->wp->AddParameter("2", "urls_ClientCompany", ccsText, "", "", $this->Parameters["urls_ClientCompany"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tbladminist_quotation_h.QuotationNo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tbladminist_client.ClientCompany", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-A8CD6554
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_quotation_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_quotation_h.ClientID = tbladminist_client.ClientID";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_quotation_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_quotation_h.ClientID = tbladminist_client.ClientID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-945E5B8E
    function SetValues()
    {
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->QuotationDate->SetDBValue(trim($this->f("QuotationDate")));
        $this->lblRev->SetDBValue($this->f("Rev"));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->ContactID->SetDBValue(trim($this->f("QuotationContactID")));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->DeliveryAddressID->SetDBValue(trim($this->f("DeliveryAddressID")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
    }
//End SetValues Method

} //End GridListDataSource Class @2-FCB6E20C

class clsRecordSearch { //Search Class @8-39E8735D

//Variables @8-9E315808

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

//Class_Initialize Event @8-07273592
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
            $this->s_QuotationNo = new clsControl(ccsTextBox, "s_QuotationNo", "s_QuotationNo", ccsText, "", CCGetRequestParam("s_QuotationNo", $Method, NULL), $this);
            $this->s_ClientCompany = new clsControl(ccsTextBox, "s_ClientCompany", "s_ClientCompany", ccsText, "", CCGetRequestParam("s_ClientCompany", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @8-81AF24BE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_QuotationNo->Validate() && $Validation);
        $Validation = ($this->s_ClientCompany->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_QuotationNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ClientCompany->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @8-0DB6464F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_QuotationNo->Errors->Count());
        $errors = ($errors || $this->s_ClientCompany->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @8-ED598703
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

//Operation Method @8-41ED009F
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
        $Redirect = "QuotChoose.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "QuotChoose.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @8-9721F77F
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
            $Error = ComposeStrings($Error, $this->s_QuotationNo->Errors->ToString());
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
        $this->s_QuotationNo->Show();
        $this->s_ClientCompany->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @8-FCB6E20C



//Initialize Page @1-3AB704A3
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
$TemplateFileName = "QuotChoose.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3DF5B6C9
include_once("./QuotChoose_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CD53C97D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$GridList = new clsGridGridList("", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$MainPage->GridList = & $GridList;
$MainPage->Search = & $Search;
$GridList->Initialize();

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

//Go to destination page @1-097AE1D5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($GridList);
    unset($Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-74F605EA
$GridList->Show();
$Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9E96BB98
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($GridList);
unset($Search);
unset($Tpl);
//End Unload Page


?>
