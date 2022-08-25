<?php
//Include Common Files @1-197DD43A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddPol.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordAddNewHeader { //AddNewHeader Class @2-5850F9DE

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

//Class_Initialize Event @2-CD0A24F6
    function clsRecordAddNewHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->DataSource = new clsAddNewHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddNewHeader";
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
            $this->ClientID = new clsControl(ccsListBox, "ClientID", "Client ID", ccsInteger, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->ClientID->DSType = dsTable;
            $this->ClientID->DataSource = new clsDBGayaFusionAll();
            $this->ClientID->ds = & $this->ClientID->DataSource;
            $this->ClientID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->ClientID->BoundColumn, $this->ClientID->TextColumn, $this->ClientID->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->ClientOrderRef = new clsControl(ccsTextBox, "ClientOrderRef", "Client Order Ref", ccsText, "", CCGetRequestParam("ClientOrderRef", $Method, NULL), $this);
            $this->POLDate = new clsControl(ccsTextBox, "POLDate", "POLDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("POLDate", $Method, NULL), $this);
            $this->POLDate->Required = true;
            $this->DatePicker_POLDate = new clsDatePicker("DatePicker_POLDate", "AddNewHeader", "POLDate", $this);
            $this->DeliveryTimeID = new clsControl(ccsListBox, "DeliveryTimeID", "Delivery Time ID", ccsInteger, "", CCGetRequestParam("DeliveryTimeID", $Method, NULL), $this);
            $this->DeliveryTimeID->DSType = dsTable;
            $this->DeliveryTimeID->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryTimeID->ds = & $this->DeliveryTimeID->DataSource;
            $this->DeliveryTimeID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_deliverytime {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryTimeID->BoundColumn, $this->DeliveryTimeID->TextColumn, $this->DeliveryTimeID->DBFormat) = array("DeliveryTimeID", "DeliveryTime", "");
            $this->DeliveryTimeID->Required = true;
            $this->PolNo = new clsControl(ccsTextBox, "PolNo", "PolNo", ccsText, "", CCGetRequestParam("PolNo", $Method, NULL), $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-633DFB2B
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlPOL_H_ID"] = CCGetFromGet("POL_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-4FAB98CD
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->ClientOrderRef->Validate() && $Validation);
        $Validation = ($this->POLDate->Validate() && $Validation);
        $Validation = ($this->DeliveryTimeID->Validate() && $Validation);
        $Validation = ($this->PolNo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientOrderRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->POLDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTimeID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PolNo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D5882F66
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->POLDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_POLDate->Errors->Count());
        $errors = ($errors || $this->DeliveryTimeID->Errors->Count());
        $errors = ($errors || $this->PolNo->Errors->Count());
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

//Operation Method @2-210A67E3
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
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Delete") {
                if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
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

//InsertRow Method @2-A31B24AD
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->POLDate->SetValue($this->POLDate->GetValue(true));
        $this->DataSource->DeliveryTimeID->SetValue($this->DeliveryTimeID->GetValue(true));
        $this->DataSource->PolNo->SetValue($this->PolNo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-033979F8
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->POLDate->SetValue($this->POLDate->GetValue(true));
        $this->DataSource->DeliveryTimeID->SetValue($this->DeliveryTimeID->GetValue(true));
        $this->DataSource->PolNo->SetValue($this->PolNo->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-4C811836
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

        $this->ClientID->Prepare();
        $this->DeliveryTimeID->Prepare();

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
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                    $this->POLDate->SetValue($this->DataSource->POLDate->GetValue());
                    $this->DeliveryTimeID->SetValue($this->DataSource->DeliveryTimeID->GetValue());
                    $this->PolNo->SetValue($this->DataSource->PolNo->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->POLDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_POLDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTimeID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PolNo->Errors->ToString());
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
        $this->ClientID->Show();
        $this->ClientOrderRef->Show();
        $this->POLDate->Show();
        $this->DatePicker_POLDate->Show();
        $this->DeliveryTimeID->Show();
        $this->PolNo->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-C033E7A6
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
    public $ClientID;
    public $ClientOrderRef;
    public $POLDate;
    public $DeliveryTimeID;
    public $PolNo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-39B499AA
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->POLDate = new clsField("POLDate", ccsDate, $this->DateFormat);
        
        $this->DeliveryTimeID = new clsField("DeliveryTimeID", ccsInteger, "");
        
        $this->PolNo = new clsField("PolNo", ccsText, "");
        

        $this->InsertFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["POLDate"] = array("Name" => "POLDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["POLNo"] = array("Name" => "POLNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["POLDate"] = array("Name" => "POLDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["POLNo"] = array("Name" => "POLNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-93819182
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPOL_H_ID", ccsInteger, "", "", $this->Parameters["urlPOL_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "POL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-6EEF5EED
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT POL_H_ID, POLNo, ClientID, ClientOrderRef, POLDate, DeliveryTimeID \n\n" .
        "FROM tbladminist_pol_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B93A1871
    function SetValues()
    {
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->POLDate->SetDBValue(trim($this->f("POLDate")));
        $this->DeliveryTimeID->SetDBValue(trim($this->f("DeliveryTimeID")));
        $this->PolNo->SetDBValue($this->f("POLNo"));
    }
//End SetValues Method

//Insert Method @2-270B38B0
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->InsertFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->InsertFields["POLDate"]["Value"] = $this->POLDate->GetDBValue(true);
        $this->InsertFields["DeliveryTimeID"]["Value"] = $this->DeliveryTimeID->GetDBValue(true);
        $this->InsertFields["POLNo"]["Value"] = $this->PolNo->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_pol_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-CAE71DF7
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->UpdateFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->UpdateFields["POLDate"]["Value"] = $this->POLDate->GetDBValue(true);
        $this->UpdateFields["DeliveryTimeID"]["Value"] = $this->DeliveryTimeID->GetDBValue(true);
        $this->UpdateFields["POLNo"]["Value"] = $this->PolNo->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_pol_h", $this->UpdateFields, $this);
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

//Delete Method @2-B2DBD3F7
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_pol_h";
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

} //End AddNewHeaderDataSource Class @2-FCB6E20C

class clsEditableGridAddNewDetail { //AddNewDetail Class @11-254BF570

//Variables @11-F9538F3C

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @11-7D91685E
    function clsEditableGridAddNewDetail($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "AddNewDetail";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["POL_D_ID"][0] = "POL_D_ID";
        $this->DataSource = new clsAddNewDetailDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 30;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->POL_H_ID = new clsControl(ccsHidden, "POL_H_ID", "POL_H_ID", ccsInteger, "", NULL, $this);
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "Collect ID", ccsInteger, "", NULL, $this);
        $this->CollectID->Required = true;
        $this->Qty = new clsControl(ccsTextBox, "Qty", "Qty", ccsInteger, "", NULL, $this);
        $this->Qty->Required = true;
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->AddItemBtn = new clsButton("AddItemBtn", $Method, $this);
        $this->CollectPopup = new clsControl(ccsImageLink, "CollectPopup", "CollectPopup", ccsText, "", NULL, $this);
        $this->CollectPopup->Page = "Collect4Pol.php";
        $this->CollectCode = new clsControl(ccsTextBox, "CollectCode", "CollectCode", ccsText, "", NULL, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->Design = new clsControl(ccsTextBox, "Design", "Design", ccsText, "", NULL, $this);
        $this->NameDesc = new clsControl(ccsTextBox, "NameDesc", "NameDesc", ccsText, "", NULL, $this);
        $this->Category = new clsControl(ccsTextBox, "Category", "Category", ccsText, "", NULL, $this);
        $this->Size = new clsControl(ccsTextBox, "Size", "Size", ccsText, "", NULL, $this);
        $this->Texture = new clsControl(ccsTextBox, "Texture", "Texture", ccsText, "", NULL, $this);
        $this->Color = new clsControl(ccsTextBox, "Color", "Color", ccsText, "", NULL, $this);
        $this->Material = new clsControl(ccsTextBox, "Material", "Material", ccsText, "", NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @11-4E62C98C
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlPOL_H_ID"] = CCGetFromGet("POL_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @11-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @11-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @11-0D580E68
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["POL_H_ID"][$RowNumber] = CCGetFromPost("POL_H_ID_" . $RowNumber, NULL);
            $this->FormParameters["CollectID"][$RowNumber] = CCGetFromPost("CollectID_" . $RowNumber, NULL);
            $this->FormParameters["Qty"][$RowNumber] = CCGetFromPost("Qty_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["CollectCode"][$RowNumber] = CCGetFromPost("CollectCode_" . $RowNumber, NULL);
            $this->FormParameters["Design"][$RowNumber] = CCGetFromPost("Design_" . $RowNumber, NULL);
            $this->FormParameters["NameDesc"][$RowNumber] = CCGetFromPost("NameDesc_" . $RowNumber, NULL);
            $this->FormParameters["Category"][$RowNumber] = CCGetFromPost("Category_" . $RowNumber, NULL);
            $this->FormParameters["Size"][$RowNumber] = CCGetFromPost("Size_" . $RowNumber, NULL);
            $this->FormParameters["Texture"][$RowNumber] = CCGetFromPost("Texture_" . $RowNumber, NULL);
            $this->FormParameters["Color"][$RowNumber] = CCGetFromPost("Color_" . $RowNumber, NULL);
            $this->FormParameters["Material"][$RowNumber] = CCGetFromPost("Material_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @11-BC8F29D1
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["POL_D_ID"] = $this->CachedColumns["POL_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->POL_H_ID->SetText($this->FormParameters["POL_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @11-7DB6B6F4
    function ValidateRow()
    {
        global $CCSLocales;
        $this->POL_H_ID->Validate();
        $this->CollectID->Validate();
        $this->Qty->Validate();
        $this->CheckBox_Delete->Validate();
        $this->CollectCode->Validate();
        $this->Design->Validate();
        $this->NameDesc->Validate();
        $this->Category->Validate();
        $this->Size->Validate();
        $this->Texture->Validate();
        $this->Color->Validate();
        $this->Material->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->POL_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Design->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Color->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Material->Errors->ToString());
        $this->POL_H_ID->Errors->Clear();
        $this->CollectID->Errors->Clear();
        $this->Qty->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->CollectCode->Errors->Clear();
        $this->Design->Errors->Clear();
        $this->NameDesc->Errors->Clear();
        $this->Category->Errors->Clear();
        $this->Size->Errors->Clear();
        $this->Texture->Errors->Clear();
        $this->Color->Errors->Clear();
        $this->Material->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @11-0F299455
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["POL_H_ID"][$this->RowNumber]) && count($this->FormParameters["POL_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["POL_H_ID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectID"][$this->RowNumber]) && count($this->FormParameters["CollectID"][$this->RowNumber])) || strlen($this->FormParameters["CollectID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Qty"][$this->RowNumber]) && count($this->FormParameters["Qty"][$this->RowNumber])) || strlen($this->FormParameters["Qty"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectCode"][$this->RowNumber]) && count($this->FormParameters["CollectCode"][$this->RowNumber])) || strlen($this->FormParameters["CollectCode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Design"][$this->RowNumber]) && count($this->FormParameters["Design"][$this->RowNumber])) || strlen($this->FormParameters["Design"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["NameDesc"][$this->RowNumber]) && count($this->FormParameters["NameDesc"][$this->RowNumber])) || strlen($this->FormParameters["NameDesc"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Category"][$this->RowNumber]) && count($this->FormParameters["Category"][$this->RowNumber])) || strlen($this->FormParameters["Category"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Size"][$this->RowNumber]) && count($this->FormParameters["Size"][$this->RowNumber])) || strlen($this->FormParameters["Size"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Texture"][$this->RowNumber]) && count($this->FormParameters["Texture"][$this->RowNumber])) || strlen($this->FormParameters["Texture"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Color"][$this->RowNumber]) && count($this->FormParameters["Color"][$this->RowNumber])) || strlen($this->FormParameters["Color"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Material"][$this->RowNumber]) && count($this->FormParameters["Material"][$this->RowNumber])) || strlen($this->FormParameters["Material"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @11-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @11-442074AC
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->AddItemBtn->Pressed) {
            $this->PressedButton = "AddItemBtn";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = "POL.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "POL_H_ID"));
            }
        } else if($this->PressedButton == "AddItemBtn") {
            if(!CCGetEvent($this->AddItemBtn->CCSEvents, "OnClick", $this->AddItemBtn)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @11-D031A060
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["POL_D_ID"] = $this->CachedColumns["POL_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->POL_H_ID->SetText($this->FormParameters["POL_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @11-83AB53D8
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->POL_H_ID->SetValue($this->POL_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->CollectPopup->SetValue($this->CollectPopup->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Design->SetValue($this->Design->GetValue(true));
        $this->DataSource->NameDesc->SetValue($this->NameDesc->GetValue(true));
        $this->DataSource->Category->SetValue($this->Category->GetValue(true));
        $this->DataSource->Size->SetValue($this->Size->GetValue(true));
        $this->DataSource->Texture->SetValue($this->Texture->GetValue(true));
        $this->DataSource->Color->SetValue($this->Color->GetValue(true));
        $this->DataSource->Material->SetValue($this->Material->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @11-50D66376
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->POL_H_ID->SetValue($this->POL_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->CollectPopup->SetValue($this->CollectPopup->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Design->SetValue($this->Design->GetValue(true));
        $this->DataSource->NameDesc->SetValue($this->NameDesc->GetValue(true));
        $this->DataSource->Category->SetValue($this->Category->GetValue(true));
        $this->DataSource->Size->SetValue($this->Size->GetValue(true));
        $this->DataSource->Texture->SetValue($this->Texture->GetValue(true));
        $this->DataSource->Color->SetValue($this->Color->GetValue(true));
        $this->DataSource->Material->SetValue($this->Material->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @11-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @11-812D99EF
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var AddNewDetailElements;\n";
        $script .= "var AddNewDetailEmptyRows = 30;\n";
        $script .= "var " . $this->ComponentName . "POL_H_IDID = 0;\n";
        $script .= "var " . $this->ComponentName . "CollectIDID = 1;\n";
        $script .= "var " . $this->ComponentName . "QtyID = 2;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 3;\n";
        $script .= "var " . $this->ComponentName . "CollectCodeID = 4;\n";
        $script .= "var " . $this->ComponentName . "DesignID = 5;\n";
        $script .= "var " . $this->ComponentName . "NameDescID = 6;\n";
        $script .= "var " . $this->ComponentName . "CategoryID = 7;\n";
        $script .= "var " . $this->ComponentName . "SizeID = 8;\n";
        $script .= "var " . $this->ComponentName . "TextureID = 9;\n";
        $script .= "var " . $this->ComponentName . "ColorID = 10;\n";
        $script .= "var " . $this->ComponentName . "MaterialID = 11;\n";
        $script .= "\nfunction initAddNewDetailElements() {\n";
        $script .= "\tvar ED = document.forms[\"AddNewDetail\"];\n";
        $script .= "\tAddNewDetailElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.POL_H_ID_" . $i . ", " . "ED.CollectID_" . $i . ", " . "ED.Qty_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.CollectCode_" . $i . ", " . "ED.Design_" . $i . ", " . "ED.NameDesc_" . $i . ", " . "ED.Category_" . $i . ", " . "ED.Size_" . $i . ", " . "ED.Texture_" . $i . ", " . "ED.Color_" . $i . ", " . "ED.Material_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @11-514F238A
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["POL_D_ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["POL_D_ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @11-47BBACA5
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["POL_D_ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @11-E2AEEED3
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["POL_H_ID"] = $this->POL_H_ID->Visible;
        $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
        $this->ControlsVisible["Qty"] = $this->Qty->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["CollectPopup"] = $this->CollectPopup->Visible;
        $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["Design"] = $this->Design->Visible;
        $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
        $this->ControlsVisible["Category"] = $this->Category->Visible;
        $this->ControlsVisible["Size"] = $this->Size->Visible;
        $this->ControlsVisible["Texture"] = $this->Texture->Visible;
        $this->ControlsVisible["Color"] = $this->Color->Visible;
        $this->ControlsVisible["Material"] = $this->Material->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["POL_D_ID"][$this->RowNumber] = $this->DataSource->CachedColumns["POL_D_ID"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->CollectPopup->SetText("");
                    $this->CollectCode->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Design->SetText("");
                    $this->NameDesc->SetText("");
                    $this->Category->SetText("");
                    $this->Size->SetText("");
                    $this->Texture->SetText("");
                    $this->Color->SetText("");
                    $this->Material->SetText("");
                    $this->POL_H_ID->SetValue($this->DataSource->POL_H_ID->GetValue());
                    $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                    $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                    $this->CollectPopup->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "POL_H_ID", $this->DataSource->f("POL_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->POL_H_ID->SetText($this->FormParameters["POL_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "POL_H_ID", $this->DataSource->f("POL_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["POL_D_ID"][$this->RowNumber] = "";
                    $this->POL_H_ID->SetText("");
                    $this->CollectID->SetText("");
                    $this->Qty->SetText("");
                    $this->CollectPopup->SetText("");
                    $this->CollectCode->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Design->SetText("");
                    $this->NameDesc->SetText("");
                    $this->Category->SetText("");
                    $this->Size->SetText("");
                    $this->Texture->SetText("");
                    $this->Color->SetText("");
                    $this->Material->SetText("");
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "POL_H_ID", $this->DataSource->f("POL_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                } else {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->POL_H_ID->SetText($this->FormParameters["POL_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "POL_H_ID", $this->DataSource->f("POL_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->POL_H_ID->Show($this->RowNumber);
                $this->CollectID->Show($this->RowNumber);
                $this->Qty->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->CollectPopup->Show($this->RowNumber);
                $this->CollectCode->Show($this->RowNumber);
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->Design->Show($this->RowNumber);
                $this->NameDesc->Show($this->RowNumber);
                $this->Category->Show($this->RowNumber);
                $this->Size->Show($this->RowNumber);
                $this->Texture->Show($this->RowNumber);
                $this->Color->Show($this->RowNumber);
                $this->Material->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["POL_D_ID"] == $this->CachedColumns["POL_D_ID"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->AddItemBtn->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewDetail Class @11-FCB6E20C

class clsAddNewDetailDataSource extends clsDBGayaFusionAll {  //AddNewDetailDataSource Class @11-9729D968

//DataSource Variables @11-539DD433
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $POL_H_ID;
    public $CollectID;
    public $Qty;
    public $CheckBox_Delete;
    public $CollectPopup;
    public $CollectCode;
    public $RowIDAttribute;
    public $RowStyleAttribute;
    public $RowNameAttribute;
    public $Design;
    public $NameDesc;
    public $Category;
    public $Size;
    public $Texture;
    public $Color;
    public $Material;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-7D723937
    function clsAddNewDetailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->Initialize();
        $this->POL_H_ID = new clsField("POL_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->CollectPopup = new clsField("CollectPopup", ccsText, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->Design = new clsField("Design", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->Category = new clsField("Category", ccsText, "");
        
        $this->Size = new clsField("Size", ccsText, "");
        
        $this->Texture = new clsField("Texture", ccsText, "");
        
        $this->Color = new clsField("Color", ccsText, "");
        
        $this->Material = new clsField("Material", ccsText, "");
        

        $this->InsertFields["POL_H_ID"] = array("Name" => "POL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["POL_H_ID"] = array("Name" => "POL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @11-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @11-93819182
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlPOL_H_ID", ccsInteger, "", "", $this->Parameters["urlPOL_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "POL_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @11-0C2F4D44
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_pol_d";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_pol_d {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @11-BC96F8A2
    function SetValues()
    {
        $this->CachedColumns["POL_D_ID"] = $this->f("POL_D_ID");
        $this->POL_H_ID->SetDBValue(trim($this->f("POL_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
    }
//End SetValues Method

//Insert Method @11-BC73712F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["POL_H_ID"]["Value"] = $this->POL_H_ID->GetDBValue(true);
        $this->InsertFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->InsertFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_pol_d", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @11-E0CF8608
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "POL_D_ID=" . $this->ToSQL($this->CachedColumns["POL_D_ID"], ccsInteger);
        $this->UpdateFields["POL_H_ID"]["Value"] = $this->POL_H_ID->GetDBValue(true);
        $this->UpdateFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->UpdateFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_pol_d", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @11-89CE984C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "POL_D_ID=" . $this->ToSQL($this->CachedColumns["POL_D_ID"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_pol_d";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End AddNewDetailDataSource Class @11-FCB6E20C

//Initialize Page @1-C22FDBB3
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
$TemplateFileName = "AddPol.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-0EA9BEDA
include_once("./AddPol_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D7B2DEB3
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddNewHeader = new clsRecordAddNewHeader("", $MainPage);
$AddNewDetail = new clsEditableGridAddNewDetail("", $MainPage);
$MainPage->AddNewHeader = & $AddNewHeader;
$MainPage->AddNewDetail = & $AddNewDetail;
$AddNewHeader->Initialize();
$AddNewDetail->Initialize();

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

//Execute Components @1-5A7F0812
$AddNewHeader->Operation();
$AddNewDetail->Operation();
//End Execute Components

//Go to destination page @1-D72800B7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddNewHeader);
    unset($AddNewDetail);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D1073FE6
$AddNewHeader->Show();
$AddNewDetail->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-142ABB44
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddNewHeader);
unset($AddNewDetail);
unset($Tpl);
//End Unload Page


?>
