<?php
//Include Common Files @1-10F3B621
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "POL.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-2F75301C

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
    public $Sorter_POL_H_ID;
    public $Sorter_POLNo;
    public $Sorter_Proforma_H_ID;
    public $Sorter_ClientID;
    public $Sorter_ClientOrderRef;
    public $Sorter_POLDate;
    public $Sorter_DeliveryTimeID;
//End Variables

//Class_Initialize Event @2-AAB09B3C
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

        $this->POL_H_ID = new clsControl(ccsLink, "POL_H_ID", "POL_H_ID", ccsInteger, "", CCGetRequestParam("POL_H_ID", ccsGet, NULL), $this);
        $this->POL_H_ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->POL_H_ID->Page = "";
        $this->POLNo = new clsControl(ccsLink, "POLNo", "POLNo", ccsText, "", CCGetRequestParam("POLNo", ccsGet, NULL), $this);
        $this->POLNo->Page = "";
        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", ccsGet, NULL), $this);
        $this->ProformaNo = new clsControl(ccsLink, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->ProformaNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ProformaNo->Page = "";
        $this->ProformaRef = new clsControl(ccsLabel, "ProformaRef", "ProformaRef", ccsText, "", CCGetRequestParam("ProformaRef", ccsGet, NULL), $this);
        $this->DeliveryTime = new clsControl(ccsLabel, "DeliveryTime", "DeliveryTime", ccsText, "", CCGetRequestParam("DeliveryTime", ccsGet, NULL), $this);
        $this->ClientCompany = new clsControl(ccsLabel, "ClientCompany", "ClientCompany", ccsText, "", CCGetRequestParam("ClientCompany", ccsGet, NULL), $this);
        $this->POLDate = new clsControl(ccsLabel, "POLDate", "POLDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("POLDate", ccsGet, NULL), $this);
        $this->tbladminist_pol_h_TotalRecords = new clsControl(ccsLabel, "tbladminist_pol_h_TotalRecords", "tbladminist_pol_h_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_pol_h_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_POL_H_ID = new clsSorter($this->ComponentName, "Sorter_POL_H_ID", $FileName, $this);
        $this->Sorter_POLNo = new clsSorter($this->ComponentName, "Sorter_POLNo", $FileName, $this);
        $this->Sorter_Proforma_H_ID = new clsSorter($this->ComponentName, "Sorter_Proforma_H_ID", $FileName, $this);
        $this->Sorter_ClientID = new clsSorter($this->ComponentName, "Sorter_ClientID", $FileName, $this);
        $this->Sorter_ClientOrderRef = new clsSorter($this->ComponentName, "Sorter_ClientOrderRef", $FileName, $this);
        $this->Sorter_POLDate = new clsSorter($this->ComponentName, "Sorter_POLDate", $FileName, $this);
        $this->Sorter_DeliveryTimeID = new clsSorter($this->ComponentName, "Sorter_DeliveryTimeID", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Page = "POLOption.php";
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

//Show Method @2-B8416490
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_POLNo"] = CCGetFromGet("s_POLNo", NULL);

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
            $this->ControlsVisible["POL_H_ID"] = $this->POL_H_ID->Visible;
            $this->ControlsVisible["POLNo"] = $this->POLNo->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            $this->ControlsVisible["ClientOrderRef"] = $this->ClientOrderRef->Visible;
            $this->ControlsVisible["ProformaNo"] = $this->ProformaNo->Visible;
            $this->ControlsVisible["ProformaRef"] = $this->ProformaRef->Visible;
            $this->ControlsVisible["DeliveryTime"] = $this->DeliveryTime->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["POLDate"] = $this->POLDate->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->POL_H_ID->SetValue($this->DataSource->POL_H_ID->GetValue());
                $this->POLNo->SetValue($this->DataSource->POLNo->GetValue());
                $this->POLNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->POLNo->Parameters = CCAddParam($this->POLNo->Parameters, "POL_H_ID", $this->DataSource->f("POL_H_ID"));
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->POLDate->SetValue($this->DataSource->POLDate->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->POL_H_ID->Show();
                $this->POLNo->Show();
                $this->Proforma_H_ID->Show();
                $this->ClientOrderRef->Show();
                $this->ProformaNo->Show();
                $this->ProformaRef->Show();
                $this->DeliveryTime->Show();
                $this->ClientCompany->Show();
                $this->POLDate->Show();
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
        $this->tbladminist_pol_h_TotalRecords->Show();
        $this->Sorter_POL_H_ID->Show();
        $this->Sorter_POLNo->Show();
        $this->Sorter_Proforma_H_ID->Show();
        $this->Sorter_ClientID->Show();
        $this->Sorter_ClientOrderRef->Show();
        $this->Sorter_POLDate->Show();
        $this->Sorter_DeliveryTimeID->Show();
        $this->Navigator->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-686B8887
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->POL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POLNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientOrderRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DeliveryTime->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->POLDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-9531B743
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $POL_H_ID;
    public $POLNo;
    public $Proforma_H_ID;
    public $POLDate;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-836C1607
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->POL_H_ID = new clsField("POL_H_ID", ccsInteger, "");
        
        $this->POLNo = new clsField("POLNo", ccsText, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->POLDate = new clsField("POLDate", ccsDate, $this->DateFormat);
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-75D7FDC1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "POL_H_ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_POL_H_ID" => array("POL_H_ID", ""), 
            "Sorter_POLNo" => array("POLNo", ""), 
            "Sorter_Proforma_H_ID" => array("Proforma_H_ID", ""), 
            "Sorter_ClientID" => array("ClientID", ""), 
            "Sorter_ClientOrderRef" => array("ClientOrderRef", ""), 
            "Sorter_POLDate" => array("POLDate", ""), 
            "Sorter_DeliveryTimeID" => array("DeliveryTimeID", "")));
    }
//End SetOrder Method

//Prepare Method @2-702AB570
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_POLNo", ccsText, "", "", $this->Parameters["urls_POLNo"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "POLNo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-C202ECFE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_pol_h";
        $this->SQL = "SELECT POL_H_ID, POLNo, Proforma_H_ID, POLDate \n\n" .
        "FROM tbladminist_pol_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-A4B88612
    function SetValues()
    {
        $this->POL_H_ID->SetDBValue(trim($this->f("POL_H_ID")));
        $this->POLNo->SetDBValue($this->f("POLNo"));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->POLDate->SetDBValue(trim($this->f("POLDate")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsRecordtbladminist_pol_hSearch { //tbladminist_pol_hSearch Class @3-BF1F7020

//Variables @3-9E315808

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

//Class_Initialize Event @3-3884FCB8
    function clsRecordtbladminist_pol_hSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbladminist_pol_hSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbladminist_pol_hSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_POLNo = new clsControl(ccsTextBox, "s_POLNo", "s_POLNo", ccsText, "", CCGetRequestParam("s_POLNo", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-34A11BA1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_POLNo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_POLNo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-1BE8E5D5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_POLNo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-4A5CBFB0
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
        $Redirect = "POL.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "POL.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-26FC22FA
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
            $Error = ComposeStrings($Error, $this->s_POLNo->Errors->ToString());
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
        $this->s_POLNo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbladminist_pol_hSearch Class @3-FCB6E20C

//Initialize Page @1-F7BF1631
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
$TemplateFileName = "POL.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-8F79F3F2
include_once("./POL_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AA07FCC5
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$tbladminist_pol_hSearch = new clsRecordtbladminist_pol_hSearch("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->tbladminist_pol_hSearch = & $tbladminist_pol_hSearch;
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

//Execute Components @1-0FD1A195
$tbladminist_pol_hSearch->Operation();
//End Execute Components

//Go to destination page @1-22995E47
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($tbladminist_pol_hSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4F7FAC9D
$Grid->Show();
$tbladminist_pol_hSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-7A0676CA
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($tbladminist_pol_hSearch);
unset($Tpl);
//End Unload Page


?>
