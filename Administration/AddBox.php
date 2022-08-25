<?php
//Include Common Files @1-75CB7D05
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddBox.php");
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

//Class_Initialize Event @2-50B62F85
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
            $this->Height = new clsControl(ccsTextBox, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", $Method, NULL), $this);
            $this->Weight = new clsControl(ccsTextBox, "Weight", "Weight", ccsFloat, "", CCGetRequestParam("Weight", $Method, NULL), $this);
            $this->Length = new clsControl(ccsTextBox, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", $Method, NULL), $this);
            $this->Width = new clsControl(ccsTextBox, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", $Method, NULL), $this);
            $this->PL_H_ID = new clsControl(ccsHidden, "PL_H_ID", "PL_H_ID", ccsInteger, "", CCGetRequestParam("PL_H_ID", $Method, NULL), $this);
            $this->BoxNumber = new clsControl(ccsTextBox, "BoxNumber", "BoxNumber", ccsInteger, "", CCGetRequestParam("BoxNumber", $Method, NULL), $this);
            $this->Box_H_ID = new clsControl(ccsHidden, "Box_H_ID", "Box_H_ID", ccsInteger, "", CCGetRequestParam("Box_H_ID", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D8BB1A01
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlBox_H_ID"] = CCGetFromGet("Box_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-78EA6DBB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->Height->Validate() && $Validation);
        $Validation = ($this->Weight->Validate() && $Validation);
        $Validation = ($this->Length->Validate() && $Validation);
        $Validation = ($this->Width->Validate() && $Validation);
        $Validation = ($this->PL_H_ID->Validate() && $Validation);
        $Validation = ($this->BoxNumber->Validate() && $Validation);
        $Validation = ($this->Box_H_ID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->Height->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Weight->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Length->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Width->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PL_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->BoxNumber->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Box_H_ID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-24D278B5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Height->Errors->Count());
        $errors = ($errors || $this->Weight->Errors->Count());
        $errors = ($errors || $this->Length->Errors->Count());
        $errors = ($errors || $this->Width->Errors->Count());
        $errors = ($errors || $this->PL_H_ID->Errors->Count());
        $errors = ($errors || $this->BoxNumber->Errors->Count());
        $errors = ($errors || $this->Box_H_ID->Errors->Count());
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

//Operation Method @2-827FD201
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "AddBox.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-21C1C10C
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Weight->SetValue($this->Weight->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->PL_H_ID->SetValue($this->PL_H_ID->GetValue(true));
        $this->DataSource->BoxNumber->SetValue($this->BoxNumber->GetValue(true));
        $this->DataSource->Box_H_ID->SetValue($this->Box_H_ID->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-FDC27698
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Height->SetValue($this->Height->GetValue(true));
        $this->DataSource->Weight->SetValue($this->Weight->GetValue(true));
        $this->DataSource->Length->SetValue($this->Length->GetValue(true));
        $this->DataSource->Width->SetValue($this->Width->GetValue(true));
        $this->DataSource->PL_H_ID->SetValue($this->PL_H_ID->GetValue(true));
        $this->DataSource->BoxNumber->SetValue($this->BoxNumber->GetValue(true));
        $this->DataSource->Box_H_ID->SetValue($this->Box_H_ID->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-5E21945B
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
                    $this->Height->SetValue($this->DataSource->Height->GetValue());
                    $this->Weight->SetValue($this->DataSource->Weight->GetValue());
                    $this->Length->SetValue($this->DataSource->Length->GetValue());
                    $this->Width->SetValue($this->DataSource->Width->GetValue());
                    $this->PL_H_ID->SetValue($this->DataSource->PL_H_ID->GetValue());
                    $this->BoxNumber->SetValue($this->DataSource->BoxNumber->GetValue());
                    $this->Box_H_ID->SetValue($this->DataSource->Box_H_ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->Height->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Weight->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Length->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Width->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PL_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->BoxNumber->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Box_H_ID->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Height->Show();
        $this->Weight->Show();
        $this->Length->Show();
        $this->Width->Show();
        $this->PL_H_ID->Show();
        $this->BoxNumber->Show();
        $this->Box_H_ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-AECF98E0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $Height;
    public $Weight;
    public $Length;
    public $Width;
    public $PL_H_ID;
    public $BoxNumber;
    public $Box_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F8E24245
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Weight = new clsField("Weight", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->PL_H_ID = new clsField("PL_H_ID", ccsInteger, "");
        
        $this->BoxNumber = new clsField("BoxNumber", ccsInteger, "");
        
        $this->Box_H_ID = new clsField("Box_H_ID", ccsInteger, "");
        

        $this->InsertFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["PL_H_ID"] = array("Name" => "PL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["BoxNumber"] = array("Name" => "BoxNumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Box_H_ID"] = array("Name" => "Box_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Height"] = array("Name" => "Height", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Weight"] = array("Name" => "Weight", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Length"] = array("Name" => "Length", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Width"] = array("Name" => "Width", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["PL_H_ID"] = array("Name" => "PL_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["BoxNumber"] = array("Name" => "BoxNumber", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Box_H_ID"] = array("Name" => "Box_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-DE88D80C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlBox_H_ID", ccsInteger, "", "", $this->Parameters["urlBox_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Box_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-8DB0E5CB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_box_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DDDEB137
    function SetValues()
    {
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Weight->SetDBValue(trim($this->f("Weight")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->PL_H_ID->SetDBValue(trim($this->f("PL_H_ID")));
        $this->BoxNumber->SetDBValue(trim($this->f("BoxNumber")));
        $this->Box_H_ID->SetDBValue(trim($this->f("Box_H_ID")));
    }
//End SetValues Method

//Insert Method @2-E7CDD7D8
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->InsertFields["Weight"]["Value"] = $this->Weight->GetDBValue(true);
        $this->InsertFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->InsertFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->InsertFields["PL_H_ID"]["Value"] = $this->PL_H_ID->GetDBValue(true);
        $this->InsertFields["BoxNumber"]["Value"] = $this->BoxNumber->GetDBValue(true);
        $this->InsertFields["Box_H_ID"]["Value"] = $this->Box_H_ID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_box_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-5FB28814
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["Height"]["Value"] = $this->Height->GetDBValue(true);
        $this->UpdateFields["Weight"]["Value"] = $this->Weight->GetDBValue(true);
        $this->UpdateFields["Length"]["Value"] = $this->Length->GetDBValue(true);
        $this->UpdateFields["Width"]["Value"] = $this->Width->GetDBValue(true);
        $this->UpdateFields["PL_H_ID"]["Value"] = $this->PL_H_ID->GetDBValue(true);
        $this->UpdateFields["BoxNumber"]["Value"] = $this->BoxNumber->GetDBValue(true);
        $this->UpdateFields["Box_H_ID"]["Value"] = $this->Box_H_ID->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_box_h", $this->UpdateFields, $this);
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

} //End AddNewHeaderDataSource Class @2-FCB6E20C

class clsEditableGridAddNewDetail { //AddNewDetail Class @51-254BF570

//Variables @51-F9538F3C

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

//Class_Initialize Event @51-25B955AF
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
        $this->CachedColumns["Box_D_ID"][0] = "Box_D_ID";
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

        $this->EmptyRows = 31;
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

        $this->Box_H_ID = new clsControl(ccsHidden, "Box_H_ID", "Box_H_ID", ccsInteger, "", NULL, $this);
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "Collect ID", ccsInteger, "", NULL, $this);
        $this->CollectID->Required = true;
        $this->Qty = new clsControl(ccsTextBox, "Qty", "Qty", ccsInteger, "", NULL, $this);
        $this->Qty->Required = true;
        $this->Unit = new clsControl(ccsTextBox, "Unit", "Unit", ccsText, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->AddItemBtn = new clsButton("AddItemBtn", $Method, $this);
        $this->CollectPopup = new clsControl(ccsImageLink, "CollectPopup", "CollectPopup", ccsText, "", NULL, $this);
        $this->CollectPopup->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->CollectPopup->Page = "BoxPopup.php";
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
        $this->Remarks = new clsControl(ccsTextArea, "Remarks", "Remarks", ccsMemo, "", NULL, $this);
        $this->UnitPrice = new clsControl(ccsHidden, "UnitPrice", "UnitPrice", ccsFloat, "", NULL, $this);
        $this->Insert = new clsButton("Insert", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @51-F5E428A6
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlBox_H_ID"] = CCGetFromGet("Box_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @51-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @51-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @51-85F36660
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["Box_H_ID"][$RowNumber] = CCGetFromPost("Box_H_ID_" . $RowNumber, NULL);
            $this->FormParameters["CollectID"][$RowNumber] = CCGetFromPost("CollectID_" . $RowNumber, NULL);
            $this->FormParameters["Qty"][$RowNumber] = CCGetFromPost("Qty_" . $RowNumber, NULL);
            $this->FormParameters["Unit"][$RowNumber] = CCGetFromPost("Unit_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["CollectCode"][$RowNumber] = CCGetFromPost("CollectCode_" . $RowNumber, NULL);
            $this->FormParameters["Design"][$RowNumber] = CCGetFromPost("Design_" . $RowNumber, NULL);
            $this->FormParameters["NameDesc"][$RowNumber] = CCGetFromPost("NameDesc_" . $RowNumber, NULL);
            $this->FormParameters["Category"][$RowNumber] = CCGetFromPost("Category_" . $RowNumber, NULL);
            $this->FormParameters["Size"][$RowNumber] = CCGetFromPost("Size_" . $RowNumber, NULL);
            $this->FormParameters["Texture"][$RowNumber] = CCGetFromPost("Texture_" . $RowNumber, NULL);
            $this->FormParameters["Color"][$RowNumber] = CCGetFromPost("Color_" . $RowNumber, NULL);
            $this->FormParameters["Material"][$RowNumber] = CCGetFromPost("Material_" . $RowNumber, NULL);
            $this->FormParameters["Remarks"][$RowNumber] = CCGetFromPost("Remarks_" . $RowNumber, NULL);
            $this->FormParameters["UnitPrice"][$RowNumber] = CCGetFromPost("UnitPrice_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @51-C6F03FC5
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Box_D_ID"] = $this->CachedColumns["Box_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Box_H_ID->SetText($this->FormParameters["Box_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            $this->Remarks->SetText($this->FormParameters["Remarks"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @51-C3F3E886
    function ValidateRow()
    {
        global $CCSLocales;
        $this->Box_H_ID->Validate();
        $this->CollectID->Validate();
        $this->Qty->Validate();
        $this->Unit->Validate();
        $this->CheckBox_Delete->Validate();
        $this->CollectCode->Validate();
        $this->Design->Validate();
        $this->NameDesc->Validate();
        $this->Category->Validate();
        $this->Size->Validate();
        $this->Texture->Validate();
        $this->Color->Validate();
        $this->Material->Validate();
        $this->Remarks->Validate();
        $this->UnitPrice->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->Box_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Design->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Color->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Material->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remarks->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $this->Box_H_ID->Errors->Clear();
        $this->CollectID->Errors->Clear();
        $this->Qty->Errors->Clear();
        $this->Unit->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->CollectCode->Errors->Clear();
        $this->Design->Errors->Clear();
        $this->NameDesc->Errors->Clear();
        $this->Category->Errors->Clear();
        $this->Size->Errors->Clear();
        $this->Texture->Errors->Clear();
        $this->Color->Errors->Clear();
        $this->Material->Errors->Clear();
        $this->Remarks->Errors->Clear();
        $this->UnitPrice->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @51-15990D6F
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["Box_H_ID"][$this->RowNumber]) && count($this->FormParameters["Box_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["Box_H_ID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectID"][$this->RowNumber]) && count($this->FormParameters["CollectID"][$this->RowNumber])) || strlen($this->FormParameters["CollectID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Qty"][$this->RowNumber]) && count($this->FormParameters["Qty"][$this->RowNumber])) || strlen($this->FormParameters["Qty"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Unit"][$this->RowNumber]) && count($this->FormParameters["Unit"][$this->RowNumber])) || strlen($this->FormParameters["Unit"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectCode"][$this->RowNumber]) && count($this->FormParameters["CollectCode"][$this->RowNumber])) || strlen($this->FormParameters["CollectCode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Design"][$this->RowNumber]) && count($this->FormParameters["Design"][$this->RowNumber])) || strlen($this->FormParameters["Design"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["NameDesc"][$this->RowNumber]) && count($this->FormParameters["NameDesc"][$this->RowNumber])) || strlen($this->FormParameters["NameDesc"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Category"][$this->RowNumber]) && count($this->FormParameters["Category"][$this->RowNumber])) || strlen($this->FormParameters["Category"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Size"][$this->RowNumber]) && count($this->FormParameters["Size"][$this->RowNumber])) || strlen($this->FormParameters["Size"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Texture"][$this->RowNumber]) && count($this->FormParameters["Texture"][$this->RowNumber])) || strlen($this->FormParameters["Texture"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Color"][$this->RowNumber]) && count($this->FormParameters["Color"][$this->RowNumber])) || strlen($this->FormParameters["Color"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Material"][$this->RowNumber]) && count($this->FormParameters["Material"][$this->RowNumber])) || strlen($this->FormParameters["Material"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Remarks"][$this->RowNumber]) && count($this->FormParameters["Remarks"][$this->RowNumber])) || strlen($this->FormParameters["Remarks"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["UnitPrice"][$this->RowNumber]) && count($this->FormParameters["UnitPrice"][$this->RowNumber])) || strlen($this->FormParameters["UnitPrice"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @51-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @51-7D0BAB3B
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
        } else if($this->Insert->Pressed) {
            $this->PressedButton = "Insert";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "AddItemBtn") {
            if(!CCGetEvent($this->AddItemBtn->CCSEvents, "OnClick", $this->AddItemBtn)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Insert") {
            if(!CCGetEvent($this->Insert->CCSEvents, "OnClick", $this->Insert)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @51-56AC5622
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Box_D_ID"] = $this->CachedColumns["Box_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Box_H_ID->SetText($this->FormParameters["Box_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            $this->Remarks->SetText($this->FormParameters["Remarks"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @51-B9C27F5A
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Box_H_ID->SetValue($this->Box_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->Unit->SetValue($this->Unit->GetValue(true));
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
        $this->DataSource->Remarks->SetValue($this->Remarks->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
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

//UpdateRow Method @51-6A419D8C
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Box_H_ID->SetValue($this->Box_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->Unit->SetValue($this->Unit->GetValue(true));
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
        $this->DataSource->Remarks->SetValue($this->Remarks->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
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

//DeleteRow Method @51-A4A656F6
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

//FormScript Method @51-32AD9A1A
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var AddNewDetailElements;\n";
        $script .= "var AddNewDetailEmptyRows = 31;\n";
        $script .= "var " . $this->ComponentName . "Box_H_IDID = 0;\n";
        $script .= "var " . $this->ComponentName . "CollectIDID = 1;\n";
        $script .= "var " . $this->ComponentName . "QtyID = 2;\n";
        $script .= "var " . $this->ComponentName . "UnitID = 3;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 4;\n";
        $script .= "var " . $this->ComponentName . "CollectCodeID = 5;\n";
        $script .= "var " . $this->ComponentName . "DesignID = 6;\n";
        $script .= "var " . $this->ComponentName . "NameDescID = 7;\n";
        $script .= "var " . $this->ComponentName . "CategoryID = 8;\n";
        $script .= "var " . $this->ComponentName . "SizeID = 9;\n";
        $script .= "var " . $this->ComponentName . "TextureID = 10;\n";
        $script .= "var " . $this->ComponentName . "ColorID = 11;\n";
        $script .= "var " . $this->ComponentName . "MaterialID = 12;\n";
        $script .= "var " . $this->ComponentName . "RemarksID = 13;\n";
        $script .= "var " . $this->ComponentName . "UnitPriceID = 14;\n";
        $script .= "\nfunction initAddNewDetailElements() {\n";
        $script .= "\tvar ED = document.forms[\"AddNewDetail\"];\n";
        $script .= "\tAddNewDetailElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.Box_H_ID_" . $i . ", " . "ED.CollectID_" . $i . ", " . "ED.Qty_" . $i . ", " . "ED.Unit_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.CollectCode_" . $i . ", " . "ED.Design_" . $i . ", " . "ED.NameDesc_" . $i . ", " . "ED.Category_" . $i . ", " . "ED.Size_" . $i . ", " . "ED.Texture_" . $i . ", " . "ED.Color_" . $i . ", " . "ED.Material_" . $i . ", " . "ED.Remarks_" . $i . ", " . "ED.UnitPrice_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @51-64113B88
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
                $this->CachedColumns["Box_D_ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["Box_D_ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @51-8F970066
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["Box_D_ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @51-83F7B513
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
        $this->ControlsVisible["Box_H_ID"] = $this->Box_H_ID->Visible;
        $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
        $this->ControlsVisible["Qty"] = $this->Qty->Visible;
        $this->ControlsVisible["Unit"] = $this->Unit->Visible;
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
        $this->ControlsVisible["Remarks"] = $this->Remarks->Visible;
        $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
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
                    $this->CachedColumns["Box_D_ID"][$this->RowNumber] = $this->DataSource->CachedColumns["Box_D_ID"];
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
                    $this->UnitPrice->SetText("");
                    $this->Box_H_ID->SetValue($this->DataSource->Box_H_ID->GetValue());
                    $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                    $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                    $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                    $this->Remarks->SetValue($this->DataSource->Remarks->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Box_H_ID->SetText($this->FormParameters["Box_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->Remarks->SetText($this->FormParameters["Remarks"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["Box_D_ID"][$this->RowNumber] = "";
                    $this->Box_H_ID->SetText("");
                    $this->CollectID->SetText("");
                    $this->Qty->SetText("");
                    $this->Unit->SetText("");
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
                    $this->Remarks->SetText("");
                    $this->UnitPrice->SetText("");
                } else {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Box_H_ID->SetText($this->FormParameters["Box_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->Remarks->SetText($this->FormParameters["Remarks"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Box_H_ID->Show($this->RowNumber);
                $this->CollectID->Show($this->RowNumber);
                $this->Qty->Show($this->RowNumber);
                $this->Unit->Show($this->RowNumber);
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
                $this->Remarks->Show($this->RowNumber);
                $this->UnitPrice->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["Box_D_ID"] == $this->CachedColumns["Box_D_ID"][$this->RowNumber])) {
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
        $this->Insert->Show();

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

} //End AddNewDetail Class @51-FCB6E20C

class clsAddNewDetailDataSource extends clsDBGayaFusionAll {  //AddNewDetailDataSource Class @51-9729D968

//DataSource Variables @51-368FA79C
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
    public $Box_H_ID;
    public $CollectID;
    public $Qty;
    public $Unit;
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
    public $Remarks;
    public $UnitPrice;
//End DataSource Variables

//DataSourceClass_Initialize Event @51-F5C0CEEF
    function clsAddNewDetailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->Initialize();
        $this->Box_H_ID = new clsField("Box_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
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
        
        $this->Remarks = new clsField("Remarks", ccsMemo, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        

        $this->InsertFields["Box_H_ID"] = array("Name" => "Box_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Remarks"] = array("Name" => "Remarks", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Box_H_ID"] = array("Name" => "Box_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Remarks"] = array("Name" => "Remarks", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @51-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @51-DE88D80C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlBox_H_ID", ccsInteger, "", "", $this->Parameters["urlBox_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Box_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @51-E8286D49
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_box_d";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_box_d {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @51-11EE2D27
    function SetValues()
    {
        $this->CachedColumns["Box_D_ID"] = $this->f("Box_D_ID");
        $this->Box_H_ID->SetDBValue(trim($this->f("Box_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->Remarks->SetDBValue($this->f("Remarks"));
    }
//End SetValues Method

//Insert Method @51-7A7300A8
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Box_H_ID"]["Value"] = $this->Box_H_ID->GetDBValue(true);
        $this->InsertFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->InsertFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->InsertFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->InsertFields["Remarks"]["Value"] = $this->Remarks->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_box_d", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @51-C8B0F074
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Box_D_ID=" . $this->ToSQL($this->CachedColumns["Box_D_ID"], ccsInteger);
        $this->UpdateFields["Box_H_ID"]["Value"] = $this->Box_H_ID->GetDBValue(true);
        $this->UpdateFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->UpdateFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->UpdateFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->UpdateFields["Remarks"]["Value"] = $this->Remarks->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_box_d", $this->UpdateFields, $this);
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

//Delete Method @51-231647BF
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Box_D_ID=" . $this->ToSQL($this->CachedColumns["Box_D_ID"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_box_d";
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

} //End AddNewDetailDataSource Class @51-FCB6E20C

//Initialize Page @1-130E59DA
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
$TemplateFileName = "AddBox.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-03DA4D4C
include_once("./AddBox_events.php");
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

//Show Page @1-ACC9FBD1
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
