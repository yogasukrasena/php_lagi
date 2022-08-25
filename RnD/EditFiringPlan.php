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

//Include Common Files @1-5EF30DAF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EditFiringPlan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblfiringplan { //tblfiringplan Class @2-B1B1F060

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

//Class_Initialize Event @2-894C86D9
    function clsRecordtblfiringplan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblfiringplan/Error";
        $this->DataSource = new clstblfiringplanDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblfiringplan";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->FiringPlanCode = new clsControl(ccsLabel, "FiringPlanCode", "Firing Plan Code", ccsText, "", CCGetRequestParam("FiringPlanCode", $Method, NULL), $this);
            $this->FiringPlanDescription = new clsControl(ccsLabel, "FiringPlanDescription", "Firing Plan Description", ccsText, "", CCGetRequestParam("FiringPlanDescription", $Method, NULL), $this);
            $this->FiringPlanDate = new clsControl(ccsTextBox, "FiringPlanDate", "Firing Plan Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("FiringPlanDate", $Method, NULL), $this);
            $this->FiringPlanDate->Required = true;
            $this->DatePicker_FiringPlanDate = new clsDatePicker("DatePicker_FiringPlanDate", "tblfiringplan", "FiringPlanDate", $this);
            $this->FiringPlanNotes = new clsControl(ccsTextArea, "FiringPlanNotes", "Firing Plan Notes", ccsMemo, "", CCGetRequestParam("FiringPlanNotes", $Method, NULL), $this);
            $this->FileUpload1 = new clsFileUpload("FileUpload1", "FileUpload1", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload2 = new clsFileUpload("FileUpload2", "FileUpload2", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload3 = new clsFileUpload("FileUpload3", "FileUpload3", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload4 = new clsFileUpload("FileUpload4", "FileUpload4", "%TEMP", "../upload/", "*", "", 100000, $this);
            $this->FileUpload5 = new clsFileUpload("FileUpload5", "FileUpload5", "%TEMP", "../upload/", "*", "", 100000, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @2-44F7C4AE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->FiringPlanDate->Validate() && $Validation);
        $Validation = ($this->FiringPlanNotes->Validate() && $Validation);
        $Validation = ($this->FileUpload1->Validate() && $Validation);
        $Validation = ($this->FileUpload2->Validate() && $Validation);
        $Validation = ($this->FileUpload3->Validate() && $Validation);
        $Validation = ($this->FileUpload4->Validate() && $Validation);
        $Validation = ($this->FileUpload5->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->FiringPlanDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FiringPlanNotes->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload2->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload3->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload4->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FileUpload5->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-F4CDD9B7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->FiringPlanCode->Errors->Count());
        $errors = ($errors || $this->FiringPlanDescription->Errors->Count());
        $errors = ($errors || $this->FiringPlanDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_FiringPlanDate->Errors->Count());
        $errors = ($errors || $this->FiringPlanNotes->Errors->Count());
        $errors = ($errors || $this->FileUpload1->Errors->Count());
        $errors = ($errors || $this->FileUpload2->Errors->Count());
        $errors = ($errors || $this->FileUpload3->Errors->Count());
        $errors = ($errors || $this->FileUpload4->Errors->Count());
        $errors = ($errors || $this->FileUpload5->Errors->Count());
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

//Operation Method @2-D2E36C67
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

        $this->FileUpload1->Upload();
        $this->FileUpload2->Upload();
        $this->FileUpload3->Upload();
        $this->FileUpload4->Upload();
        $this->FileUpload5->Upload();

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "FiringPlan.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "FiringPlanCode"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
                $Redirect = "FiringPlan.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "FiringPlanCode"));
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

//UpdateRow Method @2-A69950ED
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->FiringPlanCode->SetValue($this->FiringPlanCode->GetValue(true));
        $this->DataSource->FiringPlanDescription->SetValue($this->FiringPlanDescription->GetValue(true));
        $this->DataSource->FiringPlanDate->SetValue($this->FiringPlanDate->GetValue(true));
        $this->DataSource->FiringPlanNotes->SetValue($this->FiringPlanNotes->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->FileUpload2->SetValue($this->FileUpload2->GetValue(true));
        $this->DataSource->FileUpload3->SetValue($this->FileUpload3->GetValue(true));
        $this->DataSource->FileUpload4->SetValue($this->FileUpload4->GetValue(true));
        $this->DataSource->FileUpload5->SetValue($this->FileUpload5->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Move();
            $this->FileUpload2->Move();
            $this->FileUpload3->Move();
            $this->FileUpload4->Move();
            $this->FileUpload5->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-630D45DC
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->FileUpload1->Delete();
            $this->FileUpload2->Delete();
            $this->FileUpload3->Delete();
            $this->FileUpload4->Delete();
            $this->FileUpload5->Delete();
        }
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-BCEBF225
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
                $this->FiringPlanCode->SetValue($this->DataSource->FiringPlanCode->GetValue());
                $this->FiringPlanDescription->SetValue($this->DataSource->FiringPlanDescription->GetValue());
                if(!$this->FormSubmitted){
                    $this->FiringPlanDate->SetValue($this->DataSource->FiringPlanDate->GetValue());
                    $this->FiringPlanNotes->SetValue($this->DataSource->FiringPlanNotes->GetValue());
                    $this->FileUpload1->SetValue($this->DataSource->FileUpload1->GetValue());
                    $this->FileUpload2->SetValue($this->DataSource->FileUpload2->GetValue());
                    $this->FileUpload3->SetValue($this->DataSource->FileUpload3->GetValue());
                    $this->FileUpload4->SetValue($this->DataSource->FileUpload4->GetValue());
                    $this->FileUpload5->SetValue($this->DataSource->FileUpload5->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->FiringPlanCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_FiringPlanDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanNotes->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FileUpload5->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->FiringPlanCode->Show();
        $this->FiringPlanDescription->Show();
        $this->FiringPlanDate->Show();
        $this->DatePicker_FiringPlanDate->Show();
        $this->FiringPlanNotes->Show();
        $this->FileUpload1->Show();
        $this->FileUpload2->Show();
        $this->FileUpload3->Show();
        $this->FileUpload4->Show();
        $this->FileUpload5->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblfiringplan Class @2-FCB6E20C

class clstblfiringplanDataSource extends clsDBGayaFusionAll {  //tblfiringplanDataSource Class @2-50D90770

//DataSource Variables @2-15E25930
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $FiringPlanCode;
    public $FiringPlanDescription;
    public $FiringPlanDate;
    public $FiringPlanNotes;
    public $FileUpload1;
    public $FileUpload2;
    public $FileUpload3;
    public $FileUpload4;
    public $FileUpload5;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A8E96FC9
    function clstblfiringplanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblfiringplan/Error";
        $this->Initialize();
        $this->FiringPlanCode = new clsField("FiringPlanCode", ccsText, "");
        
        $this->FiringPlanDescription = new clsField("FiringPlanDescription", ccsText, "");
        
        $this->FiringPlanDate = new clsField("FiringPlanDate", ccsDate, $this->DateFormat);
        
        $this->FiringPlanNotes = new clsField("FiringPlanNotes", ccsMemo, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->FileUpload2 = new clsField("FileUpload2", ccsText, "");
        
        $this->FileUpload3 = new clsField("FileUpload3", ccsText, "");
        
        $this->FileUpload4 = new clsField("FileUpload4", ccsText, "");
        
        $this->FileUpload5 = new clsField("FileUpload5", ccsText, "");
        

        $this->UpdateFields["FiringPlanDate"] = array("Name" => "FiringPlanDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanNotes"] = array("Name" => "FiringPlanNotes", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanTechDraw"] = array("Name" => "FiringPlanTechDraw", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanPhoto1"] = array("Name" => "FiringPlanPhoto1", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanPhoto2"] = array("Name" => "FiringPlanPhoto2", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanPhoto3"] = array("Name" => "FiringPlanPhoto3", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanPhoto4"] = array("Name" => "FiringPlanPhoto4", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C6736E1B
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

//Open Method @2-BDF5EB4A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblfiringplan {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CA5E7779
    function SetValues()
    {
        $this->FiringPlanCode->SetDBValue($this->f("FiringPlanCode"));
        $this->FiringPlanDescription->SetDBValue($this->f("FiringPlanDescription"));
        $this->FiringPlanDate->SetDBValue(trim($this->f("FiringPlanDate")));
        $this->FiringPlanNotes->SetDBValue($this->f("FiringPlanNotes"));
        $this->FileUpload1->SetDBValue($this->f("FiringPlanTechDraw"));
        $this->FileUpload2->SetDBValue($this->f("FiringPlanPhoto1"));
        $this->FileUpload3->SetDBValue($this->f("FiringPlanPhoto2"));
        $this->FileUpload4->SetDBValue($this->f("FiringPlanPhoto3"));
        $this->FileUpload5->SetDBValue($this->f("FiringPlanPhoto4"));
    }
//End SetValues Method

//Update Method @2-5FCB6070
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["FiringPlanDate"]["Value"] = $this->FiringPlanDate->GetDBValue(true);
        $this->UpdateFields["FiringPlanNotes"]["Value"] = $this->FiringPlanNotes->GetDBValue(true);
        $this->UpdateFields["FiringPlanTechDraw"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["FiringPlanPhoto1"]["Value"] = $this->FileUpload2->GetDBValue(true);
        $this->UpdateFields["FiringPlanPhoto2"]["Value"] = $this->FileUpload3->GetDBValue(true);
        $this->UpdateFields["FiringPlanPhoto3"]["Value"] = $this->FileUpload4->GetDBValue(true);
        $this->UpdateFields["FiringPlanPhoto4"]["Value"] = $this->FileUpload5->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblfiringplan", $this->UpdateFields, $this);
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

//Delete Method @2-1EED9D01
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tblfiringplan";
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

} //End tblfiringplanDataSource Class @2-FCB6E20C

//Initialize Page @1-A90AC2BE
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
$TemplateFileName = "EditFiringPlan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0839EA48
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblfiringplan = new clsRecordtblfiringplan("", $MainPage);
$MainPage->tblfiringplan = & $tblfiringplan;
$tblfiringplan->Initialize();

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

//Execute Components @1-01D74BE0
$tblfiringplan->Operation();
//End Execute Components

//Go to destination page @1-65F516F2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblfiringplan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6063227A
$tblfiringplan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-39883983
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblfiringplan);
unset($Tpl);
//End Unload Page


?>
