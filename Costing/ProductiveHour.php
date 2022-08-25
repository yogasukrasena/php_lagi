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

//Include Common Files @1-F790ACB3
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ProductiveHour.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridtblcosting_productivehour { //tblcosting_productivehour class @2-DC7FF391

//Variables @2-FAD81DFC

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
    public $Sorter_ID;
    public $Sorter_Day;
    public $Sorter_Month;
    public $Sorter_Year;
//End Variables

//Class_Initialize Event @2-8F38DAAD
    function clsGridtblcosting_productivehour($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblcosting_productivehour";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblcosting_productivehour";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblcosting_productivehourDataSource($this);
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
        $this->SorterName = CCGetParam("tblcosting_productivehourOrder", "");
        $this->SorterDirection = CCGetParam("tblcosting_productivehourDir", "");

        $this->ID = new clsControl(ccsLink, "ID", "ID", ccsInteger, "", CCGetRequestParam("ID", ccsGet, NULL), $this);
        $this->ID->Page = "ProductiveHour.php";
        $this->Day = new clsControl(ccsLabel, "Day", "Day", ccsFloat, "", CCGetRequestParam("Day", ccsGet, NULL), $this);
        $this->Month = new clsControl(ccsLabel, "Month", "Month", ccsInteger, "", CCGetRequestParam("Month", ccsGet, NULL), $this);
        $this->Year = new clsControl(ccsLabel, "Year", "Year", ccsInteger, "", CCGetRequestParam("Year", ccsGet, NULL), $this);
        $this->Sorter_ID = new clsSorter($this->ComponentName, "Sorter_ID", $FileName, $this);
        $this->Sorter_Day = new clsSorter($this->ComponentName, "Sorter_Day", $FileName, $this);
        $this->Sorter_Month = new clsSorter($this->ComponentName, "Sorter_Month", $FileName, $this);
        $this->Sorter_Year = new clsSorter($this->ComponentName, "Sorter_Year", $FileName, $this);
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

//Show Method @2-FAF2AD7E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;


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
            $this->ControlsVisible["ID"] = $this->ID->Visible;
            $this->ControlsVisible["Day"] = $this->Day->Visible;
            $this->ControlsVisible["Month"] = $this->Month->Visible;
            $this->ControlsVisible["Year"] = $this->Year->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ID->SetValue($this->DataSource->ID->GetValue());
                $this->ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ID->Parameters = CCAddParam($this->ID->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Day->SetValue($this->DataSource->Day->GetValue());
                $this->Month->SetValue($this->DataSource->Month->GetValue());
                $this->Year->SetValue($this->DataSource->Year->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ID->Show();
                $this->Day->Show();
                $this->Month->Show();
                $this->Year->Show();
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
        $this->Sorter_ID->Show();
        $this->Sorter_Day->Show();
        $this->Sorter_Month->Show();
        $this->Sorter_Year->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-1F550FA8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Day->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Month->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Year->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblcosting_productivehour Class @2-FCB6E20C

class clstblcosting_productivehourDataSource extends clsDBGayaFusionAll {  //tblcosting_productivehourDataSource Class @2-0C21A320

//DataSource Variables @2-8A0478FC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $ID;
    public $Day;
    public $Month;
    public $Year;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EED591BE
    function clstblcosting_productivehourDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblcosting_productivehour";
        $this->Initialize();
        $this->ID = new clsField("ID", ccsInteger, "");
        
        $this->Day = new clsField("Day", ccsFloat, "");
        
        $this->Month = new clsField("Month", ccsInteger, "");
        
        $this->Year = new clsField("Year", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-76CEC8F4
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ID" => array("ID", ""), 
            "Sorter_Day" => array("Day", ""), 
            "Sorter_Month" => array("Month", ""), 
            "Sorter_Year" => array("Year", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-417785D3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcosting_productivehours";
        $this->SQL = "SELECT ID, Day, Month, Year \n\n" .
        "FROM tblcosting_productivehours {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-8EA461DF
    function SetValues()
    {
        $this->ID->SetDBValue(trim($this->f("ID")));
        $this->Day->SetDBValue(trim($this->f("Day")));
        $this->Month->SetDBValue(trim($this->f("Month")));
        $this->Year->SetDBValue(trim($this->f("Year")));
    }
//End SetValues Method

} //End tblcosting_productivehourDataSource Class @2-FCB6E20C

class clsRecordtblcosting_productivehour1 { //tblcosting_productivehour1 Class @18-15768473

//Variables @18-9E315808

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

//Class_Initialize Event @18-B0870393
    function clsRecordtblcosting_productivehour1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblcosting_productivehour1/Error";
        $this->DataSource = new clstblcosting_productivehour1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblcosting_productivehour1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Day = new clsControl(ccsTextBox, "Day", "Day", ccsFloat, "", CCGetRequestParam("Day", $Method, NULL), $this);
            $this->Month = new clsControl(ccsTextBox, "Month", "Month", ccsInteger, "", CCGetRequestParam("Month", $Method, NULL), $this);
            $this->Year = new clsControl(ccsTextBox, "Year", "Year", ccsInteger, "", CCGetRequestParam("Year", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @18-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @18-102A417D
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Day->Validate() && $Validation);
        $Validation = ($this->Month->Validate() && $Validation);
        $Validation = ($this->Year->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Day->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Month->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Year->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @18-5D6A3B55
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Day->Errors->Count());
        $errors = ($errors || $this->Month->Errors->Count());
        $errors = ($errors || $this->Year->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @18-ED598703
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

//Operation Method @18-9B2E077D
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

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateRow Method @18-F972BB39
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Day->SetValue($this->Day->GetValue(true));
        $this->DataSource->Month->SetValue($this->Month->GetValue(true));
        $this->DataSource->Year->SetValue($this->Year->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @18-66E68EB0
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
                if(!$this->FormSubmitted){
                    $this->Day->SetValue($this->DataSource->Day->GetValue());
                    $this->Month->SetValue($this->DataSource->Month->GetValue());
                    $this->Year->SetValue($this->DataSource->Year->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Day->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Month->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Year->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Day->Show();
        $this->Month->Show();
        $this->Year->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblcosting_productivehour1 Class @18-FCB6E20C

class clstblcosting_productivehour1DataSource extends clsDBGayaFusionAll {  //tblcosting_productivehour1DataSource Class @18-A7644560

//DataSource Variables @18-7C054D40
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $Day;
    public $Month;
    public $Year;
//End DataSource Variables

//DataSourceClass_Initialize Event @18-47AF4E4C
    function clstblcosting_productivehour1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblcosting_productivehour1/Error";
        $this->Initialize();
        $this->Day = new clsField("Day", ccsFloat, "");
        
        $this->Month = new clsField("Month", ccsInteger, "");
        
        $this->Year = new clsField("Year", ccsInteger, "");
        

        $this->UpdateFields["Day"] = array("Name" => "Day", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Month"] = array("Name" => "Month", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Year"] = array("Name" => "Year", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @18-C6736E1B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlID", ccsInteger, "", "", $this->Parameters["urlID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @18-A24B3441
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcosting_productivehours {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @18-49046BA6
    function SetValues()
    {
        $this->Day->SetDBValue(trim($this->f("Day")));
        $this->Month->SetDBValue(trim($this->f("Month")));
        $this->Year->SetDBValue(trim($this->f("Year")));
    }
//End SetValues Method

//Update Method @18-F50BBAF8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["Day"]["Value"] = $this->Day->GetDBValue(true);
        $this->UpdateFields["Month"]["Value"] = $this->Month->GetDBValue(true);
        $this->UpdateFields["Year"]["Value"] = $this->Year->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcosting_productivehours", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End tblcosting_productivehour1DataSource Class @18-FCB6E20C

//Initialize Page @1-1EC35B5A
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
$TemplateFileName = "ProductiveHour.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DBF14ED3
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcosting_productivehour = new clsGridtblcosting_productivehour("", $MainPage);
$tblcosting_productivehour1 = new clsRecordtblcosting_productivehour1("", $MainPage);
$MainPage->tblcosting_productivehour = & $tblcosting_productivehour;
$MainPage->tblcosting_productivehour1 = & $tblcosting_productivehour1;
$tblcosting_productivehour->Initialize();
$tblcosting_productivehour1->Initialize();

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

//Execute Components @1-332CB92F
$tblcosting_productivehour1->Operation();
//End Execute Components

//Go to destination page @1-98DC0E38
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcosting_productivehour);
    unset($tblcosting_productivehour1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-89CDF9F3
$tblcosting_productivehour->Show();
$tblcosting_productivehour1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B5999CAE
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcosting_productivehour);
unset($tblcosting_productivehour1);
unset($Tpl);
//End Unload Page


?>
