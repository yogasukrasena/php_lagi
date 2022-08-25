<?php
//Include Common Files @1-39782653
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CostBudget.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridtblcosting_costbudgetprev { //tblcosting_costbudgetprev class @2-7AAFAAF1

//Variables @2-7AF19532

    // Public variables
    var $ComponentType = "Grid";
    var $ComponentName;
    var $Visible;
    var $Errors;
    var $ErrorBlock;
    var $ds;
    var $DataSource;
    var $PageSize;
    var $IsEmpty;
    var $ForceIteration = false;
    var $HasRecord = false;
    var $SorterName = "";
    var $SorterDirection = "";
    var $PageNumber;
    var $RowNumber;
    var $ControlsVisible = array();

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";
    var $Attributes;

    // Grid Controls
    var $StaticControls;
    var $RowControls;
    var $Sorter_ID;
    var $Sorter_BudgetYear;
    var $Sorter_CostBudgetAmmount;
//End Variables

//Class_Initialize Event @2-EA78A47A
    function clsGridtblcosting_costbudgetprev($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblcosting_costbudgetprev";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblcosting_costbudgetprev";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblcosting_costbudgetprevDataSource($this);
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
        $this->SorterName = CCGetParam("tblcosting_costbudgetprevOrder", "");
        $this->SorterDirection = CCGetParam("tblcosting_costbudgetprevDir", "");

        $this->ID = & new clsControl(ccsLink, "ID", "ID", ccsInteger, "", CCGetRequestParam("ID", ccsGet, NULL), $this);
        $this->ID->Page = "CostBudget.php";
        $this->BudgetYear = & new clsControl(ccsLabel, "BudgetYear", "BudgetYear", ccsInteger, "", CCGetRequestParam("BudgetYear", ccsGet, NULL), $this);
        $this->CostBudgetAmmount = & new clsControl(ccsLabel, "CostBudgetAmmount", "CostBudgetAmmount", ccsFloat, "", CCGetRequestParam("CostBudgetAmmount", ccsGet, NULL), $this);
        $this->Sorter_ID = & new clsSorter($this->ComponentName, "Sorter_ID", $FileName, $this);
        $this->Sorter_BudgetYear = & new clsSorter($this->ComponentName, "Sorter_BudgetYear", $FileName, $this);
        $this->Sorter_CostBudgetAmmount = & new clsSorter($this->ComponentName, "Sorter_CostBudgetAmmount", $FileName, $this);
        $this->Navigator = & new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-C8B1B919
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
            $this->ControlsVisible["BudgetYear"] = $this->BudgetYear->Visible;
            $this->ControlsVisible["CostBudgetAmmount"] = $this->CostBudgetAmmount->Visible;
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
                $this->BudgetYear->SetValue($this->DataSource->BudgetYear->GetValue());
                $this->CostBudgetAmmount->SetValue($this->DataSource->CostBudgetAmmount->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ID->Show();
                $this->BudgetYear->Show();
                $this->CostBudgetAmmount->Show();
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
        $this->Sorter_BudgetYear->Show();
        $this->Sorter_CostBudgetAmmount->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-D87CE8E8
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->BudgetYear->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CostBudgetAmmount->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblcosting_costbudgetprev Class @2-FCB6E20C

class clstblcosting_costbudgetprevDataSource extends clsDBGayaFusionAll {  //tblcosting_costbudgetprevDataSource Class @2-F61C23BB

//DataSource Variables @2-8D4EF604
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $CountSQL;
    var $wp;


    // Datasource fields
    var $ID;
    var $BudgetYear;
    var $CostBudgetAmmount;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-835408DD
    function clstblcosting_costbudgetprevDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblcosting_costbudgetprev";
        $this->Initialize();
        $this->ID = new clsField("ID", ccsInteger, "");
        
        $this->BudgetYear = new clsField("BudgetYear", ccsInteger, "");
        
        $this->CostBudgetAmmount = new clsField("CostBudgetAmmount", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-5B3173D3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ID" => array("ID", ""), 
            "Sorter_BudgetYear" => array("BudgetYear", ""), 
            "Sorter_CostBudgetAmmount" => array("CostBudgetAmmount", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-1C1B52DB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcosting_costbudgetpreview";
        $this->SQL = "SELECT ID, BudgetYear, CostBudgetAmmount \n\n" .
        "FROM tblcosting_costbudgetpreview {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-469DAC42
    function SetValues()
    {
        $this->ID->SetDBValue(trim($this->f("ID")));
        $this->BudgetYear->SetDBValue(trim($this->f("BudgetYear")));
        $this->CostBudgetAmmount->SetDBValue(trim($this->f("CostBudgetAmmount")));
    }
//End SetValues Method

} //End tblcosting_costbudgetprevDataSource Class @2-FCB6E20C

class clsRecordtblcosting_costbudgetprev1 { //tblcosting_costbudgetprev1 Class @15-58623572

//Variables @15-D6FF3E86

    // Public variables
    var $ComponentType = "Record";
    var $ComponentName;
    var $Parent;
    var $HTMLFormAction;
    var $PressedButton;
    var $Errors;
    var $ErrorBlock;
    var $FormSubmitted;
    var $FormEnctype;
    var $Visible;
    var $IsEmpty;

    var $CCSEvents = "";
    var $CCSEventResult;

    var $RelativePath = "";

    var $InsertAllowed = false;
    var $UpdateAllowed = false;
    var $DeleteAllowed = false;
    var $ReadAllowed   = false;
    var $EditMode      = false;
    var $ds;
    var $DataSource;
    var $ValidatingControls;
    var $Controls;
    var $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @15-458E7204
    function clsRecordtblcosting_costbudgetprev1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblcosting_costbudgetprev1/Error";
        $this->DataSource = new clstblcosting_costbudgetprev1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblcosting_costbudgetprev1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = & new clsButton("Button_Update", $Method, $this);
            $this->BudgetYear = & new clsControl(ccsTextBox, "BudgetYear", "Budget Year", ccsInteger, "", CCGetRequestParam("BudgetYear", $Method, NULL), $this);
            $this->CostBudgetAmmount = & new clsControl(ccsTextBox, "CostBudgetAmmount", "Cost Budget Ammount", ccsFloat, "", CCGetRequestParam("CostBudgetAmmount", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @15-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @15-FD28231E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->BudgetYear->Validate() && $Validation);
        $Validation = ($this->CostBudgetAmmount->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->BudgetYear->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CostBudgetAmmount->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @15-31120C6F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->BudgetYear->Errors->Count());
        $errors = ($errors || $this->CostBudgetAmmount->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @15-ED598703
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

//Operation Method @15-517B5C36
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

//UpdateRow Method @15-EEDC6D8C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->BudgetYear->SetValue($this->BudgetYear->GetValue(true));
        $this->DataSource->CostBudgetAmmount->SetValue($this->CostBudgetAmmount->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @15-C0BE807D
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
                    $this->BudgetYear->SetValue($this->DataSource->BudgetYear->GetValue());
                    $this->CostBudgetAmmount->SetValue($this->DataSource->CostBudgetAmmount->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->BudgetYear->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CostBudgetAmmount->Errors->ToString());
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
        $this->BudgetYear->Show();
        $this->CostBudgetAmmount->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblcosting_costbudgetprev1 Class @15-FCB6E20C

class clstblcosting_costbudgetprev1DataSource extends clsDBGayaFusionAll {  //tblcosting_costbudgetprev1DataSource Class @15-C043322C

//DataSource Variables @15-097D7D4F
    var $Parent = "";
    var $CCSEvents = "";
    var $CCSEventResult;
    var $ErrorBlock;
    var $CmdExecution;

    var $UpdateParameters;
    var $wp;
    var $AllParametersSet;

    var $UpdateFields = array();

    // Datasource fields
    var $BudgetYear;
    var $CostBudgetAmmount;
//End DataSource Variables

//DataSourceClass_Initialize Event @15-4E15495B
    function clstblcosting_costbudgetprev1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblcosting_costbudgetprev1/Error";
        $this->Initialize();
        $this->BudgetYear = new clsField("BudgetYear", ccsInteger, "");
        
        $this->CostBudgetAmmount = new clsField("CostBudgetAmmount", ccsFloat, "");
        

        $this->UpdateFields["BudgetYear"] = array("Name" => "BudgetYear", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CostBudgetAmmount"] = array("Name" => "CostBudgetAmmount", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @15-C6736E1B
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

//Open Method @15-630AD5CA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcosting_costbudgetpreview {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @15-49F5DDA5
    function SetValues()
    {
        $this->BudgetYear->SetDBValue(trim($this->f("BudgetYear")));
        $this->CostBudgetAmmount->SetDBValue(trim($this->f("CostBudgetAmmount")));
    }
//End SetValues Method

//Update Method @15-E839DF74
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["BudgetYear"]["Value"] = $this->BudgetYear->GetDBValue(true);
        $this->UpdateFields["CostBudgetAmmount"]["Value"] = $this->CostBudgetAmmount->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcosting_costbudgetpreview", $this->UpdateFields, $this);
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

} //End tblcosting_costbudgetprev1DataSource Class @15-FCB6E20C

//Initialize Page @1-B8B03B00
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
$TemplateFileName = "CostBudget.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7F11FB18
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcosting_costbudgetprev = & new clsGridtblcosting_costbudgetprev("", $MainPage);
$tblcosting_costbudgetprev1 = & new clsRecordtblcosting_costbudgetprev1("", $MainPage);
$MainPage->tblcosting_costbudgetprev = & $tblcosting_costbudgetprev;
$MainPage->tblcosting_costbudgetprev1 = & $tblcosting_costbudgetprev1;
$tblcosting_costbudgetprev->Initialize();
$tblcosting_costbudgetprev1->Initialize();

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

//Execute Components @1-749A4E78
$tblcosting_costbudgetprev1->Operation();
//End Execute Components

//Go to destination page @1-EF24429A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcosting_costbudgetprev);
    unset($tblcosting_costbudgetprev1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C5BE9F51
$tblcosting_costbudgetprev->Show();
$tblcosting_costbudgetprev1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-85DC223C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcosting_costbudgetprev);
unset($tblcosting_costbudgetprev1);
unset($Tpl);
//End Unload Page


?>
