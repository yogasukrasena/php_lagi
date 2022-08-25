<?php
//Include Common Files @1-524FA4A7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddCurrency.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-D79C8C62

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
    public $Sorter_CurrencyID;
    public $Sorter_CurrencyCode;
    public $Sorter_Currency;
    public $Sorter_Rate;
//End Variables

//Class_Initialize Event @2-3DD4C8E9
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

        $this->CurrencyID = new clsControl(ccsLink, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", ccsGet, NULL), $this);
        $this->CurrencyID->Page = "AddCurrency.php";
        $this->CurrencyCode = new clsControl(ccsLabel, "CurrencyCode", "CurrencyCode", ccsText, "", CCGetRequestParam("CurrencyCode", ccsGet, NULL), $this);
        $this->Currency = new clsControl(ccsLabel, "Currency", "Currency", ccsText, "", CCGetRequestParam("Currency", ccsGet, NULL), $this);
        $this->Rate = new clsControl(ccsLabel, "Rate", "Rate", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Rate", ccsGet, NULL), $this);
        $this->tbladminist_currency_Insert = new clsControl(ccsLink, "tbladminist_currency_Insert", "tbladminist_currency_Insert", ccsText, "", CCGetRequestParam("tbladminist_currency_Insert", ccsGet, NULL), $this);
        $this->tbladminist_currency_Insert->Parameters = CCGetQueryString("QueryString", array("CurrencyID", "ccsForm"));
        $this->tbladminist_currency_Insert->Page = "AddCurrency.php";
        $this->tbladminist_currency_TotalRecords = new clsControl(ccsLabel, "tbladminist_currency_TotalRecords", "tbladminist_currency_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_currency_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_CurrencyID = new clsSorter($this->ComponentName, "Sorter_CurrencyID", $FileName, $this);
        $this->Sorter_CurrencyCode = new clsSorter($this->ComponentName, "Sorter_CurrencyCode", $FileName, $this);
        $this->Sorter_Currency = new clsSorter($this->ComponentName, "Sorter_Currency", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Sorter_Rate = new clsSorter($this->ComponentName, "Sorter_Rate", $FileName, $this);
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

//Show Method @2-86552163
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
            $this->ControlsVisible["CurrencyID"] = $this->CurrencyID->Visible;
            $this->ControlsVisible["CurrencyCode"] = $this->CurrencyCode->Visible;
            $this->ControlsVisible["Currency"] = $this->Currency->Visible;
            $this->ControlsVisible["Rate"] = $this->Rate->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
                $this->CurrencyID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->CurrencyID->Parameters = CCAddParam($this->CurrencyID->Parameters, "CurrencyID", $this->DataSource->f("CurrencyID"));
                $this->CurrencyCode->SetValue($this->DataSource->CurrencyCode->GetValue());
                $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                $this->Rate->SetValue($this->DataSource->Rate->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->CurrencyID->Show();
                $this->CurrencyCode->Show();
                $this->Currency->Show();
                $this->Rate->Show();
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
        $this->tbladminist_currency_Insert->Show();
        $this->tbladminist_currency_TotalRecords->Show();
        $this->Sorter_CurrencyID->Show();
        $this->Sorter_CurrencyCode->Show();
        $this->Sorter_Currency->Show();
        $this->Navigator->Show();
        $this->Sorter_Rate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-8ED020BF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->CurrencyID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CurrencyCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Currency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Rate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-BF9F5243
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $CurrencyID;
    public $CurrencyCode;
    public $Currency;
    public $Rate;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-ECF1AD32
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        
        $this->CurrencyCode = new clsField("CurrencyCode", ccsText, "");
        
        $this->Currency = new clsField("Currency", ccsText, "");
        
        $this->Rate = new clsField("Rate", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4B09B7BD
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_CurrencyID" => array("CurrencyID", ""), 
            "Sorter_CurrencyCode" => array("CurrencyCode", ""), 
            "Sorter_Currency" => array("Currency", ""), 
            "Sorter_Rate" => array("Rate", "")));
    }
//End SetOrder Method

//Prepare Method @2-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @2-9FA66C8E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_currency";
        $this->SQL = "SELECT CurrencyID, CurrencyCode, Currency, Rate \n\n" .
        "FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-BC5358FC
    function SetValues()
    {
        $this->CurrencyID->SetDBValue(trim($this->f("CurrencyID")));
        $this->CurrencyCode->SetDBValue($this->f("CurrencyCode"));
        $this->Currency->SetDBValue($this->f("Currency"));
        $this->Rate->SetDBValue(trim($this->f("Rate")));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsRecordAdd { //Add Class @17-6BEB52A8

//Variables @17-9E315808

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

//Class_Initialize Event @17-BE85DCFF
    function clsRecordAdd($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Add/Error";
        $this->DataSource = new clsAddDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Add";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->CurrencyCode = new clsControl(ccsTextBox, "CurrencyCode", "Currency Code", ccsText, "", CCGetRequestParam("CurrencyCode", $Method, NULL), $this);
            $this->CurrencyCode->Required = true;
            $this->Currency = new clsControl(ccsTextBox, "Currency", "Currency", ccsText, "", CCGetRequestParam("Currency", $Method, NULL), $this);
            $this->Currency->Required = true;
            $this->Rate = new clsControl(ccsTextBox, "Rate", "Rate", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Rate", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @17-6CF60DE1
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlCurrencyID"] = CCGetFromGet("CurrencyID", NULL);
    }
//End Initialize Method

//Validate Method @17-04F80C32
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->CurrencyCode->Validate() && $Validation);
        $Validation = ($this->Currency->Validate() && $Validation);
        $Validation = ($this->Rate->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->CurrencyCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Currency->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Rate->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @17-03FB68EA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CurrencyCode->Errors->Count());
        $errors = ($errors || $this->Currency->Errors->Count());
        $errors = ($errors || $this->Rate->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @17-ED598703
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

//Operation Method @17-45F9B075
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "CurrencyID"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "CurrencyID"));
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

//InsertRow Method @17-8A900902
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->CurrencyCode->SetValue($this->CurrencyCode->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->Rate->SetValue($this->Rate->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @17-735CD49D
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->CurrencyCode->SetValue($this->CurrencyCode->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->Rate->SetValue($this->Rate->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @17-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @17-5730214A
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
                    $this->CurrencyCode->SetValue($this->DataSource->CurrencyCode->GetValue());
                    $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                    $this->Rate->SetValue($this->DataSource->Rate->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CurrencyCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Currency->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Rate->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->CurrencyCode->Show();
        $this->Currency->Show();
        $this->Rate->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Add Class @17-FCB6E20C

class clsAddDataSource extends clsDBGayaFusionAll {  //AddDataSource Class @17-1F150DA3

//DataSource Variables @17-8EBDCB3B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $CurrencyCode;
    public $Currency;
    public $Rate;
//End DataSource Variables

//DataSourceClass_Initialize Event @17-671CAA1C
    function clsAddDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Add/Error";
        $this->Initialize();
        $this->CurrencyCode = new clsField("CurrencyCode", ccsText, "");
        
        $this->Currency = new clsField("Currency", ccsText, "");
        
        $this->Rate = new clsField("Rate", ccsFloat, "");
        

        $this->InsertFields["CurrencyCode"] = array("Name" => "CurrencyCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Rate"] = array("Name" => "Rate", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CurrencyCode"] = array("Name" => "CurrencyCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Rate"] = array("Name" => "Rate", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @17-AD0022C8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlCurrencyID", ccsInteger, "", "", $this->Parameters["urlCurrencyID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "CurrencyID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @17-CAE8370D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @17-7075C9C2
    function SetValues()
    {
        $this->CurrencyCode->SetDBValue($this->f("CurrencyCode"));
        $this->Currency->SetDBValue($this->f("Currency"));
        $this->Rate->SetDBValue(trim($this->f("Rate")));
    }
//End SetValues Method

//Insert Method @17-04646724
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["CurrencyCode"]["Value"] = $this->CurrencyCode->GetDBValue(true);
        $this->InsertFields["Currency"]["Value"] = $this->Currency->GetDBValue(true);
        $this->InsertFields["Rate"]["Value"] = $this->Rate->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_currency", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @17-41D6265F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["CurrencyCode"]["Value"] = $this->CurrencyCode->GetDBValue(true);
        $this->UpdateFields["Currency"]["Value"] = $this->Currency->GetDBValue(true);
        $this->UpdateFields["Rate"]["Value"] = $this->Rate->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_currency", $this->UpdateFields, $this);
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

//Delete Method @17-A11286B7
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_currency";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End AddDataSource Class @17-FCB6E20C

//Initialize Page @1-D8D69F75
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
$TemplateFileName = "AddCurrency.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-294826DA
include_once("./AddCurrency_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5ECBE052
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$Add = new clsRecordAdd("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Grid = & $Grid;
$MainPage->Add = & $Add;
$Panel1->AddComponent("Grid", $Grid);
$Panel1->AddComponent("Add", $Add);
$Grid->Initialize();
$Add->Initialize();

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

//Execute Components @1-347D53F1
$Add->Operation();
//End Execute Components

//Go to destination page @1-A3ACF530
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($Add);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A554F9CE
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E9C3FB88
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($Add);
unset($Tpl);
//End Unload Page


?>
